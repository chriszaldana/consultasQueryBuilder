<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultasController extends Controller
{
    //
    public function insertarUsuarios(Request $request)
{
    try {
        $usuarios = $request->input('usuarios');
        DB::table('tabla_usuarios')->insert($usuarios);
        return response()->json([
            'message' => 'Usuarios insertados correctamente'
        ]);
    } catch (\Exception $e) {
        // Aquí puedes obtener información adicional del error
        $errorCode = $e->getCode(); // Código de error
        $errorMessage = $e->getMessage(); // Mensaje de error
        $errorFile = $e->getFile(); // Archivo donde ocurrió el error
        $errorLine = $e->getLine(); // Línea donde ocurrió el error
    
        return response()->json([
            'message' => 'Error al insertar usuarios',
            'error' => [
                'code' => $errorCode,
                'message' => $errorMessage,
                'file' => $errorFile,
                'line' => $errorLine,
            ]
        ], 500);
    }
}

    public function insertarPedidos(Request $request)    
    {
        try {
            $pedidos = $request->input('pedidos');
            DB::table('tabla_pedidos')->insert($pedidos);
            return response()->json([
                'message' => 'Pedidos insertados correctamente'
            ]);
        } catch (\Exception $e) {
            // Aquí puedes obtener información adicional del error
            $errorCode = $e->getCode(); // Código de error
            $errorMessage = $e->getMessage(); // Mensaje de error
            $errorFile = $e->getFile(); // Archivo donde ocurrió el error
            $errorLine = $e->getLine(); // Línea donde ocurrió el error
        
            return response()->json([
                'message' => 'Error al insertar pedidos',
                'error' => [
                    'code' => $errorCode,
                    'message' => $errorMessage,
                    'file' => $errorFile,
                    'line' => $errorLine,
                ]
            ], 500);
        }
    }

    public function obtenerPedidosUsuario($id)
    {
        try {
            $userId = $id;
            $pedidos = DB::table('tabla_pedidos')
                ->where('user_id', $userId)
                ->get();
            return response()->json($pedidos);
        } catch (\Exception $e) {
            // Aquí puedes obtener información adicional del error
            $errorCode = $e->getCode(); // Código de error
            $errorMessage = $e->getMessage(); // Mensaje de error
            $errorFile = $e->getFile(); // Archivo donde ocurrió el error
            $errorLine = $e->getLine(); // Línea donde ocurrió el error
        
            return response()->json([
                'message' => 'Error al obtener pedidos',
                'error' => [
                    'code' => $errorCode,
                    'message' => $errorMessage,
                    'file' => $errorFile,
                    'line' => $errorLine,
                ]
            ], 500);
        }
    }

    public function pedidosConUsuarios($id)
    {
        try {
            $userId = $id;
            $pedidos = DB::table('tabla_pedidos')
                ->join('tabla_usuarios', 'tabla_pedidos.user_id', '=', 'tabla_usuarios.id')
                ->select('tabla_pedidos.*', 'tabla_usuarios.nombre', 'tabla_usuarios.email')
                ->where('tabla_pedidos.user_id', $userId)
                ->get();
            return response()->json($pedidos);
        } catch (\Exception $e) {
            // Aquí puedes obtener información adicional del error
            $errorCode = $e->getCode(); // Código de error
            $errorMessage = $e->getMessage(); // Mensaje de error
            $errorFile = $e->getFile(); // Archivo donde ocurrió el error
            $errorLine = $e->getLine(); // Línea donde ocurrió el error
        
            return response()->json([
                'message' => 'Error al obtener pedidos',
                'error' => [
                    'code' => $errorCode,
                    'message' => $errorMessage,
                    'file' => $errorFile,
                    'line' => $errorLine,
                ]
            ], 500);
        }
    }

    public function pedidosEnRango(){
        try {
            $pedidos = DB::table('tabla_pedidos')
                ->whereBetween('total', [100, 250])
                ->get();
            return response()->json($pedidos);
        } catch (\Exception $e) {
            // Aquí puedes obtener información adicional del error
            $errorCode = $e->getCode(); // Código de error
            $errorMessage = $e->getMessage(); // Mensaje de error
            $errorFile = $e->getFile(); // Archivo donde ocurrió el error
            $errorLine = $e->getLine(); // Línea donde ocurrió el error
        
            return response()->json([
                'message' => 'Error al obtener pedidos',
                'error' => [
                    'code' => $errorCode,
                    'message' => $errorMessage,
                    'file' => $errorFile,
                    'line' => $errorLine,
                ]
            ], 500);
        }
    }

    public function usuariosConR(){
        try {
            $usuarios = DB::table('tabla_usuarios')
                ->where('nombre', 'like', 'R%')
                ->get();
            return response()->json($usuarios);
        } catch (\Exception $e) {
            // Aquí puedes obtener información adicional del error
            $errorCode = $e->getCode(); // Código de error
            $errorMessage = $e->getMessage(); // Mensaje de error
            $errorFile = $e->getFile(); // Archivo donde ocurrió el error
            $errorLine = $e->getLine(); // Línea donde ocurrió el error
        
            return response()->json([
                'message' => 'Error al obtener usuarios',
                'error' => [
                    'code' => $errorCode,
                    'message' => $errorMessage,
                    'file' => $errorFile,
                    'line' => $errorLine,
                ]
            ], 500);
        }
    }

    public function totalPedidosPorId($id){
        try {
            $pedidos = DB::table('tabla_pedidos')
                ->select('user_id', DB::raw('count(*) as total_pedidos'))
                ->where('user_id', $id)
                ->groupBy('user_id')
                ->get();
            return response()->json($pedidos);
        } catch (\Exception $e) {
            // Aquí puedes obtener información adicional del error
            $errorCode = $e->getCode(); // Código de error
            $errorMessage = $e->getMessage(); // Mensaje de error
            $errorFile = $e->getFile(); // Archivo donde ocurrió el error
            $errorLine = $e->getLine(); // Línea donde ocurrió el error
        
            return response()->json([
                'message' => 'Error al obtener pedidos',
                'error' => [
                    'code' => $errorCode,
                    'message' => $errorMessage,
                    'file' => $errorFile,
                    'line' => $errorLine,
                ]
            ], 500);
            
        }
    }

    public function pedidosOrdenados(){
        $pedidos = DB::table('tabla_pedidos')
            ->join('tabla_usuarios', 'tabla_pedidos.user_id', '=', 'tabla_usuarios.id')
            ->select('tabla_pedidos.*', 'tabla_usuarios.nombre', 'tabla_usuarios.email')
            ->orderBy('tabla_pedidos.total', 'desc')
            ->get();
        return response()->json($pedidos);
    }

    public function sumaTotal()
    {
        try {
            $total = DB::table('tabla_pedidos')
                ->sum('total');
            return response()->json(['suma_total' => $total]);
        } catch (\Exception $e) {
            // Aquí puedes obtener información adicional del error
            $errorCode = $e->getCode(); // Código de error
            $errorMessage = $e->getMessage(); // Mensaje de error
            $errorFile = $e->getFile(); // Archivo donde ocurrió el error
            $errorLine = $e->getLine(); // Línea donde ocurrió el error
        
            return response()->json([
                'message' => 'Error al obtener la suma total',
                'error' => [
                    'code' => $errorCode,
                    'message' => $errorMessage,
                    'file' => $errorFile,
                    'line' => $errorLine,
                ]
            ], 500);
        }
    }

    public function pedidoMasEconomico(){
        try {
            $pedido = DB::table('tabla_pedidos')
            ->join('tabla_usuarios', 'tabla_pedidos.user_id', '=', 'tabla_usuarios.id')
            ->select('tabla_pedidos.*', 'tabla_usuarios.nombre', 'tabla_usuarios.email')
            ->orderBy('tabla_pedidos.total', 'asc')
            ->first();
            return response()->json($pedido);
        } catch (\Exception $e) {
            // Aquí puedes obtener información adicional del error
            $errorCode = $e->getCode(); // Código de error
            $errorMessage = $e->getMessage(); // Mensaje de error
            $errorFile = $e->getFile(); // Archivo donde ocurrió el error
            $errorLine = $e->getLine(); // Línea donde ocurrió el error
        
            return response()->json([
                'message' => 'Error al obtener el pedido más económico',
                'error' => [
                    'code' => $errorCode,
                    'message' => $errorMessage,
                    'file' => $errorFile,
                    'line' => $errorLine,
                ]
            ], 500);
        }
    }

    public function pedidosAgrupados($id){
        try {
            $pedidos = DB::table('tabla_pedidos')
                ->select('user_id', DB::raw('SUM(total) as total'), DB::raw('COUNT(*) as cantidad'))
                ->where('user_id', $id)
                ->groupBy('user_id')
                ->get();
            return response()->json($pedidos);
        } catch (\Exception $e) {
            // Aquí puedes obtener información adicional del error
            $errorCode = $e->getCode(); // Código de error
            $errorMessage = $e->getMessage(); // Mensaje de error
            $errorFile = $e->getFile(); // Archivo donde ocurrió el error
            $errorLine = $e->getLine(); // Línea donde ocurrió el error
        
            return response()->json([
                'message' => 'Error al obtener pedidos agrupados',
                'error' => [
                    'code' => $errorCode,
                    'message' => $errorMessage,
                    'file' => $errorFile,
                    'line' => $errorLine,
                ]
            ], 500);
        }
    }

}
