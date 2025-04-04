<?php

namespace App\Services\V1\Project;

use App\Models\V1\Project;
use App\Repositories\V1\Project\ProjectRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class ProjectService
{
    public function __construct(
        protected ProjectRepositoryInterface $repository
    ) {
    }

    public function getAll(array $filters = []): LengthAwarePaginator
    {
        return $this->repository->getAll($filters);
    }

    public function findById(int $id): ?Project
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): Project
    {
        $data['uuid'] = Str::uuid()->toString();
        $data['user_id'] = auth()->id();
        return $this->repository->create($data);
    }

    public function update(Project $project, array $data): Project
    {
        return $this->repository->update($project, $data);
    }

    public function delete(Project $project): bool
    {
        return $this->repository->delete($project);
    }
}