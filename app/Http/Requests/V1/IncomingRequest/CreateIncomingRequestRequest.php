<?php

namespace App\Http\Requests\V1\IncomingRequest;

use Illuminate\Foundation\Http\FormRequest;

class CreateIncomingRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_id' => ['required', 'exists:projects,id'],
            'type' => ['required', 'string', 'in:callback,webhook'],
            'http_method' => ['required', 'string', 'in:GET,POST'],
            'headers' => ['nullable', 'array'],
            'payload' => ['nullable', 'array'],
            'status' => ['required', 'string', 'in:new,processing,processed,failed'],
            'received_at' => ['required', 'date'],
        ];
    }
}
