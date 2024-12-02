<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarModelController;

Route::post('/brands/{id}/models', [CarModelController::class, 'store']);
Route::put('/models/{id}', [CarModelController::class, 'update']);
Route::get('/models', [CarModelController::class, 'index']);
