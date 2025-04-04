<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Project;

use App\Enums\ProjectType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CreateProjectRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'allowed_domain' => ['required', 'string', 'max:255'],
            'allowed_subdomain' => ['nullable', 'string', 'max:255'],
            'header' => ['nullable', 'string', 'max:255'],
            'provider_config' => ['nullable', 'array'],
            'uuid' => ['nullable', 'string', 'max:36'],
            'active' => ['boolean'],
            'type' => ['required',  Rule::enum(ProjectType::class)],
        ];
    }

    /**
     * Messages d'erreur personnalisés.
     */
    public function messages(): array
    {
        return [
            'name.required' => __('api.validation.required', ['attribute' => __('projects.attributes.name')]),
            'name.string' => __('api.validation.string', ['attribute' => __('projects.attributes.name')]),
            'name.max' => __('api.validation.max', ['attribute' => __('projects.attributes.name'), 'max' => 255]),
            'allowed_domain.required' => __('api.validation.required', ['attribute' => __('projects.attributes.allowed_domain')]),
            'allowed_domain.string' => __('api.validation.string', ['attribute' => __('projects.attributes.allowed_domain')]),
            'allowed_domain.max' => __('api.validation.max', ['attribute' => __('projects.attributes.allowed_domain'), 'max' => 255]),
            'allowed_subdomain.string' => __('api.validation.string', ['attribute' => __('projects.attributes.allowed_subdomain')]),
            'allowed_subdomain.max' => __('api.validation.max', ['attribute' => __('projects.attributes.allowed_subdomain'), 'max' => 255]),
            'header.string' => __('api.validation.string', ['attribute' => __('projects.attributes.header')]),
            'header.max' => __('api.validation.max', ['attribute' => __('projects.attributes.header'), 'max' => 255]),
            'provider_config.array' => __('api.validation.array', ['attribute' => __('projects.attributes.provider_config')]),
            'uuid.string' => __('api.validation.string', ['attribute' => __('projects.attributes.uuid')]),
            'uuid.max' => __('api.validation.max', ['attribute' => __('projects.attributes.uuid'), 'max' => 36]),
            'active.boolean' => __('api.validation.boolean', ['attribute' => __('projects.attributes.active')]),
            'type.required' => __('api.validation.required', ['attribute' => __('projects.attributes.type')]),
            'type.Illuminate\Validation\Rules\Enum' => __('api.validation.enum', ['attribute' => __('projects.attributes.type')]),
        ];
    }
}
