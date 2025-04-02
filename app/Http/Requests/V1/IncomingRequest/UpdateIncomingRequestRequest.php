<?php

namespace App\Http\Requests\V1\IncomingRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIncomingRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_id' => ['sometimes', 'exists:projects,id'],
            'type' => ['sometimes', 'string', 'in:callback,webhook'],
            'http_method' => ['sometimes', 'string', 'in:GET,POST'],
            'headers' => ['sometimes', 'nullable', 'array'],
            'payload' => ['sometimes', 'nullable', 'array'],
            'status' => ['sometimes', 'string', 'in:new,processing,processed,failed'],
            'received_at' => ['sometimes', 'date'],
        ];
    }
}
