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
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-3 mb-4 bg-body rounded sticky-top">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ url('/logotipos/5.png') }}" alt="Logo" height="30" width="30" class="me-2">
                        ORIGAMI
                    </a>
                @if (Route::has('login'))
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Sobre nosotros</a>
                        </li>
                        <li class="nav-item">
                        @auth
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Cuenta
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <button class="nav-link btn btn-link" data-bs-toggle="modal" data-bs-target="#profileModal">
                                        Ver perfil
                                    </button>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Cerrar sesion
                                    </a>
                                </li>
                            </ul>
                            </li>
                        @else
                            <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Iniciar sesion</a>
                        </li>
                        <li class="nav-item">
                        @if (Route::has('register'))
                                    <a class="nav-link active" aria-current="page" href="{{ route('register') }}">Registrarse</a>
                                @endif
                        @endauth
                        </li>
                    </ul>
                @endif
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
                </div>
                <div class="d-flex">
                    <button class="btn btn-link" id="cartToggle" data-bs-toggle="offcanvas" href="#cartSidebar" aria-controls="cartSidebar">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>
            <!-- botón de carrito de compras -->
        </nav>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="cartSidebar" aria-labelledby="cartSidebarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="cartSidebarLabel">Carrito de Compras</h5>
                <Button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></Button>
            </div>
            <div class="offcanvas-body">
                <!-- Contenido de tu carrito de compras aquí -->
            </div>
        </div>

        <div class="container-fluid p-1">
        <!-- Categorias y Productos -->
        <div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Categorías</h5>
                    <ul class="list-group list-group-flush">
                    @if($categorias->count() > 0)
    @foreach($categorias as $categoria)
        <li class="list-group-item">{{ $categoria->nombre }}</li>
    @endforeach
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
                        <div class="col-md-4 col-sm-6">
                            <div class="card mb-3">
                                <a href="#">
                                    @if ($item->imagen)
                                        <img src="" class="card-img-top" alt="{{ $item->nombre }}">
                                    @else
                                        <img src="https://via.placeholder.com/50x50" class="card-img-top" alt="Imagen no disponible">
                                    @endif
                                </a>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><h5 class="card-title">{{ $item->nombre }}</h5></li>
                                        <li class="list-group-item"><p class="card-text">{{ $item->cantidad }} disponible</p></li>
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
