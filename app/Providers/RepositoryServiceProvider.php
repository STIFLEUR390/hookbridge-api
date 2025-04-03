<?php

namespace App\Providers;

use App\Repositories\V1\DeliveryAttempt\DeliveryAttemptRepository;
use App\Repositories\V1\DeliveryAttempt\DeliveryAttemptRepositoryInterface;
use App\Repositories\V1\IncomingRequest\IncomingRequestRepository;
use App\Repositories\V1\IncomingRequest\IncomingRequestRepositoryInterface;
use App\Repositories\V1\Project\ProjectRepository;
use App\Repositories\V1\Project\ProjectRepositoryInterface;
use App\Repositories\V1\ProjectTarget\ProjectTargetRepository;
use App\Repositories\V1\ProjectTarget\ProjectTargetRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DeliveryAttemptRepositoryInterface::class, DeliveryAttemptRepository::class);
        $this->app->bind(IncomingRequestRepositoryInterface::class, IncomingRequestRepository::class);
        $this->app->bind(ProjectTargetRepositoryInterface::class, ProjectTargetRepository::class);
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
    }
}
