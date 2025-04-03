<?php

namespace App\Http\Requests\V1\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('projects', 'name')->ignore($this->project)],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['boolean'],
        ];
    }

    /**
     * Messages d'erreur personnalisés.
     */
    public function messages(): array
    {
        return [
            'name.string' => __('api.validation.string', ['attribute' => __('projects.attributes.name')]),
            'name.max' => __('api.max', ['attribute' => __('projects.attributes.name'), 'max' => 255]),
            'name.unique' => __('projects.already_exists'),
            'description.string' => __('api.validation.string', ['attribute' => __('projects.attributes.description')]),
            'description.max' => __('api.max', ['attribute' => __('projects.attributes.description'), 'max' => 1000]),
            'is_active.boolean' => __('api.validation.boolean', ['attribute' => __('projects.attributes.is_active')]),
        ];
    }
}