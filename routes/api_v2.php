<?php

use App\Http\Controllers\API\V2\Auth\AuthenticatedSessionController;
use App\Http\Controllers\API\V2\Auth\RegisteredUserController;
use App\Http\Controllers\API\V2\UrlController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    Route::post('/urls', [UrlController::class, 'store']);
    Route::get('/urls', [UrlController::class, 'index']);
});

Route::get('/{url:url}', [UrlController::class, 'show']);