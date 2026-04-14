<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FarmContactController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\FarmGeorreferenceController;
use Illuminate\Support\Facades\Route;

// Public routes (no registration — only login)
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Clients
    Route::apiResource('clients', ClientController::class);

    // Farms
    Route::apiResource('farms', FarmController::class);

    // Farm Georreferences
    Route::apiResource('farm-georreferences', FarmGeorreferenceController::class);

    // Farm Contacts
    Route::apiResource('farm-contacts', FarmContactController::class);
});
