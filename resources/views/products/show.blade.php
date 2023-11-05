@extends('layouts.app')

@section('title', 'Producto')

@section('contents')
    <h1 class="mb-0">Detalles del Producto</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">ID del Producto</label>
            <input type="text" name="id_producto" class="form-control" placeholder="ID del Producto" value="{{ $product->id }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">ID de Categoría</label>
            <input type="text" name="id_categoria" class="form-control" placeholder="ID de Categoría" value="{{ $product->id_categoria }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ $product->nombre }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Precio de Venta</label>
            <input type="text" name="precio_venta" class="form-control" placeholder="Precio de Venta" value="{{ $product->precio_venta }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Cantidad</label>
            <input type="text" name="cantidad" class="form-control" placeholder="Cantidad" value="{{ $product->cantidad }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Estado</label>
            <input type="text" name="estado" class="form-control" placeholder="Estado" value="{{ $product->estado }}" readonly>
        </div>
    </div>
    <div class="row">
    <div class="col mb-3">
            <label class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" placeholder="Descripción" readonly>{{ $product->descripcion }}</textarea>
        </div>
    </div>
    <div class="row">
    <div class="col mb-3">
            <label class="form-label">Stock Mínimo</label>
            <input type="text" name="stock_minimo" class="form-control" placeholder="Stock Mínimo" value="{{ $product->stock_minimo }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Cantidad Sugerida</label>
            <input type="text" name="cantidad_sugerida" class="form-control" placeholder="Cantidad Sugerida" value="{{ $product->cantidad_sugerida }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Creado</label>
            <input type="text" name="created_at" class="form-control" placeholder="Creado" value="{{ $product->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Modificado</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Modificado" value="{{ $product->updated_at }}" readonly>
        </div>
    </div>
@endsection
