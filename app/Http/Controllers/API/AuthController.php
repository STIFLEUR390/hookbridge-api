<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    /**
     * Authentifie l'utilisateur et retourne les tokens.
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->responseUnAuthenticated(
                __('auth.login_failed'),
                __('auth.unauthenticated')
            );
        }

        // Supprime les tokens existants pour une nouvelle session
        $user->tokens()->delete();

        // Création du token d'accès en utilisant l'email comme nom
        $token = $user->createToken($user->email)->plainTextToken;

        return $this->responseSuccess(__('auth.login_success'), [
            'token' => $token,
            'user' => $user,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Rafraîchit le token d'accès.
     */
    public function refreshToken(Request $request)
    {
        $currentToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($currentToken);

        if (!$token) {
            return $this->responseUnAuthenticated(
                __('auth.token_invalid'),
                __('auth.unauthenticated')
            );
        }

        $user = $token->tokenable;
        $token->delete();

        // Création d'un nouveau token en utilisant l'email
        $newToken = $user->createToken($user->email)->plainTextToken;

        return $this->responseSuccess(__('auth.token_refreshed'), [
            'token' => $newToken,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Déconnecte l'utilisateur en supprimant tous ses tokens.
     */
    public function logout(Request $request)
    {
        // Supprime le token actuel
        $request->user()->currentAccessToken()->delete();

        return $this->responseSuccess(__('auth.logout_success'));
    }

    /**
     * Déconnecte l'utilisateur de tous les appareils.
     */
    public function logoutAllDevices(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->responseSuccess(__('auth.logout_all_success'));
    }

    /**
     * Crée un nouveau compte utilisateur.
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Création du token d'accès
        $token = $user->createToken($user->email)->plainTextToken;

        return $this->responseSuccess(__('auth.register_success'), [
            'token' => $token,
            'user' => $user,
            'token_type' => 'Bearer',
        ]);
    }
}
