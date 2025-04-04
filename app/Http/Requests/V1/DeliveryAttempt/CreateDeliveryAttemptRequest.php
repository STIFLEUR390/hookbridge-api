<?php

namespace App\Http\Requests\V1\DeliveryAttempt;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateDeliveryAttemptRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation pour la requête.
     */
    public function rules(): array
    {
        return [
            'incoming_request_id' => ['required', 'exists:incoming_requests,id'],
            'project_target_id' => ['required', 'exists:project_targets,id'],
            'attempt_count' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'string', Rule::in(['pending', 'in_progress', 'success', 'failed'])],
            'response_code' => ['nullable', 'integer', 'min:100', 'max:599'],
            'response_body' => ['nullable', 'string'],
            'error_message' => ['nullable', 'string', 'max:1000'],
            'attempted_at' => ['required', 'date'],
            'next_attempt_at' => ['nullable', 'date'],
            'last_attempt_at' => ['nullable', 'date'],
        ];
    }

    /**
     * Messages d'erreur personnalisés.
     */
    public function messages(): array
    {
        return [
            'incoming_request_id.required' => __('api.validation.required', ['attribute' => __('delivery_attempts.attributes.incoming_request_id')]),
            'incoming_request_id.exists' => __('api.validation.exists', ['attribute' => __('delivery_attempts.attributes.incoming_request_id')]),
            'project_target_id.required' => __('api.validation.required', ['attribute' => __('delivery_attempts.attributes.project_target_id')]),
            'project_target_id.exists' => __('api.validation.exists', ['attribute' => __('delivery_attempts.attributes.project_target_id')]),
            'attempt_count.required' => __('api.validation.required', ['attribute' => __('delivery_attempts.attributes.attempt_count')]),
            'attempt_count.integer' => __('api.validation.integer', ['attribute' => __('delivery_attempts.attributes.attempt_count')]),
            'attempt_count.min' => __('api.validation.min', ['attribute' => __('delivery_attempts.attributes.attempt_count'), 'min' => 0]),
            'status.required' => __('api.validation.required', ['attribute' => __('delivery_attempts.attributes.status')]),
            'status.string' => __('api.validation.string', ['attribute' => __('delivery_attempts.attributes.status')]),
            'status.in' => __('api.validation.in', ['attribute' => __('delivery_attempts.attributes.status')]),
            'response_code.integer' => __('api.validation.integer', ['attribute' => __('delivery_attempts.attributes.response_code')]),
            'response_code.min' => __('api.validation.min', ['attribute' => __('delivery_attempts.attributes.response_code'), 'min' => 100]),
            'response_code.max' => __('api.validation.max', ['attribute' => __('delivery_attempts.attributes.response_code'), 'max' => 599]),
            'response_body.string' => __('api.validation.string', ['attribute' => __('delivery_attempts.attributes.response_body')]),
            'error_message.string' => __('api.validation.string', ['attribute' => __('delivery_attempts.attributes.error_message')]),
            'error_message.max' => __('api.validation.max', ['attribute' => __('delivery_attempts.attributes.error_message'), 'max' => 1000]),
            'attempted_at.required' => __('api.validation.required', ['attribute' => __('delivery_attempts.attributes.attempted_at')]),
            'attempted_at.date' => __('api.validation.date', ['attribute' => __('delivery_attempts.attributes.attempted_at')]),
            'next_attempt_at.date' => __('api.validation.date', ['attribute' => __('delivery_attempts.attributes.next_attempt_at')]),
            'last_attempt_at.date' => __('api.validation.date', ['attribute' => __('delivery_attempts.attributes.last_attempt_at')]),
        ];
    }
}
