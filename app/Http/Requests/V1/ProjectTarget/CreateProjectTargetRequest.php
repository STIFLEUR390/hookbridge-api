<?php

namespace App\Http\Requests\V1\ProjectTarget;

use Illuminate\Foundation\Http\FormRequest;

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
            'url' => ['required', 'url', 'max:255'],
            'requires_authentication' => ['boolean'],
            'secret' => ['nullable', 'string', 'max:255'],
            'active' => ['boolean'],
        ];
    }

    /**
     * Messages d'erreur personnalisés.
     */
    public function messages(): array
    {
        return [
            'project_id.required' => __('api.validation.required', ['attribute' => __('project_targets.attributes.project_id')]),
            'project_id.exists' => __('api.validation.exists', ['attribute' => __('project_targets.attributes.project_id')]),
            'url.required' => __('api.validation.required', ['attribute' => __('project_targets.attributes.url')]),
            'url.url' => __('api.validation.url', ['attribute' => __('project_targets.attributes.url')]),
            'url.max' => __('api.validation.max', ['attribute' => __('project_targets.attributes.url'), 'max' => 255]),
            'requires_authentication.boolean' => __('api.validation.boolean', ['attribute' => __('project_targets.attributes.requires_authentication')]),
            'secret.string' => __('api.validation.string', ['attribute' => __('project_targets.attributes.secret')]),
            'secret.max' => __('api.validation.max', ['attribute' => __('project_targets.attributes.secret'), 'max' => 255]),
            'active.boolean' => __('api.validation.boolean', ['attribute' => __('project_targets.attributes.active')]),
        ];
    }
}