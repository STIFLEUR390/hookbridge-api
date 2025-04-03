<?php

namespace App\Repositories\V1\IncomingRequest;

use App\Models\V1\IncomingRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class IncomingRequestRepository implements IncomingRequestRepositoryInterface
{
    public function __construct(protected IncomingRequest $model)
    {
    }

    public function getAll(array $filters = []): LengthAwarePaginator
    {
        return $this->model
            ->useFilters()
            ->dynamicPaginate();
    }

    public function findById(int $id): ?IncomingRequest
    {
        return $this->model->find($id);
    }

    public function create(array $data): IncomingRequest
    {
        return $this->model->create($data);
    }

    public function update(IncomingRequest $incomingRequest, array $data): IncomingRequest
    {
        $incomingRequest->update($data);
        return $incomingRequest;
    }

    public function delete(IncomingRequest $incomingRequest): bool
    {
        return $incomingRequest->delete();
    }
}
