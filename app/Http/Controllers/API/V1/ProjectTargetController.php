<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ProjectTarget\CreateProjectTargetRequest;
use App\Http\Requests\V1\ProjectTarget\UpdateProjectTargetRequest;
use App\Http\Resources\V1\ProjectTarget\ProjectTargetResource;
use App\Models\V1\ProjectTarget;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Dedoc\Scramble\Attributes\Group;
use Dedoc\Scramble\Attributes\QueryParameter;

/**
 * Gestion des cibles de projet HookBridge
 *
 * Ce contrôleur permet de gérer les cibles de webhook pour chaque projet.
 */
#[Group('Cibles de Projet', weight: 2)]
class ProjectTargetController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Liste toutes les cibles d'un projet
     *
     * @param int $per_page Nombre d'éléments par page
     * @param string $search Recherche par URL
     * @param bool $active Filtrer par statut actif/inactif
     * @param int $project_id Filtrer par projet
     *
     * @return AnonymousResourceCollection
     */
    #[QueryParameter('per_page', description: 'Nombre de cibles par page', type: 'int', default: 15)]
    #[QueryParameter('search', description: 'Recherche par URL', type: 'string')]
    #[QueryParameter('active', description: 'Filtrer par statut actif/inactif', type: 'boolean')]
    #[QueryParameter('project_id', description: 'ID du projet', type: 'int')]
    public function index(): AnonymousResourceCollection
    {
        $targets = ProjectTarget::useFilters()
            ->dynamicPaginate();

        return ProjectTargetResource::collection($targets);
    }

    /**
     * Crée une nouvelle cible de projet
     *
     * @param CreateProjectTargetRequest $request
     * @return JsonResponse
     */
    public function store(CreateProjectTargetRequest $request): JsonResponse
    {
        $target = ProjectTarget::create($request->validated());

        return $this->responseCreated(
            'Cible de projet créée avec succès',
            new ProjectTargetResource($target)
        );
    }

    /**
     * Affiche les détails d'une cible spécifique
     *
     * @param ProjectTarget $target La cible à afficher
     * @return JsonResponse
     */
    public function show(ProjectTarget $target): JsonResponse
    {
        $this->authorize('view', $target);

        return $this->responseSuccess(
            'Détails de la cible récupérés avec succès',
            new ProjectTargetResource($target)
        );
    }

    /**
     * Met à jour une cible existante
     *
     * @param UpdateProjectTargetRequest $request
     * @param ProjectTarget $target La cible à mettre à jour
     * @return JsonResponse
     */
    public function update(UpdateProjectTargetRequest $request, ProjectTarget $target): JsonResponse
    {
        $this->authorize('update', $target);

        $target->update($request->validated());

        return $this->responseSuccess(
            'Cible mise à jour avec succès',
            new ProjectTargetResource($target)
        );
    }

    /**
     * Supprime une cible
     *
     * @param ProjectTarget $target La cible à supprimer
     * @return JsonResponse
     */
    public function destroy(ProjectTarget $target): JsonResponse
    {
        $this->authorize('delete', $target);

        $target->delete();

        return $this->responseDeleted();
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

        $target->update(['active' => !$target->active]);

        return $this->responseSuccess(
            $target->active ? 'Cible activée avec succès' : 'Cible désactivée avec succès',
            new ProjectTargetResource($target)
        );
    }
}
