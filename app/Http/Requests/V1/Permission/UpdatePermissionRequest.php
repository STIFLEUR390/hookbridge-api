<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdatePermissionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', Rule::unique('permissions')->ignore($this->permission)],
            //'guard_name' => ['sometimes', 'string'],
        ];
    }
}
