<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracion;
use Illuminate\Validation\Rule;

class ConfiguracionController extends Controller
{
    //
    public function index()
    {
        $configuracion = Configuracion::first();
        return view('configuracion.index', compact('configuracion'));
    }

    public function update(Request $request)
    {

        $configuracion = Configuracion::first();

        if ($configuracion) {
            $configuracion->fill($request->except('logo_empresa'));

            if ($request->hasFile('logo_empresa')) {
                $file = $request->file('logo_empresa');
                $name = time() . $file->getClientOriginalName();
                $configuracion->logo_empresa = $name;
                $file->move(public_path() . '/images/', $name);
            }

            $configuracion->save();
        } else {
            // Si no hay configuración existente, puedes crear una nueva instancia y guardarla.
            $configuracion = new Configuracion($request->except('logo_empresa'));

            if ($request->hasFile('logo_empresa')) {
                $file = $request->file('logo_empresa');
                $name = time() . $file->getClientOriginalName();
                $configuracion->logo_empresa = $name;
                $file->move(public_path() . '/images/', $name);
            }

            $configuracion->save();
        }

        return redirect()->route('configuracion.index')->with('success', 'Configuración actualizada exitosamente');
    }
}
