<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\PromptController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::apiResource('user', UserController::class)->only(['show']);
    Route::apiResource('application', ApplicationController::class);
    Route::apiResource('application.prompt', PromptController::class);
});
