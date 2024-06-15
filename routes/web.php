<?php

use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

// view our form page
Route::get('/', [UploadController::class, 'indexUpload' ]);

Route::get('/dakujeme', [UploadController::class, 'thanks' ]);

// handle form request
Route::post('/upload-submit', [UploadController::class, 'submitUpload' ]);
