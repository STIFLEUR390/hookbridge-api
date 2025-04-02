<?php

namespace App\Http\Requests\V1\ProjectTarget;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectTargetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_id' => ['required', 'exists:projects,id'],
            'url' => ['required', 'string', 'max:255', 'url'],
            'requires_authentication' => ['boolean'],
            'secret' => ['nullable', 'string', 'max:255'],
            'active' => ['boolean'],
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