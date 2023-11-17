<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Product;

class ComprasController extends Controller
{

    public function index()
    {
        $compras = Compra::all();
        $products = Product::all();
        return view('inventario.index', compact('compras', 'products'));
    }

    public function guardarCompra(Request $request)
    {
        // Validación de datos
        $request->validate([
            'id_producto' => 'required|exists:products,id',
            'cantidad' => 'required|integer|min:0',
            'costo' => 'required|numeric|min:0.01',
            'proveedor' => 'required|string',
        ]);

        // Crear nueva compra
        $compra = new Compra([
            'id_producto' => $request->input('id_producto'),
            'cantidad' => $request->input('cantidad'),
            'costo' => $request->input('costo'),
            'proveedor' => $request->input('proveedor'),
        ]);

        $compra->save();

        // Actualizar cantidad en la tabla products
        $producto = Product::find($request->input('id_producto'));
        $producto->cantidad += $request->input('cantidad');
        $producto->save();
        
        return redirect()->route('inventario');
    }

    public function producto()
    {
        return $this->belongsTo(Product::class, 'id_producto');
    }
}
