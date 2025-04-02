<?php

namespace App\Filters\V1;

use Essa\APIToolKit\Filters\QueryFilters;

class DeliveryAttemptFilters extends QueryFilters
{
    protected array $allowedFilters = [
        'incoming_request_id',
        'project_target_id',
        'attempt_count',
        'status',
        'response_code',
        'next_attempt_at',
        'last_attempt_at',
    ];

    protected array $columnSearch = [
        'status',
        'response_body',
    ];

    protected array $allowedSorts = [
        'id',
        'created_at',
        'updated_at',
        'incoming_request_id',
        'project_target_id',
        'attempt_count',
        'status',
        'response_code',
    ];

    protected array $relationSearch = [
        'incomingRequest' => [
            'type',
            'status'
        ],
        'projectTarget' => [
            'url'
        ]
    ];

    protected array $allowedIncludes = [
        'incomingRequest',
        'projectTarget',
    ];
}