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
        <style>
        .img-container {
            padding: 5px;
            height: 300px; /* Puedes ajustar la altura máxima según tus necesidades */
            overflow: hidden;
        }
        .img-carousel {
            width: 100%;
            object-fit: cover;
            object-position: center;
        }
        </style>
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
                <a href="#" class="text-decoration-none">
                    @if ($item->imagenes->isNotEmpty())
                        <div id="carousel_{{ $item->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($item->imagenes as $key => $imagen)
                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" data-bs-interval="4000">
                                        <div class="img-container">
                                            <img src="{{ asset('storage/' . $imagen->enlace) }}" class="d-block w-100 img-carousel" alt="{{ $item->nombre }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel_{{ $item->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel_{{ $item->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    @else
                        <div class="carousel slide" data-bs-touch="false" data-bs-interval="false">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="img-container">
                                        <img src="https://via.placeholder.com/250x250" class="d-block w-100 img-carousel" alt="Imagen no disponible">
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel_{{ $item->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel_{{ $item->id }}" data-bs-slide="next">
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
                        <li class="list-group-item">
                            <a href="{{ route('agregar.al.carrito', ['id' => $item->id]) }}" class="btn btn-primary d-flex justify-content-center align-items-center">
                                <i class="fas fa-shopping-cart p-1" type="button"></i> Agregar al carrito
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endif
@endforeach
            </div>

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

    </body>
</html>
