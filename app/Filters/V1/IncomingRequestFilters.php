<?php

declare(strict_types=1);

namespace App\Filters\V1;

use Essa\APIToolKit\Filters\QueryFilters;
use Essa\APIToolKit\Traits\DateFilter;

final class IncomingRequestFilters extends QueryFilters
{
    use DateFilter;

    protected array $allowedFilters = [
        'id',
        'project_id',
        'type',
        'http_method',
        'status',
        'received_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected array $columnSearch = [
        'type',
        'http_method',
        'status',
        'payload',
    ];

    protected array $relationSearch = [
        'project' => [
            'name',
            'allowed_domain',
            'allowed_subdomain',
            'user_id'
        ],
        'deliveryAttempts' => [
            'status',
            'response_code',
        ],
    ];

    protected array $allowedIncludes = [
        'project',
        'deliveryAttempts',
    ];

    protected array $allowedSorts = [
        'id',
        'project_id',
        'type',
        'http_method',
        'status',
        'received_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}