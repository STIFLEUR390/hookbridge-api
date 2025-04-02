<?php

namespace App\Filters\V1;

use Essa\APIToolKit\Filters\QueryFilters;

class ProjectTargetFilters extends QueryFilters
{
    protected array $allowedFilters = [
        'url',
        'requires_authentication',
        'active',
        'project_id',
    ];

    protected array $columnSearch = [
        'url',
    ];

    protected array $allowedSorts = [
        'url',
        'requires_authentication',
        'active',
        'created_at',
        'updated_at',
    ];

    protected array $allowedIncludes = [
        'project',
    ];
}