<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LineaPedidoController;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Categoria;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'totalProductos' => Producto::count(),
        'totalClientes' => Cliente::count(),
        'totalPedidos' => Pedido::count(),
        'totalCategorias' => Categoria::count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/categoria', CategoriaController::class)->parameters(['categoria' => 'categoria']);
    Route::resource('/producto', ProductoController::class);
    Route::resource('/cliente', ClienteController::class);
    Route::resource('/pedido', PedidoController::class);
    Route::resource('/lineaspedido', LineaPedidoController::class);
});

require __DIR__.'/auth.php';