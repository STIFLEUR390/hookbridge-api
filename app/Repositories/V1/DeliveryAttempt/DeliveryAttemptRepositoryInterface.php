<?php

declare(strict_types=1);

namespace App\Repositories\V1\DeliveryAttempt;

use App\Models\V1\DeliveryAttempt;
use Illuminate\Pagination\LengthAwarePaginator;

interface DeliveryAttemptRepositoryInterface
{
    public function getAll(array $filters = []): LengthAwarePaginator;
    public function findById(int $id): ?DeliveryAttempt;
    public function create(array $data): DeliveryAttempt;
    public function update(DeliveryAttempt $deliveryAttempt, array $data): DeliveryAttempt;
    public function delete(DeliveryAttempt $deliveryAttempt): bool;
}
