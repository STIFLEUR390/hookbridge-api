<?php

namespace App\Filters\V1;

use Essa\APIToolKit\Filters\QueryFilters;

class ProjectFilters extends QueryFilters
{
    protected array $allowedFilters = [
        'id',
        'name',
        'allowed_domain',
        'allowed_subdomain',
        'header',
        'provider_config',
        'active',
        'user_id',
    ];

    protected array $columnSearch = [
        'name',
        'allowed_domain',
        'allowed_subdomain',
        'header'
    ];

    protected array $allowedSorts = ['id', 'name', 'active', 'created_at', 'updated_at'];

    protected array $allowedIncludes = ['user'];

    protected array $relationSearch = [
        'user' => ['name', 'email']
    ];

}