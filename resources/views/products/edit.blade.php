@extends('layouts.app')
  
@section('title', 'Editar Producto')
  
@section('contents')
    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            #carouselExample {
                width: 80%;
                height: 400px;
            }
            #carouselExample .carousel-inner img {
                width: 100%;
                height: 400px; /* Establece el height deseado */
                object-fit: cover; /* Ajusta la imagen manteniendo su relación de aspecto y cubriendo el contenedor */
            }
            .carousel-item {
        position: relative;
    }

    .carousel-item:hover::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Fondo negro transparente */
        z-index: 1;
    }

    .carousel-item:hover img,
    .carousel-indicators,
    .carousel-control-prev,
    .carousel-control-next,
    .carousel-close {
        z-index: 2; /* Asegura que los elementos estén sobre el fondo negro */
    }

    .carousel-indicators {
        font-size: 24px; /* Tamaño de los indicadores */
        color: white;
    }

    .carousel-control-prev, .carousel-control-next {
        font-size: 32px; /* Tamaño de los iconos de control */
        color: white;
    }

    .carousel-close {
        background: none;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: none;
        cursor: pointer;
        font-size: 50px;
        color: white;
    }

    .carousel-close:hover {
        color: red;
    }
        </style>
    </head>

    @if(session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    <!-- <h1 class="mb-0">Editar Producto</h1> -->
    <hr />
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ $product->nombre }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Precio de venta</label>
                <input type="text" name="precio" class="form-control" placeholder="Precio" value="{{ $product->precio_venta }}" required>
            </div>
            <div class="col mb-3">
                <label class="form-label">Cantidad</label>
                <input type="text" name="cantidad" class="form-control" placeholder="Cantidad" value="{{ $product->cantidad }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" placeholder="Descripción" required>{{ $product->descripcion }}</textarea>
            </div>
            <div class="col mb-3">
                <label class="form-label">Stock Mínimo</label>
                <input type="text" name="stock_minimo" class="form-control" placeholder="Stock Mínimo" value="{{ $product->stock_minimo }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Cantidad Sugerida</label>
                <input type="text" name="cantidad_sugerida" class="form-control" placeholder="Cantidad Sugerida" value="{{ $product->cantidad_sugerida }}" required>
            </div>
            <div class="col mb-3">
    <label class="form-label">Categoría</label>
    <select name="id_categoria" class="selectpicker border d-block" data-live-search="true" required>
        <option value="" disabled>Selecciona una categoría</option>
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}" {{ $categoria->id == $product->id_categoria ? 'selected' : '' }} >
                {{ $categoria->nombre }}
            </option>
        @endforeach
    </select>
</div>
<div class="row">
    <div class="col-4"> <!-- Ajusta el ancho del botón al 50% del contenedor -->
        <div class="d-grid">
            <button class="btn btn-warning">Actualizar información</button>
        </div>
    </div>
</div>

    
</form>
<div class="container mt-4">
    <h1>Imágenes del Producto</h1>

    <form class="my-4" action="{{ route('products.subirImagen', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="input-group container">
        <input type="file" class="form-control" name="imagen" accept="image/*" >
         <button class="input-group-text" type="submit">Subir Imagen</button>    
    </div>
    </form>
    @if($product->imagenes->count() > 0)

        <div id="carouselExample" class="carousel slide border" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($product->imagenes as $key => $imagen)
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach($product->imagenes as $key => $imagen)
            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $imagen->enlace) }}" class="d-block w-100" alt="Imagen del producto">
                <form action="{{ route('eliminar.imagen', $imagen->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta imagen?');">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="enlace" value="{{ $imagen->enlace }}">
                    <button type="submit" class="carousel-close" title="Eliminar imagen"><ion-icon name="close-circle-outline"></ion-icon></button>
                </form>

            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


    </div>
    @else
        <p>No hay imágenes disponibles para este producto.</p>
    @endif


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
@endsection
