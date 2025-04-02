<?php

namespace App\Http\Requests\V1\DeliveryAttempt;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryAttemptRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'attempt_count' => ['sometimes', 'integer', 'min:0'],
            'status' => ['sometimes', 'string', 'in:pending,in_progress,success,failed'],
            'response_code' => ['nullable', 'integer', 'min:100', 'max:599'],
            'response_body' => ['nullable', 'string'],
            'next_attempt_at' => ['nullable', 'date'],
            'last_attempt_at' => ['nullable', 'date'],
        ];
    }
}
