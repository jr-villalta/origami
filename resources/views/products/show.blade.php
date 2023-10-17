@extends('layouts.app')
  
@section('title', 'Producto')
  
@section('contents')
    <h1 class="mb-0">Detalles del Producto</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ $product->nombre }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Precio</label>
            <input type="text" name="precio" class="form-control" placeholder="Precio" value="{{ $product->precio }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Cantidad</label>
            <input type="text" name="cantidad" class="form-control" placeholder="cantidad" value="{{ $product->cantidad }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Descripcion</label>
            <textarea class="form-control" name="descripcion" placeholder="Descripcion" readonly>{{ $product->descripcion }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Creado</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $product->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Modificado</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $product->updated_at }}" readonly>
        </div>
    </div>
@endsection