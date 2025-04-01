<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Project\CreateProjectRequest;
use App\Http\Requests\V1\Project\UpdateProjectRequest;
use App\Http\Resources\V1\Project\ProjectResource;
use App\Models\V1\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Dedoc\Scramble\Attributes\Group;
use Dedoc\Scramble\Attributes\QueryParameter;

/**
 * Gestion des projets HookBridge
 *
 * Ce contrôleur permet de gérer les projets, y compris leur création, modification,
 * suppression et activation/désactivation.
 */
#[Group('Projets', weight: 1)]
class ProjectController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Liste tous les projets de l'utilisateur authentifié
     *
     * @param int $per_page Nombre d'éléments par page
     * @param string $search Recherche par nom de projet
     * @param bool $active Filtrer par statut actif/inactif
     *
     * @return AnonymousResourceCollection
     */
    #[QueryParameter('per_page', description: 'Nombre de projets par page', type: 'int', default: 15)]
    #[QueryParameter('search', description: 'Recherche par nom de projet', type: 'string')]
    #[QueryParameter('active', description: 'Filtrer par statut actif/inactif', type: 'boolean')]
    public function index(): AnonymousResourceCollection
    {
        $projects = Project::useFilters()
            ->where('user_id', Auth::id())
            ->dynamicPaginate();

        return ProjectResource::collection($projects);
    }

    /**
     * Crée un nouveau projet
     *
     * @param CreateProjectRequest $request
     * @return JsonResponse
     */
    public function store(CreateProjectRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['uuid'] = Str::uuid();

        $project = Project::create($data);

        return $this->responseCreated(
            'Projet créé avec succès',
            new ProjectResource($project)
        );
    }

    /**
     * Affiche les détails d'un projet spécifique
     *
     * @param Project $project Le projet à afficher
     * @return JsonResponse
     */
    public function show(Project $project): JsonResponse
    {
        $this->authorize('view', $project);

        return $this->responseSuccess(
            'Détails du projet récupérés avec succès',
            new ProjectResource($project)
        );
    }

    /**
     * Met à jour un projet existant
     *
     * @param UpdateProjectRequest $request
     * @param Project $project Le projet à mettre à jour
     * @return JsonResponse
     */
    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $this->authorize('update', $project);

        $project->update($request->validated());

        return $this->responseSuccess(
            'Projet mis à jour avec succès',
            new ProjectResource($project)
        );
    }

    /**
     * Supprime un projet
     *
     * @param Project $project Le projet à supprimer
     * @return JsonResponse
     */
    public function destroy(Project $project): JsonResponse
    {
        $this->authorize('delete', $project);

        $project->delete();

        return $this->responseDeleted();
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

        return $this->responseSuccess(
            $project->active ? 'Projet activé avec succès' : 'Projet désactivé avec succès',
            new ProjectResource($project)
        );
    }
}