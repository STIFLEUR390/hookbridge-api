<?php

declare(strict_types=1);

namespace App\Repositories\V1\Project;

use App\Models\V1\Project;
use Illuminate\Pagination\LengthAwarePaginator;

final class ProjectRepository implements ProjectRepositoryInterface
{
    public function __construct(protected Project $model) {}

    public function getAll(array $filters = []): LengthAwarePaginator
    {
        return $this->model
            ->where('user_id', auth()->id())
            ->useFilters()
            ->dynamicPaginate();
    }

    public function findById(int $id): ?Project
    {
        return $this->model
            ->find($id);
    }

    public function create(array $data): Project
    {
        $project = $this->model->create($data);
        return $project;
    }

    public function update(Project $project, array $data): Project
    {
        $project->update($data);
        return $project;
    }

    public function delete(Project $project): bool
    {
        return $project->delete();
    }
}
