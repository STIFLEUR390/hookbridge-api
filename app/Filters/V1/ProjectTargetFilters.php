<?php

namespace App\Filters\V1;

use Essa\APIToolKit\Filters\QueryFilters;
use Essa\APIToolKit\Traits\DateFilter;

class ProjectTargetFilters extends QueryFilters
{
    use DateFilter;

    protected array $allowedFilters = [
        'id',
        'project_id',
        'url',
        'requires_authentication',
        'secret',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected array $columnSearch = [
        'url',
        'secret',
    ];

    protected array $allowedSorts = [
        'id',
        'project_id',
        'url',
        'requires_authentication',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected array $allowedIncludes = [
        'project',
        'deliveryAttempts',
    ];

    protected array $relationSearch = [
        'project' => ['name', 'allowed_domain', 'allowed_subdomain'],
        'deliveryAttempts' => ['status', 'response_code'],
    ];
}
