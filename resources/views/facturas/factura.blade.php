<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Factura</title>
    
    <!-- Styles -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .info {
            margin-bottom: 30px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table, .table th, .table td {
            border: 1px solid #ddd;
        }
        .table th, .table td {
            padding: 10px;
            text-align: left;
        }
        .total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ $configuracion->logo_empresa }}" alt="Logo" class="logo">
            <h1>Factura</h1>
        </div>

        <div class="info"> 
            <p><strong>Nombre de la Empresa:</strong> {{ $configuracion->nombre_empresa }}</p>
            <p><strong>Dirección:</strong> {{ $configuracion->direccion }}</p>
            <p><strong>Correo:</strong> {{ $configuracion->correo }}</p>
            <p><strong>Teléfono:</strong> {{ $configuracion->numero_telefono }}</p>
            <p><strong>Sitio Web:</strong> {{ $configuracion->url_sitio }}</p>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->product->nombre }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>$ {{ $producto->product->precio_venta }}</td>
                    <td>$ {{ $producto->cantidad * $producto->product->precio_venta }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="total">
            <p><strong>Total a Pagar:</strong> ${{ $pedido->total_pedido }}</p>
        </div>
    </div>
</body>
</html>
