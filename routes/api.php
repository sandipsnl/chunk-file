<?php

use Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::post('/upload-large-file', [UploadController::class, 'uploadLargeFile']);
