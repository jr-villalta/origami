<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categoria;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
  
        return view('products.index', compact('product'));
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('products.create', compact('categorias'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Product::create($request->all());
 
        return redirect()->route('products')->with('success', 'Product added successfully');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
  
        return view('products.show', compact('product'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categorias = Categoria::all();
  
        return view('products.edit', compact('product', 'categorias'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
  
        $product->update($request->all());
  
        return redirect()->route('products')->with('success', 'product updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
  
        $product->delete();
  
        return redirect()->route('products')->with('success', 'product deleted successfully');
    }

    public function mostrarTodos()
    {
        $products = Product::all();
        return view('welcome', compact('products'));
    }

    // mostrar estado de producto
    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->estado = $product->estado == "Activo" ? "Desactivo" : "Activo";
        $product->save();

        return redirect()->route('products')->with('success', 'Estado del producto actualizado exitosamente');
    }

    // cargar la inserción de los datos
    public function cargarInventario(Request $request)
    {
        $request->validate([
            'plantilla' => 'required|mimes:xlsx,xls'
        ]);

        $path = $request->file('plantilla')->getRealPath();
        $data = Excel::load($path)->get();

        if ($data->count()) {
            foreach ($data as $key => $value) {
                $arr[] = [
                    'id_categoria' => 1,
                    'nombre' => $value->nombre,
                    'descripcion' => $value->descripcion,
                    'cantidad' => $value->cantidad,
                    'stock_minimo' => $value->stock_minimo,
                    'precio_venta' => $value->precio,
                    'cantidad_sugerida' => $value->cantidad_sugerida,
                    'estado' => $value->estado
                ];
            }

            if (!empty($arr)) {
                DB::table('products')->insert($arr);
                return redirect()->route('products')->with('success', 'Inventario cargado exitosamente');
            }
        }
        return back()->with('error', 'Error al cargar el inventario');
    }

}