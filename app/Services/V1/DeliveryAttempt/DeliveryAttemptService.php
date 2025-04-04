<?php

declare(strict_types=1);

namespace App\Services\V1\DeliveryAttempt;

use App\Models\V1\DeliveryAttempt;
use App\Repositories\V1\DeliveryAttempt\DeliveryAttemptRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

final class DeliveryAttemptService
{
    public function __construct(
        protected DeliveryAttemptRepositoryInterface $repository,
    ) {}

    public function getAll(array $filters = []): LengthAwarePaginator
    {
        return $this->repository->getAll($filters);
    }

    public function findById(int $id): ?DeliveryAttempt
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): DeliveryAttempt
    {
        return $this->repository->create($data);
    }

    public function update(DeliveryAttempt $deliveryAttempt, array $data): DeliveryAttempt
    {
        return $this->repository->update($deliveryAttempt, $data);
    }

    public function delete(DeliveryAttempt $deliveryAttempt): bool
    {
        return $this->repository->delete($deliveryAttempt);
    }
}
