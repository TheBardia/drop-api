<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/upload', [FileUploadController::class, 'upload']);

Route::get('/drops/{id}', [FileUploadController::class, 'getDrop']);

Route::get('/users/{userId}/drops', [FileUploadController::class, 'getDropsByUser']);
