<?php

namespace App\Filters\V1;

use Essa\APIToolKit\Filters\QueryFilters;

class IncomingRequestFilters extends QueryFilters
{
    protected array $allowedFilters = [
        'project_id',
        'type',
        'http_method',
        'status',
        'received_at',
    ];

    protected array $columnSearch = [
        'type',
        'http_method',
        'status',
    ];

    protected array $relationSearch = [
        'project' => [
            'name',
            'description'
        ]
    ];

    protected array $allowedIncludes = ['project'];

    protected array $allowedSorts = ['id', 'project_id','status', 'received_at', 'created_at', 'updated_at'];
}