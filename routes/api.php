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
Route::get('/pedidosEnRango', [ConsultasController::class, 'pedidosEnRango']);
Route::get('/usuariosConR', [ConsultasController::class, 'usuariosConR']);
Route::get('/totalPedidosUsuario/{id}', [ConsultasController::class, 'totalPedidosPorId']);
Route::get('/pedidosOrdenados', [ConsultasController::class, 'pedidosOrdenados']);
Route::get('/pedidosTotal', [ConsultasController::class, 'sumaTotal']);
Route::get('/pedidoMasEconomico', [ConsultasController::class, 'pedidoMasEconomico']);
Route::get('/pedidosAgrupados/{id}', [ConsultasController::class, 'pedidosAgrupados']);
