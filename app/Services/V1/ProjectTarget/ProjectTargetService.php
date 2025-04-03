<?php

namespace App\Services\V1\ProjectTarget;

use App\Models\V1\ProjectTarget;
use App\Repositories\V1\ProjectTarget\ProjectTargetRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectTargetService
{
    public function __construct(
        protected ProjectTargetRepositoryInterface $repository
    ) {
    }

    public function getAll(array $filters = []): LengthAwarePaginator
    {
        return $this->repository->getAll($filters);
    }

    public function findById(int $id): ?ProjectTarget
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): ProjectTarget
    {
        return $this->repository->create($data);
    }

    public function update(ProjectTarget $projectTarget, array $data): ProjectTarget
    {
        return $this->repository->update($projectTarget, $data);
    }

    public function delete(ProjectTarget $projectTarget): bool
    {
        return $this->repository->delete($projectTarget);
    }
}
