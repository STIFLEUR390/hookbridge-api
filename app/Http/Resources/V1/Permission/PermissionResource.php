<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Permission;

use App\Http\Resources\V1\Role\RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;

final class PermissionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'guard_name' => $this->guard_name,
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
            'created_at' => dateTimeFormat($this->created_at),
            'updated_at' => dateTimeFormat($this->updated_at),
        ];
    }
}
