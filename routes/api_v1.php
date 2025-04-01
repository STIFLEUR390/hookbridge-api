<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('/projects', \App\Http\Controllers\API\V1\ProjectController::class);
    Route::patch('/projects/{project}/toggle-status', [\App\Http\Controllers\API\V1\ProjectController::class, 'toggleStatus']);
});