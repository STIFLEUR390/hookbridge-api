<?php

namespace App\Http\Requests\V1\ProjectTarget;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProjectTargetRequest extends FormRequest
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
            'type' => ['required', 'string', Rule::in(['webhook', 'callback'])],
            'url' => ['required', 'url', 'max:255'],
            'is_active' => ['boolean'],
        ];
    }

    /**
     * Messages d'erreur personnalisés.
     */
    public function messages(): array
    {
        return [
            'project_id.required' => __('api.required', ['attribute' => __('project_targets.attributes.project_id')]),
            'project_id.exists' => __('api.validation.exists', ['attribute' => __('project_targets.attributes.project_id')]),
            'type.required' => __('api.required', ['attribute' => __('project_targets.attributes.type')]),
            'type.string' => __('api.validation.string', ['attribute' => __('project_targets.attributes.type')]),
            'type.in' => __('api.validation.in', ['attribute' => __('project_targets.attributes.type')]),
            'url.required' => __('api.required', ['attribute' => __('project_targets.attributes.url')]),
            'url.url' => __('api.validation.url', ['attribute' => __('project_targets.attributes.url')]),
            'url.max' => __('api.max', ['attribute' => __('project_targets.attributes.url'), 'max' => 255]),
            'is_active.boolean' => __('api.validation.boolean', ['attribute' => __('project_targets.attributes.is_active')]),
        ];
    }
}
