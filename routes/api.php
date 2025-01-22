<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultasController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/insertarUsuarios', [ConsultasController::class, 'insertarUsuarios']);
Route::post('/insertarPedidos', [ConsultasController::class, 'insertarPedidos']);
Route::get('/obtenerPedidosUsuario/{id}', [ConsultasController::class, 'obtenerPedidosUsuario']);
Route::get('/obtenerPedidosConUsuario/{id}', [ConsultasController::class, 'pedidosConUsuarios']);
