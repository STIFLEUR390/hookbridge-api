<?php

declare(strict_types=1);

namespace App\Repositories\V1\DeliveryAttempt;

use App\Models\V1\DeliveryAttempt;
use Illuminate\Pagination\LengthAwarePaginator;

final class DeliveryAttemptRepository implements DeliveryAttemptRepositoryInterface
{
    public function __construct(protected DeliveryAttempt $model) {}

    public function getAll(array $filters = []): LengthAwarePaginator
    {
        return $this->model
            ->with(['incomingRequest', 'projectTarget'])
            ->useFilters()
            ->dynamicPaginate();
    }

    public function findById(int $id): ?DeliveryAttempt
    {
        return $this->model
            ->with(['incomingRequest', 'projectTarget'])
            ->find($id);
    }

    public function create(array $data): DeliveryAttempt
    {
        $deliveryAttempt = $this->model->create($data);
        return $deliveryAttempt->load(['incomingRequest', 'projectTarget']);
    }

    public function update(DeliveryAttempt $deliveryAttempt, array $data): DeliveryAttempt
    {
        $deliveryAttempt->update($data);
        return $deliveryAttempt->load(['incomingRequest', 'projectTarget']);
    }

    public function delete(DeliveryAttempt $deliveryAttempt): bool
    {
        return $deliveryAttempt->delete();
    }
}
