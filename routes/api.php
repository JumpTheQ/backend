<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CoverLetterController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PromptController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::apiResource('user', UserController::class)->only('update');
    Route::apiResource('experience', ExperienceController::class);
    Route::apiResource('course', CourseController::class);
    Route::apiResource('language', LanguageController::class);
    Route::apiResource('application', ApplicationController::class);
    Route::apiResource('application.prompt', PromptController::class);
    Route::get('/application/{application}/resume', [ResumeController::class, 'index']);
    Route::get('/application/{application}/resume/{resume}', [ResumeController::class, 'show']);
    Route::get('/application/{application}/resume/{resume}/download', [ResumeController::class, 'download']);
    Route::get('/application/{application}/coverLetter', [CoverLetterController::class, 'index']);
    Route::get('/application/{application}/coverLetter/{coverLetter}', [CoverLetterController::class, 'show']);
    Route::get('/application/{application}/coverLetter/{coverLetter}/download', [CoverLetterController::class, 'download']);
});
