<?php

namespace App\Http\Controllers;

use App\Models\LineaPedido;
use App\Models\Producto;
use Illuminate\Http\Request;


class LineaPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer',
        ]);

        $precio_producto = Producto::find($request->producto_id);
        $precio_unitario = $precio_producto->precio;

        LineaPedido::create(
            [
                'pedido_id' => $request->pedido_id,
                'producto_id' => $request->producto_id,
                'cantidad' => $request->cantidad,
                'precio_unitario' => $precio_unitario
            ]
        );


        return redirect()->route('pedido.show', $request->pedido_id)->with('success', 'Producto añadido al pedido.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
