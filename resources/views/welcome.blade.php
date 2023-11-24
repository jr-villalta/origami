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
            height: 300px; /* Valor arbitrario */
            overflow: hidden;
        }
        .img-carousel {
            width: 100%;
            object-fit: cover;
            object-position: center;
        }
        .about-section {
            display: none;
        }
    </style>
</head>
<body class="antialiased">
    @include('navbar')

    <div class="container-fluid p-1">
        <!-- Sobre Nosotros -->
        <div class="container mt-3 about-section">
            <div class="row justify-content-center">
                <!-- Logo -->
                <div class="col-md-12 text-center">
                    <img src="{{ url('/logotipos/5.png') }}" alt="Logo" height="100" width="100" class="mb-3">
                </div>

                <!-- Origami -->
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Origami</h5>
                            <p class="card-text">
                                Tu tienda de papelería en línea. Origami es más que una tienda, es un destino para los amantes de la papelería. Nuestro nombre se inspira en la habilidad artesanal del origami, donde cada pliegue transforma algo simple en una obra maestra.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Misión -->
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Misión</h5>
                            <p class="card-text">
                                En Origami, nos dedicamos a proporcionar a nuestros clientes productos de papelería de calidad. Nuestra misión es ser el recurso confiable donde la funcionalidad se encuentra con el diseño sofisticado.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Visión -->
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Visión</h5>
                            <p class="card-text">
                                Nos visualizamos como la principal elección para aquellos que buscan calidad y elegancia en productos de papelería. Buscamos expandir continuamente nuestra colección.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Valores -->
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Valores</h5>
                            <p class="card-text">
                                En Origami, nos esforzamos por:
                                <ul>
                                    <li>Ofrecer productos de calidad.</li>
                                    <li>Proporcionar un ambiente de trabajo seguro y agradable.</li>
                                    <li>Respetar el medio ambiente.</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid p-2">
            <!-- Categorias y Productos -->
            <div class="container-fluid" id="normal-section">
                <div class="row">
                    <div class="col-md-3 col-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Categorías</h5>
                                <ul class="list-group list-group-flush">
                                    @if($categorias->count() > 0)
                                        @foreach($categorias as $categoria)
                                            <a href="{{ route('products.filtrados', ['categoria' => $categoria->nombre]) }}" class="list-group-item list-group-item-action">
                                                {{ $categoria->nombre }}
                                            </a>
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
                                    <div class="col-sm-6 col-md-4">
                                        <div class="card mb-3">
                                            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#productModal{{ $item->id }}">
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
                                                    {{-- Verifica si la relación categoria existe antes de acceder a sus propiedades --}}
                                                    @if ($item->categoria)
                                                        <li class="list-group-item"><p class="card-text">Categoría: {{ $item->categoria->nombre }}</p></li>
                                                    @endif
                                                    <li class="list-group-item">
                                                        <a href="{{ route('agregar.al.carrito', ['id' => $item->id]) }}" class="btn btn-primary d-flex justify-content-center align-items-center">
                                                            <i class="fas fa-shopping-cart p-1" type="button"></i> Agregar al carrito
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="productModal{{ $item->id }}" tabindex="-1" aria-labelledby="productModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="productModalLabel{{ $item->id }}">Detalles del Producto</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5 class="card-title">{{ $item->nombre }}</h5>
                                                    <p class="card-text">${{ $item->precio_venta }}</p>
                                                    <p class="card-text">{{ $item->descripcion }}</p>
                                                    <p class="card-text">En stock: {{ $item->cantidad }}</p>

                                                    {{-- Verifica si la relación categoria existe antes de acceder a sus propiedades --}}
                                                    @if ($item->categoria)
                                                        <p class="card-text">Categoría: {{ $item->categoria->nombre }}</p>
                                                    @endif
                                                    <a href="{{ route('agregar.al.carrito', ['id' => $item->id]) }}" class="btn btn-primary d-flex justify-content-center align-items-center">
                                                        <i class="fas fa-shopping-cart p-1" type="button"></i> Agregar al carrito
                                                    </a>
                                                </div>
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
        <div class="container mt-3" id="contactSection">
            <div class="row justify-content-center">
                <!-- Logo -->
                <div class="col-md-12 text-center">
                    <img src="{{ url('/logotipos/5.png') }}" alt="Logo" height="100" width="100" class="mb-3">
                </div>

                <!-- Formulario de contacto -->
                <div class="col-md-8">
                    <form class="contact-form" method="POST" action="{{ route('contact.submit') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="mensaje" class="form-label">Mensaje:</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    // Función para mostrar la sección "Sobre Nosotros"
    function showAboutSection() {
        var aboutSection = document.querySelector('.about-section');
        var normalSection = document.getElementById('normal-section');
        var contactSection = document.getElementById('contactSection');

        aboutSection.style.display = 'block';
        normalSection.style.display = 'none';
        contactSection.style.display = 'none';
    }

    // Función para mostrar la sección normal
    function showNormalSection() {
        var aboutSection = document.querySelector('.about-section');
        var normalSection = document.getElementById('normal-section');
        var contactSection = document.getElementById('contactSection');

        aboutSection.style.display = 'none';
        normalSection.style.display = 'block';
        contactSection.style.display = 'none';
    }

    // Función para mostrar la sección "Contáctanos"
    function showContactSection() {
        var aboutSection = document.querySelector('.about-section');
        var normalSection = document.getElementById('normal-section');
        var contactSection = document.getElementById('contactSection');

        aboutSection.style.display = 'none';
        normalSection.style.display = 'none';
        contactSection.style.display = 'block';
    }

    // Agrega eventos a los botones del logotipo, "Sobre nosotros" y "Contáctanos"
    var logoButton = document.querySelector('.navbar-brand img');
    var aboutUsButton = document.querySelector('.nav-link.active');
    var contactButton = document.querySelector('.nav-link[href="#contactSection"]');

    logoButton.addEventListener('click', showNormalSection);
    aboutUsButton.addEventListener('click', showAboutSection);
    contactButton.addEventListener('click', showContactSection);
    </script>
</body>
</html>
