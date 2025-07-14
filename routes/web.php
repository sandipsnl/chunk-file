<?php

use Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::prefix('chunk-upload')->group(function () {
    Route::post('/init', [UploadController::class, 'init']);
    Route::post('/upload', [UploadController::class, 'upload']);
    Route::post('/complete', [UploadController::class, 'complete']);
});
