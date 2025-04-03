<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
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
            'current_password' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!Hash::check($value, $this->user()->password)) {
                    $fail('Le mot de passe actuel est incorrect.');
                }
            }],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
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
            'current_password.required' => 'Le mot de passe actuel est requis.',
            'password.required' => 'Le nouveau mot de passe est requis.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        ];
    }
}
