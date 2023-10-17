@extends('layouts.app')
  
@section('title', 'Editar Producto')
  
@section('contents')
    <h1 class="mb-0">Editar Producto</h1>
    <hr />
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ $product->nombre }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Precio</label>
                <input type="text" name="precio" class="form-control" placeholder="Precio" value="{{ $product->precio }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Cantidad</label>
                <input type="text" name="cantidad" class="form-control" placeholder="Cantidad" value="{{ $product->cantidad }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Descripcion</label>
                <textarea class="form-control" name="descripcion" placeholder="Descripcion" >{{ $product->descripcion }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Actualizar información</button>
            </div>
        </div>
    </form>
@endsection