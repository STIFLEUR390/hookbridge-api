<?php

declare(strict_types=1);

namespace App\Models\V1;

use App\Filters\V1\PermissionFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class Permission extends \Spatie\Permission\Models\Permission
{
    use Filterable;
    use HasFactory;

    protected string $default_filters = PermissionFilters::class;


}
