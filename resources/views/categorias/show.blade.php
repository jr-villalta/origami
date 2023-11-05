@extends('layouts.app')

@section('title', 'Categoría')

@section('contents')
<h1 class="mb-0">Detalles de la Categoría</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ $categoria->nombre }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" placeholder="Descripcion" readonly>{{ $categoria->descripcion }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Creado</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $categoria->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Modificado</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $categoria->updated_at }}" readonly>
        </div>
    </div>
@endsection
