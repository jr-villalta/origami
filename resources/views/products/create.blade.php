@extends('layouts.app')

@section('title', 'Create Product')

@section('contents')
    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" rel="stylesheet" />
    </head>
    <h1 class="mb-0">Add Product</h1>
    <hr />
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
            </div>
            <div class="col">
                <label for="precio_venta" class="form-label">Precio de venta</label>
                <input type="text" name="precio_venta" class="form-control" placeholder="Precio de venta" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="text" name="cantidad" class="form-control" placeholder="Cantidad" value="0" readonly>
            </div>
            <div class="col">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" placeholder="Descripción" required></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="stock_minimo" class="form-label">Stock mínimo</label>
                <input type="text" name="stock_minimo" class="form-control" placeholder="Stock mínimo" required>
            </div>
            <div class="col">
                <label for="cantidad_sugerida" class="form-label">Cantidad sugerida</label>
                <input type="text" name="cantidad_sugerida" class="form-control" placeholder="Cantidad sugerida" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="id_categoria" class="form-label">Categoría</label>
                <select name="id_categoria" class="form-select selectpicker" data-live-search="true" required>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" class="form-select">
                    <option value="activo">Activo</option>
                    <option value="inactivo">Desactivo</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>

@endsection