<?php

declare(strict_types=1);

namespace App\Filters\V1;

use Essa\APIToolKit\Filters\QueryFilters;

final class PermissionFilters extends QueryFilters
{
    protected array $allowedFilters = [
        'name',
        'guard_name',
    ];

    protected array $columnSearch = [
        'name',
        'guard_name',
    ];
}
