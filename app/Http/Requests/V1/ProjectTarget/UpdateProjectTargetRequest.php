<?php

namespace App\Http\Requests\V1\ProjectTarget;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectTargetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_id' => ['sometimes', 'required', 'exists:projects,id'],
            'url' => ['sometimes', 'required', 'string', 'max:255', 'url'],
            'requires_authentication' => ['sometimes', 'boolean'],
            'secret' => ['sometimes', 'nullable', 'string', 'max:255'],
            'active' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'url.url' => 'L\'URL doit être valide',
            'project_id.exists' => 'Le projet spécifié n\'existe pas',
        ];
    }
}