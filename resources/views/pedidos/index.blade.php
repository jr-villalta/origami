<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedidos</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <!-- Styles -->
</head>
<body class="antialiased">
@include('navbar')

@if(session('mensaje'))
    <div class="alert alert-success my-2">
        {{ session('mensaje') }}
    </div>
@endif

@section('content')

    <h1>Mis Pedidos</h1>

    @if($pedidos->isEmpty())
        <p>No tienes pedidos aún.</p>
    @else
        <ul>
            @foreach($pedidos as $pedido)
                <li>{{ $pedido->id }} - {{ $pedido->fecha_pedido }} - {{ $pedido->total_pedido }}</li>
                {{-- Ajusta según los campos que quieras mostrar --}}
            @endforeach
        </ul>
    @endif
@endsection

</body>
</html>