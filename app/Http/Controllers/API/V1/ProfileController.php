<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Mettre à jour le profil de l'utilisateur.
     */
    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        $user = $request->user();

        // Mise à jour des champs du profil
        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        $user->save();

        return $this->responseSuccess(
            __('profile.updated_successfully'),
            ['user' => $user]
        );
    }

    /**
     * Mettre à jour le mot de passe de l'utilisateur.
     */
    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        $user = $request->user();

        // Mise à jour du mot de passe
        $user->password = Hash::make($request->password);
        $user->save();

        // Déconnecter l'utilisateur de tous les appareils pour des raisons de sécurité
        $user->tokens()->delete();

        return $this->responseSuccess(
            __('profile.password_updated_successfully'),
            ['message' => __('auth.please_login_again')]
        );
    }

    /**
     * Obtenir le profil de l'utilisateur.
     */
    public function show(Request $request): JsonResponse
    {
        $user = $request->user();

        return $this->responseSuccess(
            __('profile.retrieved_successfully'),
            ['user' => $user]
        );
    }
}
