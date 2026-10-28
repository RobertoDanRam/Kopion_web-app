<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;

// Rutas de Usuarios
Route::apiResource('users', UserController::class);

// Rutas específicas de Órdenes (deben ir ANTES del apiResource)
Route::get('orders/archived', [OrderController::class, 'archived']);
Route::get('orders/invoice/{invoice}', [OrderController::class, 'searchByInvoice']);

// Rutas CRUD estándar de Órdenes
Route::apiResource('orders', OrderController::class);