<?php

declare(strict_types=1);

use App\Http\Controllers\API\V1\HookController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/docs/api');
Route::mailPreview();

/*===========================
=           Webhooks           =
=============================*/

// Routes pour les webhooks et callbacks
Route::get('/hook/callback/{uuid}', [HookController::class, 'handleCallback'])->name("hook.callback");
Route::post('/hook/webhook/{uuid}', [HookController::class, 'handleWebhook'])->name("hook.webhook");

// Route de test pour les webhooks (sans vérification)
Route::post('/hook/test', [HookController::class, 'testWebhook']);

/*=====  End of Webhooks   ======*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/
