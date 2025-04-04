<?php

declare(strict_types=1);

namespace App\Services\V1\IncomingRequest;

use App\Models\V1\IncomingRequest;
use App\Repositories\V1\IncomingRequest\IncomingRequestRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

final class IncomingRequestService
{
    public function __construct(
        protected IncomingRequestRepositoryInterface $repository,
    ) {}

    public function getAll(array $filters = []): LengthAwarePaginator
    {
        return $this->repository->getAll($filters);
    }

    public function findById(int $id): ?IncomingRequest
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): IncomingRequest
    {
        return $this->repository->create($data);
    }

    public function update(IncomingRequest $incomingRequest, array $data): IncomingRequest
    {
        return $this->repository->update($incomingRequest, $data);
    }

    public function delete(IncomingRequest $incomingRequest): bool
    {
        return $this->repository->delete($incomingRequest);
    }
}
