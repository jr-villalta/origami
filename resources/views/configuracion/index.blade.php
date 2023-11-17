@extends('layouts.app')

@section('title', 'Configuraciones')

@section('contents')

    <head>
        <h3>Editar Configuración</h3>
    </head>

    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            @if (optional($configuracion)->logo_empresa)
                <div class="form-group">
                    <img src="{{ asset('images/' . $configuracion->logo_empresa) }}" alt="Logo Empresa" style="max-width: 200px;">
                </div>
            @endif
        </div>
        <form action="{{ route('configuracion.update', optional($configuracion)->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="logo_empresa">Logo Empresa</label>
                <input type="file" name="logo_empresa" class="form-control" accept="image/*">
                @error('logo_empresa')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nombre_empresa">Nombre Empresa</label>
                <input type="text" name="nombre_empresa" class="form-control" value="{{ old('nombre_empresa', $configuracion->nombre_empresa ?? '') }}" required>
                @error('nombre_empresa')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $configuracion->direccion ?? '') }}" required>
                @error('direccion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="text" name="correo" class="form-control" value="{{ old('correo', $configuracion->correo ?? '') }}" required>
                @error('correo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="numero_telefono">Número Telefono</label>
                <input type="text" name="numero_telefono" class="form-control" value="{{ old('numero_telefono', $configuracion->numero_telefono ?? '') }}" required>
                @error('numero_telefono')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="url_sitio">URL Sitio</label>
                <input type="text" name="url_sitio" class="form-control" value="{{ old('url_sitio', $configuracion->url_sitio ?? '') }}" required>
                @error('url_sitio')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <hr />
            <!-- iva -->
            <div class="form-group">
                <label for="iva">IVA</label>
                <input type="text" name="iva" class="form-control" value="{{ old('iva', $configuracion->iva ?? '') }}" placeholder="iva (opcional)" min="0" step="0.01">
                @error('iva')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
@endsection
