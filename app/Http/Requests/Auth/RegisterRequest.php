<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

final class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => __('auth.name_required'),
            'name.max' => __('auth.name_max'),
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.email_invalid'),
            'email.unique' => __('auth.email_taken'),
            'password.required' => __('auth.password_required'),
            'password.min' => __('auth.password_min'),
            'password.confirmed' => __('auth.password_confirmed'),
        ];
    }
}
