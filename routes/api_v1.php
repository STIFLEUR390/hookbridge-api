<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\V1\ProfileController;
use App\Http\Controllers\API\V1\PasswordResetController;
use App\Http\Controllers\API\V1\HookController;

// Routes d'authentification
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/refresh', [AuthController::class, 'refreshToken']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

    // Routes de réinitialisation de mot de passe
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink']);
    Route::post('/reset-password', [PasswordResetController::class, 'reset']);
});

// Routes protégées
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Routes du profil utilisateur
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show']);
        Route::put('/', [ProfileController::class, 'updateProfile']);
        Route::put('/password', [ProfileController::class, 'updatePassword']);
    });

    Route::apiResource('/projects', \App\Http\Controllers\API\V1\ProjectController::class);
    Route::patch('/projects/{project}/toggle-status', [\App\Http\Controllers\API\V1\ProjectController::class, 'toggleStatus']);

    Route::apiResource('/project-targets', \App\Http\Controllers\API\V1\ProjectTargetController::class);
    Route::patch('/project-targets/{target}/toggle-status', [\App\Http\Controllers\API\V1\ProjectTargetController::class, 'toggleStatus']);

    Route::apiResource('/incoming-requests', \App\Http\Controllers\API\V1\IncomingRequestController::class)->only(['index', 'show']);

    // Route pour réessayer l'envoi d'un webhook
    Route::post('/incoming-requests/{incomingRequest}/retry', [HookController::class, 'retrySendingWebhook']);

    Route::apiResource('/deliveryAttempts', \App\Http\Controllers\API\V1\DeliveryAttemptController::class)->only(['index', 'show']);

});