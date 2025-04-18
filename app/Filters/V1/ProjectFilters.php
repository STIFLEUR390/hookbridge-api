<?php

declare(strict_types=1);

namespace App\Filters\V1;

use Essa\APIToolKit\Filters\QueryFilters;
use Essa\APIToolKit\Traits\DateFilter;

final class ProjectFilters extends QueryFilters
{
    use DateFilter;

    protected array $allowedFilters = [
        'id',
        'name',
        'allowed_domain',
        'allowed_subdomain',
        'header',
        'provider_config',
        'uuid',
        'active',
        'type',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected array $columnSearch = [
        'name',
        'allowed_domain',
        'allowed_subdomain',
        'header',
        'uuid',
        'type',
    ];

    protected array $allowedSorts = [
        'id',
        'name',
        'allowed_domain',
        'allowed_subdomain',
        'active',
        'type',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected array $allowedIncludes = [
        'user',
        'projectTargets',
        'incomingRequests',
    ];

    protected array $relationSearch = [
        'user' => ['name', 'email'],
        'projectTargets' => ['url'],
        'incomingRequests' => ['type', 'http_method', 'status'],
    ];

}
