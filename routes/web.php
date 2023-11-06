<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

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

    // Quiero solo mostrar en la sidebar el diseño de inventario (no tiene que llevar InventarioController por que no existe)

});

// utiliza el metodo mostrarTodos del ProductController.php en welcome.blade.php para mostrar todos los productos
Route::get('/', [App\Http\Controllers\ProductController::class, 'mostrarTodos'])->name('welcome');

// Guardar perfil
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

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
Route::post('/cargar-inventario', [App\Http\Controllers\ProductController::class, 'cargarInventario'])->name('cargarInventario'); // pruebas :D

