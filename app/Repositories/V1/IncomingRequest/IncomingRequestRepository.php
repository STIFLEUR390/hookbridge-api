<?php

declare(strict_types=1);

namespace App\Repositories\V1\IncomingRequest;

use App\Models\V1\IncomingRequest;
use App\Traits\HasProjectIds;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

final class IncomingRequestRepository implements IncomingRequestRepositoryInterface
{
    use HasProjectIds;

    public function __construct(protected IncomingRequest $model) {}

    public function getAll(array $filters = []): LengthAwarePaginator
    {
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            $projectIds = $this->getProjectIds($user->id)->toArray();
            return $this->model
                ->whereIn('project_id', $projectIds)
                ->useFilters()
                ->dynamicPaginate();
        } elseif ($user->hasRole('admin') && isset($filters['user_id'])) {
            $projectIds = $this->getProjectIds($filters['user_id'])->toArray();
            return $this->model
                ->whereIn('project_id', $projectIds)
                ->useFilters()
                ->dynamicPaginate();
        }
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