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

class ProjectController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(): AnonymousResourceCollection
    {
        $projects = Project::useFilters()
            ->where('user_id', Auth::id())
            ->dynamicPaginate();

        return ProjectResource::collection($projects);
    }

    public function store(CreateProjectRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['uuid'] = Str::uuid();

        $project = Project::create($data);

        return $this->responseCreated('Projet créé avec succès', new ProjectResource($project));
    }

    public function show(Project $project): JsonResponse
    {
        $this->authorize('view', $project);

        return $this->responseSuccess(null, new ProjectResource($project));
    }

    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $this->authorize('update', $project);

        $project->update($request->validated());

        return $this->responseSuccess('Projet mis à jour avec succès', new ProjectResource($project));
    }

    public function destroy(Project $project): JsonResponse
    {
        $this->authorize('delete', $project);

        $project->delete();

        return $this->responseDeleted();
    }

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