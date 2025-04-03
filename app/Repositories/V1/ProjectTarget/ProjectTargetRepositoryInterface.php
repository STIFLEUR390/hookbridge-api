<?php

namespace App\Repositories\V1\ProjectTarget;

use App\Models\V1\ProjectTarget;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProjectTargetRepositoryInterface
{
    public function getAll(array $filters = []): LengthAwarePaginator;
    public function findById(int $id): ?ProjectTarget;
    public function create(array $data): ProjectTarget;
    public function update(ProjectTarget $projectTarget, array $data): ProjectTarget;
    public function delete(ProjectTarget $projectTarget): bool;
}