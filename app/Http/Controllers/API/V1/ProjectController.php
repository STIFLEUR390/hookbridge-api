<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Project\CreateProjectRequest;
use App\Http\Requests\V1\Project\UpdateProjectRequest;
use App\Http\Resources\V1\Project\ProjectResource;
use App\Models\V1\Project;
use App\Services\V1\Project\ProjectService;
use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Dedoc\Scramble\Attributes\QueryParameter;

/**
 * Gestion des projets HookBridge
 *
 * Cette API permet de gérer les projets, incluant leurs cibles de webhook et de callback.
 * Elle fournit des endpoints pour lister, créer, mettre à jour et supprimer les projets.
 *
 * @tags Projects
 */
#[Group('Projects API', weight: 3)]
class ProjectController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(
        protected ProjectService $service
    ) {
    }

    /**
     * Liste des projets
     *
     * Retourne une liste paginée des projets avec possibilité de filtrage et de tri.
     *
     * @queryParam name string Nom du projet. Example: Mon Projet
     * @queryParam allowed_domain string Domaine autorisé. Example: example.com
     * @queryParam allowed_subdomain string Sous-domaine autorisé. Example: api
     * @queryParam header string En-tête personnalisé. Example: X-Custom-Header
     * @queryParam provider_config object Configuration du fournisseur. Example: {"key": "value"}
     * @queryParam uuid string UUID du projet. Example: 123e4567-e89b-12d3-a456-426614174000
     * @queryParam active boolean État actif/inactif du projet. Example: true
     * @queryParam user_id integer ID de l'utilisateur propriétaire. Example: 1
     * @queryParam from_date string Date de début (Y-m-d). Example: 2024-01-01
     * @queryParam to_date string Date de fin (Y-m-d). Example: 2024-12-31
     * @queryParam sort string Champ de tri (-created_at pour ordre décroissant). Example: -created_at
     * @queryParam include string Relations à inclure (user,projectTargets,incomingRequests). Example: user,projectTargets
     * @queryParam search string Recherche dans name, allowed_domain, allowed_subdomain, header, uuid. Example: api
     *
     * @response {
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Mon Projet",
     *       "allowed_domain": "example.com",
     *       "allowed_subdomain": "api",
     *       "header": "X-Custom-Header",
     *       "provider_config": {"key": "value"},
     *       "uuid": "123e4567-e89b-12d3-a456-426614174000",
     *       "active": true,
     *       "user_id": 1,
     *       "created_at": "2024-03-14T12:00:00+00:00",
     *       "updated_at": "2024-03-14T12:00:00+00:00"
     *     }
     *   ],
     *   "links": {},
     *   "meta": {}
     * }
     */
    #[QueryParameter('per_page', description: 'Nombre de projets par page', type: 'int', default: 15)]
    #[QueryParameter('search', description: 'Recherche par nom de projet', type: 'string')]
    #[QueryParameter('active', description: 'Filtrer par statut actif/inactif', type: 'boolean')]
    public function index(): AnonymousResourceCollection
    {
        $projects = $this->service->getAll(request()->all());
        return ProjectResource::collection($projects);
    }

    /**
     * Créer un nouveau projet
     *
     * Enregistre un nouveau projet dans le système.
     *
     * @bodyParam name string required Nom du projet. Example: Mon Projet
     * @bodyParam description string Description du projet. Example: Description du projet
     * @bodyParam is_active boolean État actif/inactif du projet. Example: true
     *
     * @response 201 {
     *   "message": "Project created successfully",
     *   "data": {
     *     "id": 1,
     *     "name": "Mon Projet",
     *     "description": "Description du projet",
     *     "is_active": true,
     *     "created_at": "2024-03-14T12:00:00+00:00"
     *   }
     * }
     */
    public function store(CreateProjectRequest $request): JsonResponse
    {
        $project = $this->service->create($request->validated());

        return response()->json([
            'status' => 201,
            'message' => __('projects.created'),
            'data' => new ProjectResource($project)
        ], 201);
    }

    /**
     * Afficher un projet
     *
     * Retourne les détails d'un projet spécifique.
     *
     * @urlParam project integer required L'ID du projet. Example: 1
     *
     * @response {
     *   "data": {
     *     "id": 1,
     *     "name": "Mon Projet",
     *     "description": "Description du projet",
     *     "is_active": true,
     *     "created_at": "2024-03-14T12:00:00+00:00"
     *   }
     * }
     */
    public function show(Project $project): ProjectResource
    {
        $project = $this->service->findById($project->id);
        return new ProjectResource($project);
    }

    /**
     * Mettre à jour un projet
     *
     * Met à jour les informations d'un projet existant.
     *
     * @urlParam project integer required L'ID du projet. Example: 1
     * @bodyParam name string Nom du projet. Example: Mon Projet
     * @bodyParam description string Description du projet. Example: Description du projet
     * @bodyParam is_active boolean État actif/inactif du projet. Example: true
     *
     * @response {
     *   "message": "Project updated successfully",
     *   "data": {
     *     "id": 1,
     *     "name": "Mon Projet",
     *     "description": "Description du projet",
     *     "is_active": true,
     *     "created_at": "2024-03-14T12:00:00+00:00"
     *   }
     * }
     */
    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $project = $this->service->update($project, $request->validated());

        return response()->json([
            'status' => 200,
            'message' => __('projects.updated'),
            'data' => new ProjectResource($project)
        ]);
    }

    /**
     * Supprimer un projet
     *
     * Supprime définitivement un projet du système.
     *
     * @urlParam project integer required L'ID du projet. Example: 1
     *
     * @response {
     *   "message": "Project deleted successfully"
     * }
     */
    public function destroy(Project $project): JsonResponse
    {
        $this->service->delete($project);

        return response()->json([
            'status' => 204,
            'message' => __('projects.deleted')
        ], 204);
    }

    /**
     * Bascule le statut actif/inactif d'un projet
     *
     * @param Project $project Le projet dont le statut doit être modifié
     * @return JsonResponse
     */
    public function toggleStatus(Project $project): JsonResponse
    {
        $this->authorize('update', $project);

        $project->update(['active' => !$project->active]);

        return response()->json([
            'status' => 200,
            'message' => $project->active ? __('projects.status_activated') : __('projects.status_deactivated'),
            'data' => new ProjectResource($project)
        ]);
    }
}
