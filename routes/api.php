<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserStatisticsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Ruta para obtener el usuario autenticado
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Ruta(publica)
Route::post('register', [UserController::class, 'store']);
Route::post('login', [UserController::class, 'login']);
// Route::apiResource('users', UserController::class)->only(['store', 'index']);


// Rutas protegidas con Sanctum y middleware CheckRole
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('users', UserController::class)->except(['store', 'update']);
    Route::apiResource('roles', RoleController::class);
    Route::get('user-statistics', [UserStatisticsController::class, 'index']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('users/{user}', [UserController::class, 'show']);
    Route::put('users/{user}', [UserController::class, 'update']);
});

