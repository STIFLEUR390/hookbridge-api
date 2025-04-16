<?php

declare(strict_types=1);

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\V1\DashboardController;
use App\Http\Controllers\API\V1\HookController;
use App\Http\Controllers\API\V1\PasswordResetController;
use App\Http\Controllers\API\V1\PermissionController;
use App\Http\Controllers\API\V1\ProfileController;
use App\Http\Controllers\API\V1\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

// Routes d'authentification
Route::prefix('auth')->group(function (): void {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/refresh', [AuthController::class, 'refreshToken']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

    // Routes de réinitialisation de mot de passe
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink']);
    Route::post('/reset-password', [PasswordResetController::class, 'reset']);
});

// Routes protégées
Route::middleware(['auth:sanctum'])->group(function (): void {
    Route::get('/user', function (Request $request) {
        $user = $request->user()->load('roles', 'permissions');
        return new UserResource($request->user());
    })->middleware('auth:sanctum');

    // Routes du profil utilisateur
    Route::prefix('profile')->group(function (): void {
        Route::get('/', [ProfileController::class, 'show']);
        Route::put('/', [ProfileController::class, 'updateProfile']);
        Route::put('/password', [ProfileController::class, 'updatePassword']);
    });

    // Routes des rôles
    Route::middleware(['permission:view roles'])->group(function (): void {
        Route::apiResource('/roles', RoleController::class)->only(['index', 'show']);
        Route::post('/roles', [RoleController::class, 'store'])->middleware('permission:create roles');
        Route::put('/roles/{role}', [RoleController::class, 'update'])->middleware('permission:edit roles');
        Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->middleware('permission:delete roles');
    });

    // Routes des permissions
    Route::middleware(['permission:view permissions'])->group(function (): void {
        Route::apiResource('/permissions', PermissionController::class)->only(['index', 'show']);
        Route::post('/permissions', [PermissionController::class, 'store'])->middleware('permission:create permissions');
        Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->middleware('permission:edit permissions');
        Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->middleware('permission:delete permissions');
    });

    // Routes des projets
    Route::middleware(['permission:view projects'])->group(function (): void {
        Route::apiResource('/projects', App\Http\Controllers\API\V1\ProjectController::class);
        Route::patch('/projects/{project}/toggle-status', [App\Http\Controllers\API\V1\ProjectController::class, 'toggleStatus'])
            ->middleware('permission:edit projects');
    });

    // Routes des cibles de projet
    Route::middleware(['permission:view project targets'])->group(function (): void {
        Route::apiResource('/project-targets', App\Http\Controllers\API\V1\ProjectTargetController::class);
        Route::patch('/project-targets/{target}/toggle-status', [App\Http\Controllers\API\V1\ProjectTargetController::class, 'toggleStatus'])
            ->middleware('permission:edit project targets');
    });

    // Routes des requêtes entrantes
    Route::middleware(['permission:view incoming requests'])->group(function (): void {
        Route::apiResource('/incoming-requests', App\Http\Controllers\API\V1\IncomingRequestController::class)->only(['index', 'show']);
        Route::post('/incoming-requests/{incomingRequest}/retry', [HookController::class, 'retrySendingWebhook'])
            ->middleware('permission:edit incoming requests');
    });

    // Routes des tentatives de livraison
    Route::middleware(['permission:view delivery attempts'])->group(function (): void {
        Route::apiResource('/deliveryAttempts', App\Http\Controllers\API\V1\DeliveryAttemptController::class)->only(['index', 'show']);
    });

    // Routes du dashboard
    Route::prefix('dashboard')->group(function (): void {
        Route::get('/stats', [DashboardController::class, 'getGlobalStats']);
        Route::get('/webhook-activity', [DashboardController::class, 'getWebhookActivity']);
        Route::get('/response-times', [DashboardController::class, 'getResponseTimes']);
    });
});