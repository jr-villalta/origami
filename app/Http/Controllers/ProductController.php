<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categoria;
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
        $products = Product::where('estado', '=', 'Activo');
        $products = $products->paginate(2);
        $categorias = Categoria::all();
        return view('welcome', compact('products', 'categorias'));	
        
    }

    // mostrar estado de producto
    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->estado = $product->estado == "Activo" ? "Desactivo" : "Activo";
        $product->save();

        return redirect()->route('products')->with('success', 'Estado del producto actualizado exitosamente');
    }

    // cargar inventario por lotes
    public function cargarInventario(Request $request)
    {
        // JSON
        $productos = $request->json()->all();

        foreach ($productos as $productData) {
            // Crear un nuevo objeto Product con los datos recibidos
            Product::create([
                'id_categoria' => 1,
                'nombre' => $productData['nombre'],
                'descripcion' => $productData['descripcion'],
                'cantidad' => 0,
                'precio_venta' => $productData['precio_venta'],
                'stock_minimo' => $productData['stock_minimo'],
                'cantidad_sugerida' => $productData['cantidad_sugerida'],
                'estado' => "Desactivo",
            ]);
        }

        // muestra el json
        //return response()->json($productos);
        return redirect()->route('products')->with('success', 'Inventario cargado exitosamente');
    }
}