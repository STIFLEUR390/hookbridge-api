<?php

namespace App\Jobs;

use App\Models\V1\DeliveryAttempt;
use App\Models\V1\IncomingRequest;
use App\Models\V1\ProjectTarget;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class ProcessWebhookDelivery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Le nombre de fois que le job peut être tenté.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * Le nombre de secondes à attendre avant de réessayer le job.
     *
     * @var int
     */
    public $backoff = 900; // 15 minutes

    /**
     * Le nombre de secondes pour la fenêtre de limitation de taux.
     *
     * @var int
     */
    protected $rateLimitWindow = 60; // 1 minute

    /**
     * Le nombre maximum de tentatives par fenêtre de temps.
     *
     * @var int
     */
    protected $maxAttemptsPerWindow = 15;

    /**
     * La requête entrante à traiter.
     *
     * @var IncomingRequest
     */
    protected $incomingRequest;

    /**
     * La cible du projet à laquelle envoyer le webhook.
     *
     * @var ProjectTarget
     */
    protected $projectTarget;

    /**
     * Créer une nouvelle instance du job.
     *
     * @param IncomingRequest $incomingRequest
     * @param ProjectTarget $projectTarget
     * @return void
     */
    public function __construct(IncomingRequest $incomingRequest, ProjectTarget $projectTarget)
    {
        $this->incomingRequest = $incomingRequest;
        $this->projectTarget = $projectTarget;
    }

    /**
     * Exécuter le job.
     *
     * @return void
     */
    public function handle()
    {
        // Vérifier si l'utilisateur a dépassé la limite de taux
        $userKey = 'user:' . $this->incomingRequest->project->user_id;

        if (RateLimiter::tooManyAttempts($userKey, $this->maxAttemptsPerWindow)) {
            $secondsUntilAvailable = RateLimiter::availableIn($userKey);

            Log::warning('Limite de taux dépassée', [
                'user_id' => $this->incomingRequest->project->user_id,
                'project_id' => $this->incomingRequest->project_id,
                'incoming_request_id' => $this->incomingRequest->id,
                'seconds_until_available' => $secondsUntilAvailable,
                'attempts' => RateLimiter::attempts($userKey),
                'max_attempts' => $this->maxAttemptsPerWindow,
                'window_seconds' => $this->rateLimitWindow,
            ]);

            $this->release($secondsUntilAvailable);
            return;
        }

        // Incrémenter le compteur avec une fenêtre de temps explicite
        RateLimiter::hit($userKey, $this->rateLimitWindow);

        // Mettre à jour le statut de la requête entrante
        $this->incomingRequest->update(['status' => 'processing']);

        // Créer une tentative de livraison
        $deliveryAttempt = DeliveryAttempt::create([
            'incoming_request_id' => $this->incomingRequest->id,
            'project_target_id' => $this->projectTarget->id,
            'attempt_count' => $this->attempts(),
            'status' => 'in_progress',
            'last_attempt_at' => now(),
        ]);

        try {
            // Formater les données du webhook
            $webhookData = $this->formatWebhookData();

            // Envoyer le webhook
            $response = Http::withHeaders($this->projectTarget->headers ?? [])
                ->timeout(30)
                ->post($this->projectTarget->url, $webhookData)->json();

            // Mettre à jour la tentative de livraison
            $deliveryAttempt->update([
                'status' => $response->successful() ? 'success' : 'failed',
                'response_code' => $response->status(),
                'response_body' => $response->body(),
            ]);

            // Si la livraison a réussi, mettre à jour la requête entrante
            if ($response->successful()) {
                $this->incomingRequest->update(['status' => 'processed']);
            } else {
                // Si nous avons encore des tentatives, planifier la prochaine
                if ($this->attempts() < $this->tries) {
                    $this->release($this->backoff);
                } else {
                    $this->incomingRequest->update(['status' => 'failed']);
                }
            }

            Log::info('Webhook envoyé', [
                'incoming_request_id' => $this->incomingRequest->id,
                'project_target_id' => $this->projectTarget->id,
                'attempt' => $this->attempts(),
                'status' => $response->status(),
            ]);
        } catch (\Exception $e) {
            // En cas d'erreur, mettre à jour la tentative de livraison
            $deliveryAttempt->update([
                'status' => 'failed',
                'response_code' => 0,
                'response_body' => $e->getMessage(),
            ]);

            Log::error('Erreur lors de l\'envoi du webhook', [
                'incoming_request_id' => $this->incomingRequest->id,
                'project_target_id' => $this->projectTarget->id,
                'attempt' => $this->attempts(),
                'error' => $e->getMessage(),
            ]);

            // Si nous avons encore des tentatives, planifier la prochaine
            if ($this->attempts() < $this->tries) {
                $this->release($this->backoff);
            } else {
                $this->incomingRequest->update(['status' => 'failed']);
            }
        }
    }

    /**
     * Formater les données du webhook.
     *
     * @return array
     */
    protected function formatWebhookData()
    {
        $payload = $this->incomingRequest->payload;

        // Vérifier si le payload contient déjà les champs requis
        if (isset($payload['event']) && isset($payload['data'])) {
            return $payload;
        }

        // Formater le payload selon le type de requête
        $event = $this->incomingRequest->type;
        $data = $payload;

        // Si le payload est une chaîne, essayer de le décoder
        if (is_string($payload)) {
            $decoded = json_decode($payload, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $data = $decoded;
            }
        }

        return [
            'event' => $event,
            'data' => $data,
            'timestamp' => now()->toIso8601String(),
            'request_id' => $this->incomingRequest->id,
        ];
    }

    /**
     * Déterminer le temps d'attente avant la prochaine tentative.
     *
     * @return array
     */
    public function backoff()
    {
        return [$this->backoff];
    }
}