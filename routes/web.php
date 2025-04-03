<?php

use App\Http\Controllers\API\V1\HookController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/docs/api');

Route::any('hook/callback/{uuid}', [HookController::class, 'handleCallback'])
    ->middleware('validate.project.uuid')->name("hook.callback");

Route::any('hook/webhook/{uuid}', [HookController::class, 'handleWebhook'])
    ->middleware('validate.project.uuid')->name("hook.webhook");

/*
Route::get('/', function () {
    return view('welcome');
});
*/
