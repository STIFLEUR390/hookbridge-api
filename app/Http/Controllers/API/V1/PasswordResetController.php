<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PasswordResetController extends Controller
{
    /**
     * Envoyer un lien de réinitialisation de mot de passe.
     */
    public function sendResetLink(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return $this->responseSuccess(
                __('passwords.sent'),
                ['message' => __('passwords.sent')]
            );
        }

        throw ValidationException::withMessages([
            'email' => [__($status)],
        ]);
    }

    /**
     * Réinitialiser le mot de passe.
     */
    public function reset(Request $request): JsonResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return $this->responseSuccess(
                __('passwords.reset'),
                ['message' => __('passwords.reset')]
            );
        }

        throw ValidationException::withMessages([
            'email' => [__($status)],
        ]);
    }
}
