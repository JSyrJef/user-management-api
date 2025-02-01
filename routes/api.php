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

// Rutas públicas
Route::post('register', [UserController::class, 'store']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

// Rutas protegidas con Sanctum
Route::middleware(['auth:sanctum'])->group(function () {
    // Rutas para admin
    //Route::middleware('role:admin')->group(function () {
        Route::apiResource('users', UserController::class)->except(['store']);
        Route::apiResource('roles', RoleController::class);
        Route::get('user-statistics', [UserStatisticsController::class, 'index']);
    //});

    // Rutas para client
    //Route::middleware('role:client')->group(function () {
        Route::get('user/{user}', [UserController::class, 'show']);
        Route::put('user/{user}', [UserController::class, 'update']);
    //});
});