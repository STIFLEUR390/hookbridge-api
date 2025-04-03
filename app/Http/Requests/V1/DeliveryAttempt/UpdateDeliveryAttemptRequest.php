<?php

namespace App\Http\Requests\V1\DeliveryAttempt;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDeliveryAttemptRequest extends FormRequest
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
            'status' => ['sometimes', 'string', Rule::in(['pending', 'success', 'failed'])],
            'response_code' => ['nullable', 'integer', 'min:100', 'max:599'],
            'response_body' => ['nullable', 'string'],
            'error_message' => ['nullable', 'string', 'max:1000'],
            'attempted_at' => ['sometimes', 'date'],
        ];
    }

    /**
     * Messages d'erreur personnalisés.
     */
    public function messages(): array
    {
        return [
            'status.string' => __('api.validation.string', ['attribute' => __('delivery_attempts.attributes.status')]),
            'status.in' => __('api.validation.in', ['attribute' => __('delivery_attempts.attributes.status')]),
            'response_code.integer' => __('api.validation.integer', ['attribute' => __('delivery_attempts.attributes.response_code')]),
            'response_code.min' => __('api.min', ['attribute' => __('delivery_attempts.attributes.response_code'), 'min' => 100]),
            'response_code.max' => __('api.max', ['attribute' => __('delivery_attempts.attributes.response_code'), 'max' => 599]),
            'response_body.string' => __('api.validation.string', ['attribute' => __('delivery_attempts.attributes.response_body')]),
            'error_message.string' => __('api.validation.string', ['attribute' => __('delivery_attempts.attributes.error_message')]),
            'error_message.max' => __('api.max', ['attribute' => __('delivery_attempts.attributes.error_message'), 'max' => 1000]),
            'attempted_at.date' => __('api.validation.date', ['attribute' => __('delivery_attempts.attributes.attempted_at')]),
        ];
    }
}
