<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categoria = Categoria::all();

        return view('categorias.index', compact('categoria'));
    }

    public function welcome()
{
    $categoria = Categoria::all();

    if (isset($categoria)) {
        return view('welcome', compact('categoria'));
    } else {
        // Puedes manejar el caso en el que $categoria no esté definida
        // o asignar un valor predeterminado a $categoria si es necesario.
        $categoria = [];
        return view('welcome', compact('categoria'));
    }
}


    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        Categoria::create($request->all());

        return redirect()->route('categorias')->with('success', 'Categoria agregada correctamente');
    }

    public function show(string $id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('categorias.show', compact('categoria'));
    }

    public function edit(string $id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, string $id)
    {
        $categoria = Categoria::findOrFail($id);

        $categoria->update($request->all());

        return redirect()->route('categorias')->with('success', 'Categoria actualizada correctamente');
    }

    // ELIMINAR CATEGORIA
    /*public function destroy(string $id)
    {
        $categoria = Categoria::findOrFail($id);

        $categoria->delete();

        return redirect()->route('categorias')->with('success', 'Categoria eliminada correctamente');
    }*/
}
