<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DeliveryAttempt\CreateDeliveryAttemptRequest;
use App\Http\Requests\V1\DeliveryAttempt\UpdateDeliveryAttemptRequest;
use App\Http\Resources\V1\DeliveryAttempt\DeliveryAttemptResource;
use App\Models\V1\DeliveryAttempt;
use App\Services\V1\DeliveryAttempt\DeliveryAttemptService;
use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Gestion des tentatives de livraison
 *
 * Cette API permet de gérer les tentatives de livraison des webhooks et callbacks
 * vers les URLs cibles configurées dans les projets.
 *
 * @tags Delivery Attempts
 */
#[Group('Delivery Attempts API')]
class DeliveryAttemptController extends Controller
{
    public function __construct(
        protected DeliveryAttemptService $service
    ) {
    }

    /**
     * Liste des tentatives de livraison
     *
     * Retourne une liste paginée des tentatives de livraison avec possibilité de filtrage.
     *
     * @queryParam incoming_request_id integer ID de la requête entrante. Example: 1
     * @queryParam project_target_id integer ID de la cible du projet. Example: 1
     * @queryParam status string Statut de la tentative (pending/in_progress/success/failed). Example: success
     * @queryParam response_code integer Code de réponse HTTP. Example: 200
     * @queryParam sort string Champ de tri (-created_at pour ordre décroissant). Example: -created_at
     * @queryParam include string Relations à inclure (incomingRequest,projectTarget). Example: incomingRequest
     *
     * @response {
     *   "data": [
     *     {
     *       "id": 1,
     *       "incoming_request_id": 1,
     *       "project_target_id": 1,
     *       "attempt_count": 2,
     *       "status": "success",
     *       "response_code": 200,
     *       "response_body": {"status": "success", "message": "Webhook received"},
     *       "next_attempt_at": null,
     *       "last_attempt_at": "2024-03-14T12:00:00+00:00"
     *     }
     *   ],
     *   "links": {},
     *   "meta": {}
     * }
     */
    public function index(): AnonymousResourceCollection
    {
        $deliveryAttempts = $this->service->getAll(request()->all());
        return DeliveryAttemptResource::collection($deliveryAttempts);
    }

    /**
     * Créer une nouvelle tentative de livraison
     *
     * Enregistre une nouvelle tentative de livraison dans le système.
     *
     * @bodyParam incoming_request_id integer required ID de la requête entrante. Example: 1
     * @bodyParam project_target_id integer required ID de la cible du projet. Example: 1
     * @bodyParam attempt_count integer required Nombre de tentatives. Example: 1
     * @bodyParam status string required Statut de la tentative. Example: pending
     * @bodyParam response_code integer Code de réponse HTTP. Example: 200
     * @bodyParam response_body string Corps de la réponse. Example: {"status": "success"}
     * @bodyParam next_attempt_at string Date de la prochaine tentative. Example: 2024-03-14T12:00:00+00:00
     * @bodyParam last_attempt_at string Date de la dernière tentative. Example: 2024-03-14T12:00:00+00:00
     *
     * @response 201 {
     *   "message": "Delivery attempt created successfully",
     *   "data": {
     *     "id": 1,
     *     "incoming_request_id": 1,
     *     "project_target_id": 1,
     *     "attempt_count": 1,
     *     "status": "pending",
     *     "next_attempt_at": "2024-03-14T12:00:00+00:00"
     *   }
     * }
     */
    public function store(CreateDeliveryAttemptRequest $request): JsonResponse
    {
        $deliveryAttempt = $this->service->create($request->validated());

        return response()->json([
            'message' => 'Delivery attempt created successfully',
            'data' => new DeliveryAttemptResource($deliveryAttempt),
        ], 201);
    }

    /**
     * Afficher une tentative de livraison
     *
     * Retourne les détails d'une tentative de livraison spécifique.
     *
     * @urlParam deliveryAttempt integer required L'ID de la tentative de livraison. Example: 1
     *
     * @response {
     *   "data": {
     *     "id": 1,
     *     "incoming_request_id": 1,
     *     "project_target_id": 1,
     *     "attempt_count": 2,
     *     "status": "success",
     *     "response_code": 200,
     *     "response_body": {"status": "success", "message": "Webhook received"},
     *     "next_attempt_at": null,
     *     "last_attempt_at": "2024-03-14T12:00:00+00:00"
     *   }
     * }
     */
    public function show(DeliveryAttempt $deliveryAttempt): DeliveryAttemptResource
    {
        $deliveryAttempt = $this->service->findById($deliveryAttempt->id);
        return new DeliveryAttemptResource($deliveryAttempt);
    }

    /**
     * Mettre à jour une tentative de livraison
     *
     * Met à jour les informations d'une tentative de livraison existante.
     *
     * @urlParam deliveryAttempt integer required L'ID de la tentative de livraison. Example: 1
     * @bodyParam status string Nouveau statut de la tentative. Example: success
     * @bodyParam response_code integer Code de réponse HTTP. Example: 200
     * @bodyParam response_body string Corps de la réponse. Example: {"status": "success"}
     * @bodyParam next_attempt_at string Date de la prochaine tentative. Example: 2024-03-14T12:00:00+00:00
     *
     * @response {
     *   "message": "Delivery attempt updated successfully",
     *   "data": {
     *     "id": 1,
     *     "incoming_request_id": 1,
     *     "project_target_id": 1,
     *     "attempt_count": 2,
     *     "status": "success",
     *     "response_code": 200,
     *     "response_body": {"status": "success", "message": "Webhook received"},
     *     "next_attempt_at": null,
     *     "last_attempt_at": "2024-03-14T12:00:00+00:00"
     *   }
     * }
     */
    public function update(UpdateDeliveryAttemptRequest $request, DeliveryAttempt $deliveryAttempt): JsonResponse
    {
        $deliveryAttempt = $this->service->update($deliveryAttempt, $request->validated());

        return response()->json([
            'message' => 'Delivery attempt updated successfully',
            'data' => new DeliveryAttemptResource($deliveryAttempt),
        ]);
    }

    /**
     * Supprimer une tentative de livraison
     *
     * Supprime définitivement une tentative de livraison du système.
     *
     * @urlParam deliveryAttempt integer required L'ID de la tentative de livraison. Example: 1
     *
     * @response {
     *   "message": "Delivery attempt deleted successfully"
     * }
     */
    public function destroy(DeliveryAttempt $deliveryAttempt): JsonResponse
    {
        $this->service->delete($deliveryAttempt);

        return response()->json([
            'message' => 'Delivery attempt deleted successfully',
        ]);
    }
}
