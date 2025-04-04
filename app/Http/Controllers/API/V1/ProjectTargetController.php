<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ProjectTarget\CreateProjectTargetRequest;
use App\Http\Requests\V1\ProjectTarget\UpdateProjectTargetRequest;
use App\Http\Resources\V1\ProjectTarget\ProjectTargetResource;
use App\Models\V1\ProjectTarget;
use App\Services\V1\ProjectTarget\ProjectTargetService;
use Dedoc\Scramble\Attributes\Group;
use Dedoc\Scramble\Attributes\QueryParameter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Gestion des cibles de projet (webhooks et callbacks)
 *
 * Cette API permet de gérer les cibles de projet, incluant les webhooks et les callbacks.
 * Elle fournit des endpoints pour lister, créer, mettre à jour et supprimer les cibles.
 *
 * @tags Project Targets
 */
#[Group('Project Targets API', weight: 2)]
final class ProjectTargetController extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;

    public function __construct(
        protected ProjectTargetService $service,
    ) {}

    /**
     * Liste des cibles de projet
     *
     * Retourne une liste paginée des cibles de projet avec possibilité de filtrage et de tri.
     *
     * @queryParam project_id integer ID du projet associé. Example: 1
     * @queryParam url string URL de la cible. Example: https://example.com/webhook
     * @queryParam requires_authentication boolean Authentification requise. Example: true
     * @queryParam secret string Clé secrète pour l'authentification. Example: abc123xyz
     * @queryParam active boolean État actif/inactif de la cible. Example: true
     * @queryParam from_date string Date de début (Y-m-d). Example: 2024-01-01
     * @queryParam to_date string Date de fin (Y-m-d). Example: 2024-12-31
     * @queryParam sort string Champ de tri (-created_at pour ordre décroissant). Example: -created_at
     * @queryParam include string Relations à inclure (project,deliveryAttempts). Example: project
     * @queryParam search string Recherche dans url et secret. Example: webhook
     *
     * @response {
     *   "data": [
     *     {
     *       "id": 1,
     *       "project_id": 1,
     *       "url": "https://example.com/webhook",
     *       "requires_authentication": true,
     *       "secret": "abc123xyz",
     *       "active": true,
     *       "created_at": "2024-03-14T12:00:00+00:00",
     *       "updated_at": "2024-03-14T12:00:00+00:00"
     *     }
     *   ],
     *   "links": {},
     *   "meta": {}
     * }
     */
    #[QueryParameter('per_page', description: 'Nombre de cibles par page', type: 'int', default: 15)]
    #[QueryParameter('search', description: 'Recherche par URL', type: 'string')]
    #[QueryParameter('active', description: 'Filtrer par statut actif/inactif', type: 'boolean')]
    #[QueryParameter('project_id', description: 'ID du projet', type: 'int')]
    public function index(): AnonymousResourceCollection
    {
        $projectTargets = $this->service->getAll(request()->all());
        return ProjectTargetResource::collection($projectTargets);
    }

    /**
     * Créer une nouvelle cible de projet
     *
     * Enregistre une nouvelle cible de projet dans le système.
     *
     * @bodyParam project_id integer required ID du projet associé. Example: 1
     * @bodyParam type string required Type de cible (webhook/callback). Example: webhook
     * @bodyParam url string required URL de la cible. Example: https://example.com/webhook
     * @bodyParam is_active boolean État actif/inactif de la cible. Example: true
     *
     * @response 201 {
     *   "message": "Project target created successfully",
     *   "data": {
     *     "id": 1,
     *     "project_id": 1,
     *     "type": "webhook",
     *     "url": "https://example.com/webhook",
     *     "is_active": true,
     *     "created_at": "2024-03-14T12:00:00+00:00"
     *   }
     * }
     */
    public function store(CreateProjectTargetRequest $request): JsonResponse
    {
        $projectTarget = $this->service->create($request->validated());

        return response()->json([
            'status' => 201,
            'message' => __('project_targets.created'),
            'data' => new ProjectTargetResource($projectTarget),
        ], 201);
    }

    /**
     * Afficher une cible de projet
     *
     * Retourne les détails d'une cible de projet spécifique.
     *
     * @urlParam projectTarget integer required L'ID de la cible de projet. Example: 1
     *
     * @response {
     *   "data": {
     *     "id": 1,
     *     "project_id": 1,
     *     "type": "webhook",
     *     "url": "https://example.com/webhook",
     *     "is_active": true,
     *     "created_at": "2024-03-14T12:00:00+00:00"
     *   }
     * }
     */
    public function show(ProjectTarget $projectTarget): ProjectTargetResource
    {
        $projectTarget = $this->service->findById($projectTarget->id);
        return new ProjectTargetResource($projectTarget);
    }

    /**
     * Mettre à jour une cible de projet
     *
     * Met à jour les informations d'une cible de projet existante.
     *
     * @urlParam projectTarget integer required L'ID de la cible de projet. Example: 1
     * @bodyParam type string Type de cible (webhook/callback). Example: webhook
     * @bodyParam url string URL de la cible. Example: https://example.com/webhook
     * @bodyParam is_active boolean État actif/inactif de la cible. Example: true
     *
     * @response {
     *   "message": "Project target updated successfully",
     *   "data": {
     *     "id": 1,
     *     "project_id": 1,
     *     "type": "webhook",
     *     "url": "https://example.com/webhook",
     *     "is_active": true,
     *     "created_at": "2024-03-14T12:00:00+00:00"
     *   }
     * }
     */
    public function update(UpdateProjectTargetRequest $request, ProjectTarget $projectTarget): JsonResponse
    {
        $projectTarget = $this->service->update($projectTarget, $request->validated());

        return response()->json([
            'status' => 200,
            'message' => __('project_targets.updated'),
            'data' => new ProjectTargetResource($projectTarget),
        ]);
    }

    /**
     * Supprimer une cible de projet
     *
     * Supprime définitivement une cible de projet du système.
     *
     * @urlParam projectTarget integer required L'ID de la cible de projet. Example: 1
     *
     * @response {
     *   "message": "Project target deleted successfully"
     * }
     */
    public function destroy(ProjectTarget $projectTarget): JsonResponse
    {
        $this->service->delete($projectTarget);

        return response()->json([
            'status' => 204,
            'message' => __('project_targets.deleted'),
        ], 204);
    }

    /**
     * Bascule le statut actif/inactif d'une cible
     *
     * @param ProjectTarget $target La cible dont le statut doit être modifié
     * @return JsonResponse
     */
    public function toggleStatus(ProjectTarget $target): JsonResponse
    {
        $this->authorize('update', $target);

        $target->update(['active' => ! $target->active]);

        return response()->json([
            'status' => 200,
            'message' => $target->active ? __('project_targets.status_activated') : __('project_targets.status_deactivated'),
            'data' => new ProjectTargetResource($target),
        ]);
    }
}
