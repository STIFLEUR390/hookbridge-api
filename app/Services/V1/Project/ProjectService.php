<?php

declare(strict_types=1);

namespace App\Services\V1\Project;

use App\Models\V1\Project;
use App\Repositories\V1\Project\ProjectRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

final class ProjectService
{
    public function __construct(
        protected ProjectRepositoryInterface $repository,
    ) {}

    public function getAll(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
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
        $data['user_id'] = Auth::id();
        if (isset($data['provider_config']['require_signature']) && $data['provider_config']['require_signature'] == true) {
            $data['provider_config']['signature_hash'] = hash('sha256', uniqid((string) mt_rand(), true));
        }
        return $this->repository->create($data);
    }

    public function update(Project $project, array $data): Project
    {
        if (
            isset($data['provider_config']['require_signature']) &&
            $data['provider_config']['require_signature'] == true &&
            in_array($project->provider_config['signature_hash'], [null, '', 'null'])
        ) {
            $data['provider_config']['signature_hash'] = hash('sha256', uniqid((string) mt_rand(), true));
        }
        return $this->repository->update($project, $data);
    }

    public function delete(Project $project): bool
    {
        return $this->repository->delete($project);
    }
}