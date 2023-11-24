<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
 

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
    Route::post('/check-duplicate-email', 'checkDuplicateEmail')->name('checkDuplicateEmail');
  
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
  
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});
  
Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::controller(ProductController::class)->prefix('products')->group(function () {
        Route::get('', 'index')->name('products');
        Route::get('create', 'create')->name('products.create');
        Route::post('store', 'store')->name('products.store');
        Route::get('show/{id}', 'show')->name('products.show');
        Route::get('edit/{id}', 'edit')->name('products.edit');
        Route::put('edit/{id}', 'update')->name('products.update');
        Route::delete('destroy/{id}', 'destroy')->name('products.destroy');
        Route::post('toggle-status/{id}', 'toggleStatus')->name('products.toggleStatus');
        //Route::get('/procesar-excel', 'procesarExcel')->name('products.procesarExcel');
        // Subir imagen
        Route::post('edit/{id}', [ProductController::class, 'subirImagen'])->name('products.subirImagen');
        Route::delete('/eliminar-imagen/{id}', [ProductController::class, 'eliminarImagen'])->name('eliminar.imagen');
        Route::get('/agregar-al-carrito/{id}', [ProductController::class, 'agregarAlCarrito'])->name('agregar.al.carrito');
        Route::get('/reducir-del-carrito/{id}', [ProductController::class, 'reducirCantidad'])->name('carrito.reducir');
        Route::get('/eliminar-del-carrito/{id}', [ProductController::class, 'eliminarDelCarrito'])->name('carrito.eliminar');
    });
 
    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');

    Route::controller(CategoriaController::class)->prefix('categorias')->group(function () {
        Route::get('', 'index')->name('categorias');
        Route::get('create', 'create')->name('categorias.create');
        Route::post('store', 'store')->name('categorias.store');
        Route::get('show/{id}', 'show')->name('categorias.show');
        Route::get('edit/{id}', 'edit')->name('categorias.edit');
        Route::put('edit/{id}', 'update')->name('categorias.update');
        Route::delete('destroy/{id}', 'destroy')->name('categorias.destroy');
    });

    Route::controller(ComprasController::class)->prefix('inventario')->group(function () {
        Route::post('guardarCompra', 'guardarCompra')->name('guardarCompra');
    });

    Route::controller(ConfiguracionController::class)->prefix('configuracion')->group(function () {
        Route::get('/', 'index')->name('configuracion.index');
        Route::post('update', 'update')->name('configuracion.update');
    });

});

// utiliza el metodo mostrarTodos del ProductController.php en welcome.blade.php para mostrar todos los productos
Route::get('/', [App\Http\Controllers\ProductController::class, 'mostrarTodos'])->name('welcome');
Route::get('products/{categoria}', [App\Http\Controllers\ProductController::class, 'mostrarCategoria'])->name('products.filtrados');

// Pasarela de pago
Route::get('/pasarela', [App\Http\Controllers\AuthController::class, 'pasarela'])->name('pasarela');

// Guardar perfil
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

// Realizar pedido
Route::post('/realizar-pedido', [PedidoController::class, 'realizarPedido'])->name('realizar.pedido');

// Mostrar pedidos
Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');

// Inventario
Route::get('/inventario', function () {
    return view('inventario.index');
})->name('inventario');

// descargar plantilla de inventario
Route::get('/plantilla', function () {
    $file  = public_path() . "/plantilla.xlsx";
    
    if (!file_exists($file)) {
        abort(404);
    }
    
    $content = file_get_contents($file);
    return response($content)->withHeaders([
        'Content-Type' => mime_content_type($file)
    ]);
})->name('plantillaInventario');

// cargar el nuevo inventario
Route::post('/inventario', [ProductController::class, 'cargarInventario'])->name('cargarInventario');

Route::get('/inventario', [ComprasController::class, 'index'])->name('inventario');

// buscar productos
//Route::get('/products/search', 'ProductController@search')->name('products.search');

Route::post('/', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
