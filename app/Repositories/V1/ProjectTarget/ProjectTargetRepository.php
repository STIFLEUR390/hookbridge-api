<?php

namespace App\Repositories\V1\ProjectTarget;

use App\Models\V1\ProjectTarget;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectTargetRepository implements ProjectTargetRepositoryInterface
{
    public function __construct(protected ProjectTarget $model)
    {
    }

    public function getAll(array $filters = []): LengthAwarePaginator
    {
        return $this->model
            ->with(['project'])
            ->useFilters()
            ->dynamicPaginate();
    }

    public function findById(int $id): ?ProjectTarget
    {
        return $this->model
            ->with(['project'])
            ->find($id);
    }

    public function create(array $data): ProjectTarget
    {
        $projectTarget = $this->model->create($data);
        return $projectTarget->load(['project']);
    }

    public function update(ProjectTarget $projectTarget, array $data): ProjectTarget
    {
        $projectTarget->update($data);
        return $projectTarget->load(['project']);
    }

    public function delete(ProjectTarget $projectTarget): bool
    {
        return $projectTarget->delete();
    }
}