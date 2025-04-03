<?php

namespace App\Repositories\V1\IncomingRequest;

use App\Models\V1\IncomingRequest;
use Illuminate\Pagination\LengthAwarePaginator;

interface IncomingRequestRepositoryInterface
{
    public function getAll(array $filters = []): LengthAwarePaginator;
    public function findById(int $id): ?IncomingRequest;
    public function create(array $data): IncomingRequest;
    public function update(IncomingRequest $incomingRequest, array $data): IncomingRequest;
    public function delete(IncomingRequest $incomingRequest): bool;
}
