<?php

namespace App\Filters\V1;

use Essa\APIToolKit\Filters\QueryFilters;
use Essa\APIToolKit\Traits\DateFilter;

class DeliveryAttemptFilters extends QueryFilters
{
    use DateFilter;

    protected array $allowedFilters = [
        'id',
        'incoming_request_id',
        'project_target_id',
        'attempt_count',
        'status',
        'response_code',
        'response_body',
        'next_attempt_at',
        'last_attempt_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected array $columnSearch = [
        'status',
        'response_body',
        'response_code',
    ];

    protected array $allowedSorts = [
        'id',
        'incoming_request_id',
        'project_target_id',
        'attempt_count',
        'status',
        'response_code',
        'next_attempt_at',
        'last_attempt_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected array $relationSearch = [
        'incomingRequest' => [
            'type',
            'http_method',
            'status',
        ],
        'projectTarget' => [
            'url',
            'requires_authentication',
        ],
    ];

    protected array $allowedIncludes = [
        'incomingRequest',
        'projectTarget',
    ];
}
