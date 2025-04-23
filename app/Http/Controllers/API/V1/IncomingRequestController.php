<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\IncomingRequest\CreateIncomingRequestRequest;
use App\Http\Requests\V1\IncomingRequest\UpdateIncomingRequestRequest;
use App\Http\Resources\V1\IncomingRequest\IncomingRequestResource;
use App\Models\V1\IncomingRequest;
use App\Services\V1\IncomingRequest\IncomingRequestService;
use Dedoc\Scramble\Attributes\Group;
use Dedoc\Scramble\Attributes\QueryParameter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

/**
 * Gestion des requêtes entrantes
 *
 * Cette API permet de gérer les requêtes entrantes (callbacks et webhooks).
 * Elle fournit des endpoints pour lister, afficher et supprimer les requêtes.
 *
 * @tags Incoming Requests
 */
#[Group('Incoming Requests API', weight: 3)]
final class IncomingRequestController extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;

    public function __construct(
        protected IncomingRequestService $service,
    ) {}

    /**
     * Liste des requêtes entrantes
     *
     * Retourne une liste paginée des requêtes entrantes avec possibilité de filtrage et de tri.
     *
     * @queryParam project_id integer ID du projet associé. Example: 1
     * @queryParam method string Méthode HTTP. Example: POST
     * @queryParam path string Chemin de la requête. Example: /webhook
     * @queryParam status integer Code de statut HTTP. Example: 200
     * @queryParam from_date string Date de début (Y-m-d). Example: 2024-01-01
     * @queryParam to_date string Date de fin (Y-m-d). Example: 2024-12-31
     * @queryParam sort string Champ de tri (-created_at pour ordre décroissant). Example: -created_at
     * @queryParam include string Relations à inclure (project,deliveryAttempts). Example: project
     * @queryParam search string Recherche dans path et headers. Example: webhook
     *
     * @response {
     *   "data": [
     *     {
     *       "id": 1,
     *       "project_id": 1,
     *       "method": "POST",
     *       "path": "/webhook",
     *       "headers": {"Content-Type": "application/json"},
     *       "body": {"event": "payment.success"},
     *       "status": 200,
     *       "created_at": "2024-03-14T12:00:00+00:00"
     *     }
     *   ],
     *   "links": {},
     *   "meta": {}
     * }
     */
    #[QueryParameter('per_page', description: 'Nombre de requêtes par page', type: 'int', default: 15)]
    #[QueryParameter('search', description: 'Recherche par chemin', type: 'string')]
    #[QueryParameter('project_id', description: 'ID du projet', type: 'int')]
    public function index(): AnonymousResourceCollection
    {
        $user = Auth::user();
        $filters = request()->all();

        if (!$user->hasRole('admin')) {
            $filters['project.user_id'] = $user->id;
        }

        $incomingRequests = $this->service->getAll($filters);
        return IncomingRequestResource::collection($incomingRequests);
    }

    /**
     * Créer une nouvelle requête entrante
     *
     * Enregistre une nouvelle requête entrante dans le système.
     *
     * @bodyParam project_id integer required ID du projet associé. Example: 1
     * @bodyParam type string required Type de requête (webhook/callback). Example: webhook
     * @bodyParam http_method string required Méthode HTTP (GET/POST). Example: POST
     * @bodyParam headers object Entêtes HTTP de la requête. Example: {"Content-Type": "application/json"}
     * @bodyParam payload object Contenu de la requête. Example: {"event": "user.created"}
     * @bodyParam status string required Statut initial (new/processing/processed/failed). Example: new
     * @bodyParam received_at string required Date de réception. Example: 2024-03-14T12:00:00+00:00
     *
     * @response 201 {
     *   "message": "Incoming request created successfully",
     *   "data": {
     *     "id": 1,
     *     "project_id": 1,
     *     "type": "webhook",
     *     "http_method": "POST",
     *     "headers": {"Content-Type": "application/json"},
     *     "payload": {"event": "user.created"},
     *     "status": "new",
     *     "received_at": "2024-03-14T12:00:00+00:00"
     *   }
     * }
     */
    public function store(CreateIncomingRequestRequest $request): JsonResponse
    {
        $incomingRequest = $this->service->create($request->validated());

        return response()->json([
            'message' => __('incoming_requests.created'),
            'data' => new IncomingRequestResource($incomingRequest),
        ], 201);
    }

    /**
     * Afficher une requête entrante
     *
     * Retourne les détails d'une requête entrante spécifique.
     *
     * @urlParam incomingRequest integer required L'ID de la requête entrante. Example: 1
     *
     * @response {
     *   "data": {
     *     "id": 1,
     *     "project_id": 1,
     *     "method": "POST",
     *     "path": "/webhook",
     *     "headers": {"Content-Type": "application/json"},
     *     "body": {"event": "payment.success"},
     *     "status": 200,
     *     "created_at": "2024-03-14T12:00:00+00:00"
     *   }
     * }
     */
    public function show(IncomingRequest $incomingRequest): IncomingRequestResource
    {
        $incomingRequest = $this->service->findById($incomingRequest->id);
        return new IncomingRequestResource($incomingRequest);
    }

    /**
     * Mettre à jour une requête entrante
     *
     * Met à jour les informations d'une requête entrante existante.
     *
     * @urlParam incomingRequest integer required L'ID de la requête entrante. Example: 1
     * @bodyParam status string required Nouveau statut de la requête. Example: processed
     *
     * @response {
     *   "message": "Incoming request updated successfully",
     *   "data": {
     *     "id": 1,
     *     "project_id": 1,
     *     "type": "webhook",
     *     "http_method": "POST",
     *     "headers": {"Content-Type": "application/json"},
     *     "payload": {"event": "user.created"},
     *     "status": "processed",
     *     "received_at": "2024-03-14T12:00:00+00:00"
     *   }
     * }
     */
    public function update(UpdateIncomingRequestRequest $request, IncomingRequest $incomingRequest): JsonResponse
    {
        $incomingRequest = $this->service->update($incomingRequest, $request->validated());

        return response()->json([
            'message' => __('incoming_requests.updated'),
            'data' => new IncomingRequestResource($incomingRequest),
        ]);
    }

    /**
     * Supprimer une requête entrante
     *
     * Supprime définitivement une requête entrante du système.
     *
     * @urlParam incomingRequest integer required L'ID de la requête entrante. Example: 1
     *
     * @response {
     *   "message": "Incoming request deleted successfully"
     * }
     */
    public function destroy(IncomingRequest $incomingRequest): JsonResponse
    {
        $this->service->delete($incomingRequest);

        return response()->json([
            'status' => 204,
            'message' => __('incoming_requests.deleted'),
        ], 204);
    }
}
