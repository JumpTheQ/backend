<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CoverLetterController;
use App\Http\Controllers\PromptController;
use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;

Route::apiResource('application', ApplicationController::class);
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::apiResource('application.prompt', PromptController::class);
    Route::get('/application/{application}/resume', [ResumeController::class, 'index']);
    Route::get('/application/{application}/resume/{resume}', [ResumeController::class, 'show']);
    Route::get('/application/{application}/resume/{resume}/download', [ResumeController::class, 'download']);
    Route::get('/application/{application}/coverLetter', [CoverLetterController::class, 'index']);
    Route::get('/application/{application}/coverLetter/{coverLetter}', [CoverLetterController::class, 'show']);
    Route::get('/application/{application}/coverLetter/{coverLetter}/download', [CoverLetterController::class, 'download']);
});
