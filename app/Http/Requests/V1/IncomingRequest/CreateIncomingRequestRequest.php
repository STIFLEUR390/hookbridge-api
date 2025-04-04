<?php

namespace App\Http\Requests\V1\IncomingRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateIncomingRequestRequest extends FormRequest
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
            'project_id' => ['required', 'exists:projects,id'],
            'type' => ['required', 'string', Rule::in(['callback', 'webhook'])],
            'http_method' => ['required', 'string', Rule::in(['GET', 'POST'])],
            'headers' => ['nullable', 'array'],
            'payload' => ['nullable', 'array'],
            'status' => ['required', 'string', Rule::in(['new', 'processing', 'processed', 'failed'])],
            'received_at' => ['required', 'date'],
        ];
    }

    /**
     * Messages d'erreur personnalisés.
     */
    public function messages(): array
    {
        return [
            'project_id.required' => __('api.validation.required', ['attribute' => __('incoming_requests.attributes.project_id')]),
            'project_id.exists' => __('api.validation.exists', ['attribute' => __('incoming_requests.attributes.project_id')]),
            'type.required' => __('api.validation.required', ['attribute' => __('incoming_requests.attributes.type')]),
            'type.string' => __('api.validation.string', ['attribute' => __('incoming_requests.attributes.type')]),
            'type.in' => __('api.validation.in', ['attribute' => __('incoming_requests.attributes.type')]),
            'http_method.required' => __('api.validation.required', ['attribute' => __('incoming_requests.attributes.http_method')]),
            'http_method.string' => __('api.validation.string', ['attribute' => __('incoming_requests.attributes.http_method')]),
            'http_method.in' => __('api.validation.in', ['attribute' => __('incoming_requests.attributes.http_method')]),
            'headers.array' => __('api.validation.array', ['attribute' => __('incoming_requests.attributes.headers')]),
            'payload.array' => __('api.validation.array', ['attribute' => __('incoming_requests.attributes.payload')]),
            'status.required' => __('api.validation.required', ['attribute' => __('incoming_requests.attributes.status')]),
            'status.string' => __('api.validation.string', ['attribute' => __('incoming_requests.attributes.status')]),
            'status.in' => __('api.validation.in', ['attribute' => __('incoming_requests.attributes.status')]),
            'received_at.required' => __('api.validation.required', ['attribute' => __('incoming_requests.attributes.received_at')]),
            'received_at.date' => __('api.validation.date', ['attribute' => __('incoming_requests.attributes.received_at')]),
        ];
    }
}
