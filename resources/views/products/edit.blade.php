@extends('layouts.app')
  
@section('title', 'Editar Producto')
  
@section('contents')
    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" rel="stylesheet" />
    </head>
    <h1 class="mb-0">Editar Producto</h1>
    <hr />
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ $product->nombre }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Precio de venta</label>
                <input type="text" name="precio" class="form-control" placeholder="Precio" value="{{ $product->precio_venta }}" required>
            </div>
            <div class="col mb-3">
                <label class="form-label">Cantidad</label>
                <input type="text" name="cantidad" class="form-control" placeholder="Cantidad" value="{{ $product->cantidad }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" placeholder="Descripción" required>{{ $product->descripcion }}</textarea>
            </div>
            <div class="col mb-3">
                <label class="form-label">Stock Mínimo</label>
                <input type="text" name="stock_minimo" class="form-control" placeholder="Stock Mínimo" value="{{ $product->stock_minimo }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Cantidad Sugerida</label>
                <input type="text" name="cantidad_sugerida" class="form-control" placeholder="Cantidad Sugerida" value="{{ $product->cantidad_sugerida }}" required>
            </div>
            <div class="col mb-3">
                <label class="form-label">Categoría</label>
                <select name="id_categoria" class="form-select selectpicker" data-live-search="true" required>
                    <option value="" disabled>Selecciona una categoría</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ $categoria->id == $product->id_categoria ? 'selected' : '' }} >
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Actualizar información</button>
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
@endsection
