<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mis Pedidos</title>
    
    <!-- Enlaces a Bootstrap y estilos personalizados -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Agrega tus enlaces a estilos y fuentes aquí -->

    <!-- Styles -->
</head>
<body class="antialiased">
    @include('navbar')

    @if(session('mensaje'))
        <div class="alert alert-success m-2">
            {{ session('mensaje') }}
        </div>
    @endif

    <div class="container mt-5">
        <h1>Mis Pedidos</h1>

        @if($pedidos->isEmpty())
            <p>No tienes pedidos aún.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha de Pedido</th>
                        <th>Total</th>
                        <th>Retiro en Tienda</th>
                        <th>Dirección de Envío</th>
                        <th>Forma de Pago</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->fecha_pedido }}</td>
                            <td>${{ $pedido->total_pedido }}</td>
                            <td>{{ $pedido->retiro_tienda ? 'Sí' : 'No' }}</td>
                            <td>
                                @if (!$pedido->retiro_tienda && $pedido->envio)
                                    {{ $pedido->envio->direccion_envio }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $pedido->forma_pago }}</td>
                            <td>{{ $pedido->estado }}</td>
                            <td>
                                <a href="{{ route('factura.generar', $pedido->id) }}" class="btn btn-primary">
                                    <i class="fas fa-file-invoice"></i> Ver Factura
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Scripts de Bootstrap y scripts personalizados -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8un+2EL7VzXGmJQdCy3Tk8lu2ZfbUQpiWmIc8bZxMT9bE2lAe0PbBJhON6b" crossorigin="anonymous"></script>
    <!-- Agrega tus scripts y/o enlaces a scripts aquí -->
</body>
</html>
