<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessWebhookDelivery;
use App\Models\V1\Project;
use App\Models\V1\IncomingRequest;
use App\Models\V1\ProjectTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class HookController extends Controller
{
    /**
     * La fenêtre de temps (en minutes) pour la validation de la signature.
     *
     * @var int
     */
    protected $signatureTimeWindow = 5;

    /**
     * Gère les callbacks entrants pour un projet spécifique.
     *
     * @param Request $request
     * @param string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleCallback(Request $request, $uuid)
    {
        // Récupérer le projet grâce au uuid
        $project = Project::where('uuid', $uuid)->firstOrFail();

        // Valider la requête en fonction du projet
        $this->validateRequest($request, $project);

        // Enregistrer la requête entrante
        $incomingRequest = IncomingRequest::create([
            'project_id' => $project->id,
            'type' => 'callback',
            'http_method' => $request->method(),
            'headers' => $request->headers->all(),
            'payload' => $request->all(),
            'status' => 'new',
            'received_at' => now(),
        ]);

        // Récupérer les cibles du projet
        $projectTargets = ProjectTarget::where('project_id', $project->id)
            ->where('active', true)
            ->get();

        // Dispatcher les jobs pour chaque cible
        foreach ($projectTargets as $target) {
            // Charger les relations nécessaires pour le job
            $incomingRequest->load('project.user');
            ProcessWebhookDelivery::dispatch($incomingRequest, $target);
        }

        Log::info('Callback reçu', [
            'project_id' => $project->id,
            'request_id' => $incomingRequest->id,
            'uuid' => $uuid,
            'targets_count' => $projectTargets->count()
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Callback reçu avec succès',
            'data' => [
                'request_id' => $incomingRequest->id,
                'uuid' => $uuid,
                'targets_count' => $projectTargets->count()
            ]
        ], 201);
    }

    /**
     * Gère les webhooks entrants pour un projet spécifique.
     *
     * @param Request $request
     * @param string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleWebhook(Request $request, $uuid)
    {
        // Récupérer le projet grâce au uuid
        $project = Project::where('uuid', $uuid)->firstOrFail();

        // Valider la requête en fonction du projet
        $this->validateRequest($request, $project);

        // Enregistrer la requête entrante
        $incomingRequest = IncomingRequest::create([
            'project_id' => $project->id,
            'type' => 'webhook',
            'http_method' => $request->method(),
            'headers' => $request->headers->all(),
            'payload' => $request->all(),
            'status' => 'new',
            'received_at' => now(),
        ]);

        // Récupérer les cibles du projet
        $projectTargets = ProjectTarget::where('project_id', $project->id)
            ->where('active', true)
            ->get();

        // Dispatcher les jobs pour chaque cible
        foreach ($projectTargets as $target) {
            // Charger les relations nécessaires pour le job
            $incomingRequest->load('project.user');
            ProcessWebhookDelivery::dispatch($incomingRequest, $target);
        }

        Log::info('Webhook reçu', [
            'project_id' => $project->id,
            'request_id' => $incomingRequest->id,
            'uuid' => $uuid,
            'targets_count' => $projectTargets->count()
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Webhook reçu avec succès',
            'data' => [
                'request_id' => $incomingRequest->id,
                'uuid' => $uuid,
                'targets_count' => $projectTargets->count()
            ]
        ], 201);
    }

    /**
     * Valide la requête en fonction des règles du projet.
     *
     * @param Request $request
     * @param Project $project
     * @return void
     */
    private function validateRequest(Request $request, Project $project)
    {
        // Vérifier si le domaine est autorisé
        if ($project->allowed_domain) {
            $host = $request->header('Host');
            if (!$host || !str_contains($host, $project->allowed_domain)) {
                abort(403, 'Domaine non autorisé');
            }
        }

        // Vérifier si le sous-domaine est autorisé
        if ($project->allowed_subdomain) {
            $host = $request->header('Host');
            if (!$host || !str_contains($host, $project->allowed_subdomain)) {
                abort(403, 'Sous-domaine non autorisé');
            }
        }

        // Vérifier la signature si configurée dans le projet
        if (isset($project->provider_config['require_signature']) && $project->provider_config['require_signature']) {
            $signature = $request->header('verif-hash');

            if (!$signature) {
                abort(401, 'Signature manquante');
            }

            // Vérifier la signature avec une fenêtre temporelle
            $isValid = $this->validateSignatureWithTimeWindow($signature, $project);

            if (!$isValid) {
                Log::warning('Signature invalide', [
                    'project_id' => $project->id,
                    'signature' => $signature,
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);

                abort(401, 'Signature non valide');
            }
        }

        // Vérifier si le projet est actif
        if (!$project->active) {
            abort(403, 'Projet inactif');
        }
    }

    /**
     * Valide la signature avec une fenêtre temporelle.
     *
     * @param string $signature
     * @param Project $project
     * @return bool
     */
    private function validateSignatureWithTimeWindow($signature, Project $project)
    {
        // Créer une fenêtre temporelle (avant et après l'heure actuelle)
        $now = Carbon::now();
        $windowStart = $now->copy()->subMinutes($this->signatureTimeWindow);
        $windowEnd = $now->copy()->addMinutes($this->signatureTimeWindow);

        // Vérifier la signature pour chaque minute dans la fenêtre
        for ($time = $windowStart; $time <= $windowEnd; $time->addMinute()) {
            $timeString = $time->format('Y-m-d H:i:00'); // Arrondir à la minute
            $secretHash = hash('sha256', $project->name . $project->id . $timeString);

            if (hash_equals($signature, $secretHash)) {
                return true;
            }
        }

        return false;
    }
}