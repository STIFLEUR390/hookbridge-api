<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\IncomingRequest\CreateIncomingRequestRequest;
use App\Http\Requests\V1\IncomingRequest\UpdateIncomingRequestRequest;
use App\Http\Resources\V1\IncomingRequest\IncomingRequestResource;
use App\Models\V1\IncomingRequest;
use App\Services\V1\IncomingRequest\IncomingRequestService;
use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Gestion des requêtes entrantes (webhooks et callbacks)
 *
 * Cette API permet de gérer les requêtes entrantes, incluant les webhooks et les callbacks.
 * Elle fournit des endpoints pour lister, créer, mettre à jour et supprimer les requêtes.
 *
 * @tags Incoming Requests
 */
#[Group('Incoming Requests API', weight: 1)]
class IncomingRequestController extends Controller
{
    public function __construct(
        protected IncomingRequestService $service
    ) {
    }

    /**
     * Liste des requêtes entrantes
     *
     * Retourne une liste paginée des requêtes entrantes avec possibilité de filtrage et de tri.
     *
     * @queryParam project_id integer ID du projet associé. Example: 1
     * @queryParam type string Type de requête (webhook/callback). Example: webhook
     * @queryParam http_method string Méthode HTTP (GET/POST). Example: POST
     * @queryParam status string Statut de la requête (new/processing/processed/failed). Example: new
     * @queryParam received_at string Date de réception (format Y-m-d). Example: 2024-03-14
     * @queryParam sort string Champ de tri (-created_at pour ordre décroissant). Example: -created_at
     * @queryParam include string Relations à inclure (project). Example: project
     *
     * @response {
     *   "data": [
     *     {
     *       "id": 1,
     *       "project_id": 1,
     *       "type": "webhook",
     *       "http_method": "POST",
     *       "headers": {"Content-Type": "application/json"},
     *       "payload": {"event": "user.created"},
     *       "status": "new",
     *       "received_at": "2024-03-14T12:00:00+00:00"
     *     }
     *   ],
     *   "links": {},
     *   "meta": {}
     * }
     */
    public function index(): AnonymousResourceCollection
    {
        $incomingRequests = $this->service->getAll(request()->all());
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
            'message' => 'Incoming request created successfully',
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
     *     "type": "webhook",
     *     "http_method": "POST",
     *     "headers": {"Content-Type": "application/json"},
     *     "payload": {"event": "user.created"},
     *     "status": "new",
     *     "received_at": "2024-03-14T12:00:00+00:00"
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
            'message' => 'Incoming request updated successfully',
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
            'message' => 'Incoming request deleted successfully',
        ]);
    }
}
