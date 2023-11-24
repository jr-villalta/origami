<?php
  
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categoria;
use App\Models\Imagenes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

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
        $mensaje = 'Producto actualizado correctamente.';

        // Almacena un mensaje en la sesión flash
        session()->flash('mensaje', $mensaje);

        // Redirecciona de nuevo a la página anterior
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
  
        $product->delete();
  
        return redirect()->route('products')->with('success', 'product deleted successfully');
    }

    public function mostrarTodos()
    {
        $products = Product::where('estado', '=', 'Activo');
        $products = $products->paginate(6);
        $categorias = Categoria::all();
        return view('welcome', compact('products', 'categorias'));	
    }
    
    public function mostrarCategoria(string $cate)
    {
        $products = Product::where('estado', '=', 'Activo');
        $idCategoria = Categoria::where('nombre', '=', $cate)->value('id');
        $products = $products->where('id_categoria', '=', $idCategoria);
        $products = $products->paginate(6);
        $categorias = Categoria::all();
        return view('products.filtrados', compact('products', 'categorias'));	
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

    // enviar productos a inventario
    public function indexInventario()
    {
        $products = Product::all();
        return view('inventario.index', compact('products'));
    }

    public function subirImagen(Request $request, $id)
    {
        if(!$request->hasFile('imagen')) {
            // Almacena un mensaje en la sesión flash
            session()->flash('mensaje', 'No se ha seleccionado ninguna imagen.');

            // Redirecciona de nuevo a la página anterior
            return redirect()->back();
        }else{
        // Valida que el archivo subido sea una imagen
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $producto = Product::find($id);
        $mensaje = '';

        if ($producto) {
            $imagen = $request->file('imagen');
            $ruta = $imagen->store('imagenes_productos', 'public');

            $producto->imagenes()->create(['enlace' => $ruta]);

            // Almacena un mensaje en la sesión flash
            
            $mensaje = 'Imagen subida correctamente.';
        } else {
            $mensaje = 'No se encontró el producto.';
        }
        
        // Almacena un mensaje en la sesión flash
        session()->flash('mensaje', $mensaje);

        // Redirecciona de nuevo a la página anterior
        return redirect()->back();
    }
    }

    public function eliminarImagen(Request $request, $id)
    {
        $enlace = $request->input('enlace');

        // Eliminar la imagen del almacenamiento
        Storage::delete($enlace);

        // Eliminar la imagen de la base de datos
        Imagenes::where('id', $id)->where('enlace', $enlace)->delete();

        $mensaje = 'Imagen eliminada correctamente.';
        
        // Almacena un mensaje en la sesión flash
        session()->flash('mensaje', $mensaje);

        // Redirecciona de nuevo a la página anterior
        return redirect()->back();
    }

    public function agregarAlCarrito(Request $request, $productId)
{
    if (!Auth::check()) {
        return redirect()->route('/login')->with('error', 'No puedes agregar productos al carrito sin iniciar sesión.');
    }

    // Obtener el carrito actual de la sesión
    $carritoActual = session('carrito') ? session('carrito') : [];

    // Obtener detalles del producto desde la base de datos
    $producto = Product::findOrFail($productId);

    // Verificar si el producto ya está en el carrito
    $productoExistente = array_search($productId, array_column($carritoActual, 'id'));

    if ($productoExistente !== false) {
        // Verificar que al agregar la nueva cantidad no exceda el total disponible
        if (isset($carritoActual[$productoExistente]['cantidad'])) {
            $nuevaCantidad = $carritoActual[$productoExistente]['cantidad'] + $request->input('cantidad', 1);

            if ($nuevaCantidad <= $producto->cantidad) {
                // Actualizar la cantidad si no excede el total disponible
                $carritoActual[$productoExistente]['cantidad'] = $nuevaCantidad;
            } else {
                $nuevaCantidad = $producto->cantidad;
            }
        }
    } else {
        // Limitar la cantidad al total disponible
        $cantidadAAgregar = min($request->input('cantidad', 1), $producto->cantidad);

        // Obtener la primera imagen del producto o usar una imagen por defecto
        $imagenProducto = $producto->imagenes->first() ? $producto->imagenes->first()->enlace : null;

        // Agregar el producto al carrito con detalles adicionales
        $carritoActual[] = [
            'id' => $productId,
            'cantidad' => $cantidadAAgregar,
            'nombre_producto' => $producto->nombre,
            'imagen_producto' => $imagenProducto,
            'precio_unitario' => $producto->precio_venta,
        ];
    }

    // Almacenar el carrito actualizado en la sesión
    session(['carrito' => $carritoActual]);

    return redirect()->back();
}


    public function reducirCantidad($productId) 
{
    // Obtener el carrito actual de la sesión
    $carritoActual = session('carrito') ? session('carrito') : [];

    // Verificar si el producto ya está en el carrito
    $productoExistente = array_search($productId, array_column($carritoActual, 'id'));

    if ($productoExistente !== false) {
        // Si el producto existe en el carrito, reducimos su cantidad, pero nos aseguramos de que sea al menos 1
        $carritoActual[$productoExistente]['cantidad'] = max(1, $carritoActual[$productoExistente]['cantidad'] - 1);
    }

    // Almacenar el carrito actualizado en la sesión
    session(['carrito' => $carritoActual]);

    return redirect()->back();
}

    public function eliminarDelCarrito($productId) 
{
    // Obtener el carrito actual de la sesión
    $carritoActual = session('carrito') ? session('carrito') : [];

    // Verificar si el producto ya está en el carrito
    $productoExistente = array_search($productId, array_column($carritoActual, 'id'));

    if ($productoExistente !== false) {
        // Si el producto existe en el carrito, lo eliminamos
        unset($carritoActual[$productoExistente]);
    }

    // Almacenar el carrito actualizado en la sesión
    session(['carrito' => $carritoActual]);

    return redirect()->back();
}

public function search(Request $request)
{
    $query = $request->input('query');

    $products = Product::where('nombre', 'like', "%$query%")
        ->orWhere('descripcion', 'like', "%$query%")
        ->orWhere('precio_venta', 'like', "%$query%")
        ->paginate(12);

    return;
}

}