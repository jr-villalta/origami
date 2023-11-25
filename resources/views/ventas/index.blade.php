@extends('layouts.app')

@section('title', 'Inventario')

@section('contents')
    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" rel="stylesheet" />
    </head>

    <div class="p-3">
    <!-- Agrega un formulario para el filtro por fecha -->
    <form action="{{ route('ventas.index') }}" method="GET" class="mb-3">
        <div class="row align-items-end">
            <div class="col-md-4">
                <label for="fecha" class="form-label">Filtrar por Fecha:</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $fecha }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary mt-4">Filtrar</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('ventas.index') }}" class="btn btn-secondary mt-4">Mostrar Todos</a>
            </div>
        </div>
    </form>

    <!-- Muestra la tabla de ventas -->
    <table class="table">
        <thead>
            <tr>
                <th>ID Cliente</th>
                <th>Total Venta</th>
                <th>Fecha del Pedido</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalVentas = 0;
            @endphp
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ $venta->id_cliente }}</td>
                    <td>${{ $venta->total_pedido }}</td>
                    <td>{{ $venta->fecha_pedido }}</td>
                </tr>
                @php
                    $totalVentas += $venta->total_pedido;
                @endphp
            @endforeach
        </tbody>
    </table>

    <!-- Muestra el total de todas las ventas -->
    <div class="alert alert-info">
        <strong>Total de Todas las Ventas:</strong> ${{ $totalVentas }}
    </div>
</div>

@endsection