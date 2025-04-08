<?php

declare(strict_types=1);

namespace App\Models\V1;

use App\Filters\V1\RoleFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class Role extends \Spatie\Permission\Models\Role
{
    use Filterable;
    use HasFactory;

    protected string $default_filters = RoleFilters::class;

}
