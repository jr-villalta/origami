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

    </head>
    <body class="antialiased">
    @include('navbar')

        <div class="container-fluid p-1">
        <!-- Categorias y Productos -->
        <div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Categorías</h5>
                    <ul class="list-group list-group-flush">
                        <a href="/" class="list-group-item list-group-item-action">
                            Mostrar todos los productos</a>
                    @if($categorias->count() > 0)
                        @foreach($categorias as $categoria)
                        <a href="{{ route('products.filtrados', ['categoria' => $categoria->nombre]) }}" class="list-group-item list-group-item-action">
            {{ $categoria->nombre }}
        </a>@endforeach
                    @else
                        <!-- Mensaje o contenido alternativo si no hay categorías -->
                    @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-md-9 col-12">
            <div class="row">
                @foreach($products as $item)
                    @if($item->estado === 'Activo')
                        <div class="col-sm-6 col-md-4">
                            <div class="card mb-3">
                                <a href="#">
                                    @if ($item->imagen)
                                        <img src="" class="card-img-top" alt="{{ $item->nombre }}">
                                    @else
                                        <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="https://via.placeholder.com/50x50" class="d-block w-100 card-img-top" alt="Imagen no disponible">
                                                </div>
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>  
                                    @endif
                                </a>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><h5 class="card-title">{{ $item->nombre }}</h5></li>
                                        <li class="list-group-item"><p class="card-text">${{ $item->precio_venta }}</p></li>
                                        <li class="list-group-item"><a href="#" class="btn btn-primary d-flex justify-content-center align-items-center"><i class="fas fa-shopping-cart p-1" type="button"></i> Agregar al carrito</a></p></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Enlaces de paginación -->
            <!-- Enlaces de paginación -->
<div class="d-flex justify-content-center">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            {{-- Anterior --}}
            @if ($products->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">&laquo;</a>
                </li>
            @endif

            {{-- Números de página --}}
            @for ($i = 1; $i <= $products->lastPage(); $i++)
                <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- Siguiente --}}
            @if ($products->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
</div>


        </div>
    </div>
</div>
</div>


                </div>
            </div>
        </div>
    </div>
</div>


        <!-- Modal -->
        @if (auth()->check())
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="profileModalLabel">
                                <i class="fas fa-user"></i> Perfil de {{ auth()->user()->name }}
                            </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <label for="name">Nombre:</label>
                                <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" placeholder="Ingresa tu Nombre" required />
                                <label class="mt-2" for="email">Correo:</label>
                                <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" readonly />
                                <label class="mt-2" for="password">Nueva Contraseña:</label>
                                <input type="password" class="form-control" name="password" id="passwordField" placeholder="Cambiar contraseña (opcional)" required />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        
    </body>
</html>
