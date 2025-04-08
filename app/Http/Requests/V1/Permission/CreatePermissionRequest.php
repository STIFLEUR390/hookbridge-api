<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Permission;

use Illuminate\Foundation\Http\FormRequest;

final class CreatePermissionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:permissions,name'],
            //'guard_name' => ['required', 'string'],
        ];
    }
}
