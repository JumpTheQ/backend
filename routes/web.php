<?php

use App\Http\Controllers\CoverLetterController;
use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/coverletter/{coverLetter}', [CoverLetterController::class, 'show']);
Route::get('/coverletter/{coverLetter}/download', [CoverLetterController::class, 'download']);
Route::get('/resume/{resume}', [ResumeController::class, 'show']);
Route::get('/resume/{resume}/download', [ResumeController::class, 'download']);

require __DIR__.'/auth.php';
