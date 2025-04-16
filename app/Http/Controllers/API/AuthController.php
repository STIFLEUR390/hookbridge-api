<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

final class AuthController extends Controller
{
    /**
     * Authentifie l'utilisateur et retourne les tokens.
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ( ! $user || ! Hash::check($request->password, $user->password)) {
            return $this->responseUnAuthenticated(
                __('auth.login_failed'),
                __('auth.unauthenticated'),
            );
        }

        // Supprime les tokens existants pour une nouvelle session
        $user->tokens()->delete();
        $user->load('roles');

        // Création du token d'accès en utilisant l'email comme nom
        $token = $user->createToken($user->email, ['*'], now()->addDays(30))->plainTextToken;

    /*
        return $this->responseSuccess(__('auth.login_success'), [
            'token' => $token,
            //'user' => $user,
            //'token_type' => 'Bearer',
        ]);
        */

        return response()->json([
            'token' => $token,
        ], 200);

    }

    /**
     * Rafraîchit le token d'accès.
     */
    public function refreshToken(Request $request)
    {
        $currentToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($currentToken);

        if ( ! $token) {
            return $this->responseUnAuthenticated(
                __('auth.token_invalid'),
                __('auth.unauthenticated'),
            );
        }

        $user = $token->tokenable;
        $token->delete();

        // Création d'un nouveau token en utilisant l'email
        $newToken = $user->createToken($user->email, now()->addDays(30))->plainTextToken;

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
        $user->assignRole('user');

        return $this->responseSuccess(__('auth.register_success'));
    }

    /**
     * Retourne les informations de l'utilisateur connecté.
     */
    public function getUser(Request $request)
    {
        $user = $request->user()->load('roles');
        // new UserResource($request->user()
        return response()->json(new UserResource($user), 200);
    }
}
