<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <!-- Styles -->
    </head>
    <body class="antialiased">
    @include('navbar')

    @php
    $carrito = session('carrito') ? session('carrito') : [];
    $total = 0;

    foreach ($carrito as $item) {
        $total += $item['precio_unitario'] * $item['cantidad'];
    }
    @endphp

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="p-1">Pasarela de pago</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div>
                            <label for="fecha" class="form-label">Fecha:</label>
                            <input type="text" id="fecha" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                        </div>
                        <div class="text-end">
                            <h5 class="mb-2">Total a pagar</h5>
                            <h4 class="mb-0 text-primary">${{ $total }}</h4>
                        </div>
</div>

                    <div class="mb-3">
                        <label class="form-label">Entrega:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="entrega" id="tienda" value="tienda" checked>
                            <label class="form-check-label" for="tienda">
                                Retiro en tienda
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="entrega" id="domicilio" value="domicilio">
                            <label class="form-check-label" for="domicilio">
                                A domicilio
                            </label>
                        </div>
                    </div>

                    <div class="mb-3" id="direccion" style="display: none;">
                        <label for="direccion-envio" class="form-label">Dirección de envío:</label>
                        <input type="text" id="direccion-envio" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Forma de pago:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pago" id="contra-entrega" value="efectivo" checked>
                            <label class="form-check-label" for="contra-entrega">
                                Contra entrega
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pago" id="tarjeta" value="tarjeta">
                            <label class="form-check-label" for="tarjeta">
                                Tarjeta de crédito o débito
                            </label>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Proceder al pago</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
    document.querySelectorAll('input[name="entrega"]').forEach((input) => {
        input.addEventListener('change', (event) => {
            document.getElementById('direccion').style.display = event.target.value === 'domicilio' ? 'block' : 'none';
        });
    });
    </script>
</body>
</html>