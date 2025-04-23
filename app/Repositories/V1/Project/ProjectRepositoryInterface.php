<?php

declare(strict_types=1);

namespace App\Repositories\V1\Project;

use App\Models\V1\Project;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProjectRepositoryInterface
{
    public function getAll(array $filters = []): LengthAwarePaginator|Collection;
    public function findById(int $id): ?Project;
    public function create(array $data): Project;
    public function update(Project $project, array $data): Project;
    public function delete(Project $project): bool;
}
