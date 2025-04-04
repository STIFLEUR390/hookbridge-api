<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\DeliveryAttempt;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateDeliveryAttemptRequest extends FormRequest
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
            'attempt_count' => ['sometimes', 'integer', 'min:0'],
            'status' => ['sometimes', 'string', Rule::in(['pending', 'in_progress', 'success', 'failed'])],
            'response_code' => ['nullable', 'integer', 'min:100', 'max:599'],
            'response_body' => ['nullable', 'string'],
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
            'attempt_count.integer' => __('api.validation.integer', ['attribute' => __('delivery_attempts.attributes.attempt_count')]),
            'attempt_count.min' => __('api.validation.min', ['attribute' => __('delivery_attempts.attributes.attempt_count'), 'min' => 0]),
            'status.string' => __('api.validation.string', ['attribute' => __('delivery_attempts.attributes.status')]),
            'status.in' => __('api.validation.in', ['attribute' => __('delivery_attempts.attributes.status')]),
            'response_code.integer' => __('api.validation.integer', ['attribute' => __('delivery_attempts.attributes.response_code')]),
            'response_code.min' => __('api.validation.min', ['attribute' => __('delivery_attempts.attributes.response_code'), 'min' => 100]),
            'response_code.max' => __('api.validation.max', ['attribute' => __('delivery_attempts.attributes.response_code'), 'max' => 599]),
            'response_body.string' => __('api.validation.string', ['attribute' => __('delivery_attempts.attributes.response_body')]),
            'next_attempt_at.date' => __('api.validation.date', ['attribute' => __('delivery_attempts.attributes.next_attempt_at')]),
            'last_attempt_at.date' => __('api.validation.date', ['attribute' => __('delivery_attempts.attributes.last_attempt_at')]),
        ];
    }
}
