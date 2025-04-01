<?php

namespace App\Http\Requests\V1\Project;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'allowed_domain' => ['sometimes', 'required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/'],
            'allowed_subdomain' => ['sometimes', 'nullable', 'string', 'max:255', 'url', 'regex:/^https:\/\/[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9])*(?:\.[a-zA-Z]{2,})+$/'],
            'header' => ['sometimes', 'nullable', 'string', 'max:255'],
            'provider_config' => ['sometimes', 'nullable', 'array'],
            'active' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'allowed_domain.regex' => 'Le domaine doit être valide (exemple: example.com)',
            'allowed_subdomain.regex' => 'Le sous-domaine doit être une URL complète valide (exemple: https://app.example.com)',
            'allowed_subdomain.url' => 'Le sous-domaine doit être une URL valide',
        ];
    }
}
