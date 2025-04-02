<?php

namespace App\Http\Requests\V1\DeliveryAttempt;

use Illuminate\Foundation\Http\FormRequest;

class CreateDeliveryAttemptRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'incoming_request_id' => ['required', 'exists:incoming_requests,id'],
            'project_target_id' => ['required', 'exists:project_targets,id'],
            'attempt_count' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'string', 'in:pending,in_progress,success,failed'],
            'response_code' => ['nullable', 'integer', 'min:100', 'max:599'],
            'response_body' => ['nullable', 'string'],
            'next_attempt_at' => ['nullable', 'date'],
            'last_attempt_at' => ['nullable', 'date'],
        ];
    }
}
