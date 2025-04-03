<?php

namespace App\Repositories\V1\Project;

use App\Models\V1\Project;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function __construct(protected Project $model)
    {
    }

    public function getAll(array $filters = []): LengthAwarePaginator
    {
        return $this->model
            ->with(['targets'])
            ->useFilters()
            ->dynamicPaginate();
    }

    public function findById(int $id): ?Project
    {
        return $this->model
            ->with(['targets'])
            ->find($id);
    }

    public function create(array $data): Project
    {
        $project = $this->model->create($data);
        return $project->load(['targets']);
    }

    public function update(Project $project, array $data): Project
    {
        $project->update($data);
        return $project->load(['targets']);
    }

    public function delete(Project $project): bool
    {
        return $project->delete();
    }
}
