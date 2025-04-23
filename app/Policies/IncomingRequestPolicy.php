<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Models\V1\IncomingRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

final class IncomingRequestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, IncomingRequest $incomingRequest): bool
    {
        return $user->hasRole('admin') || $user->id === $incomingRequest->project->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('admin') || true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, IncomingRequest $incomingRequest): bool
    {
        return $user->hasRole('admin') || $user->id === $incomingRequest->project->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, IncomingRequest $incomingRequest): bool
    {
        return $user->hasRole('admin') || $user->id === $incomingRequest->project->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, IncomingRequest $incomingRequest): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, IncomingRequest $incomingRequest): bool
    {
        return $user->hasRole('admin');
    }
}
