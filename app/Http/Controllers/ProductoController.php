<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', ['productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', ['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['precio' => str_replace('€', '', $request->precio)]); // permite escribir en el panel €, de forma que es más visual
        /** dd($request->all()); */
        $request->validate([
            'nombre' => 'required|string',
            'precio' => 'required|numeric',
            'stock' => 'required|numeric',
            'categoria_id' => 'required|integer',
        ]);

        Producto::create(
            $request->only('nombre', 'precio', 'stock', 'categoria_id')
        );

        return redirect()->route('producto.index')->with('success', 'Producto creado correctamente.');
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
    public function edit(Producto $producto)
    {
                $categorias = Categoria::all();
        return view('productos.edit', [
            'categorias' => $categorias,
            'producto' => $producto
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->merge(['precio' => str_replace('€', '', $request->precio)]);
        $producto->update(
            $request->only('nombre', 'precio', 'stock', 'categoria_id')
        );
        return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Producto $producto)
{
    if ($producto->lineasPedido()->count() > 0) {
        return redirect()->route('producto.index')
            ->with('error', 'No se puede eliminar este producto porque tiene pedidos asociados.');
    }

    $producto->delete();
    return redirect()->route('producto.index')
        ->with('success', 'Producto eliminado correctamente.');
}
}
