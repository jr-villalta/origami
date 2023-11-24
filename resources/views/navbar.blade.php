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
                            <a class="nav-link active" aria-current="page" href="#contactSection">Contáctanos</a>
                        </li>
                        <li class="nav-item">
                        @auth
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Cuenta
                            </a>
                            <ul class="dropdown-menu">
                                @if (auth()->user()->level == 'Admin')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                                            <i class="fas fa-tachometer-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Administración
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                @endif
                                <li>
                                    <button class="nav-link btn btn-link" data-bs-toggle="modal" data-bs-target="#profileModal">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
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
        
        <!-- Carrito -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="cartSidebar" aria-labelledby="cartSidebarLabel">
    <div class="offcanvas-header bg-primary text-white">
        <h5 class="offcanvas-title" id="cartSidebarLabel">Carrito de Compras</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @php
            $carrito = session('carrito') ? session('carrito') : [];
            $total = 0;
        @endphp

        @if (!empty($carrito))
            <ul class="list-group">
                @foreach ($carrito as $key => $item)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @if(($item['imagen_producto'] != 'null'))
                                    <img src="{{ asset('storage/' . $item['imagen_producto']) }}" alt="{{ $item['imagen_producto'] }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <img src="{{ url('/logotipos/6.png') }}" alt="Imagen no disponible" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                @endif
                            </div>
                            <div>
                                <span>{{ $item['nombre_producto'] }}</span><br>
                                <div class="d-flex align-items-center">
                                    <span>Cantidad:</span>
                                    <div class="input-group px-4 d-flex align-items-center" style="width: 100px;">
                                        <a href="{{ route('carrito.reducir', ['id' => $item['id']]) }}" class="btn text-secondary p-0 bg-transparent">-</a>
                                        <input type="text" class="form-control border-0 text-center bg-transparent" value="{{ $item['cantidad'] }}" readonly>
                                        <a href="{{ route('agregar.al.carrito', ['id' => $item['id']]) }}" class="btn text-secondary p-0 bg-transparent">+</a>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <span class="badge bg-primary rounded-pill">${{ $item['precio_unitario']}}</span>
                            </div>
                            <div>
                                <a href="{{ route('carrito.eliminar', ['id' => $item['id']]) }}" class="btn btn-danger rounded-pill">X</a>
                            </div>
                        </div>
                    </li>
                    @php
                        $total += $item['precio_unitario'] * $item['cantidad'];
                    @endphp
                @endforeach
            </ul>
        @else
            <p>No hay productos en el carrito.</p>
        @endif

        <!-- Total del carrito -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h5 class="mb-0">Total:</h5>
            <h4 class="mb-0 text-primary">${{ $total }}</h4>
        </div>

        <!-- Botón de pago -->
        <div class="d-grid gap-2 mt-3">
            <a href="/pasarela" class="btn btn-primary btn-lg">Proceder al Pago</a>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        