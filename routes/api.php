<?php

use App\Http\Resources\ProductoResource;
use App\Http\Resources\PedidoResource;
use App\Http\Resources\ClienteResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Pedido;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/productos', function (Request $request) {
        return ProductoResource::collection(Producto::all());
    });
    Route::get('/pedidos', function (Request $request) {
        return PedidoResource::collection(Pedido::all());
    });
    Route::get('/clientes', function (Request $request) {
        return ClienteResource::collection(Cliente::all());
    });
});

Route::post('/login', function (Request $request) {
$request->validate([
    'email' => 'required|email',
    'password' => 'required|string'
]);

if(Auth::attempt($request->only('email', 'password'))) {
    $user = Auth::user();
    $token = $user->createToken('api-token')->plainTextToken;
    return response()->json(['token' => $token]);
   } else {
    return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }
});






