<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Origami</div>
    </a>
    
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class=""></i>
        <span>Configuraciones</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class=""></i>
        <span>Estadístico</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class=""></i>
        <span>Facturas</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class=""></i>
        <span>Clientes</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('inventario') }}">
        <i class=""></i>
        <span>Inventario</span></a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="{{ route('products') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Productos</span></a>
    </li>

    <!-- Categorias  -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('categorias') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Categorias</span></a>
    </li>

    <!-- profile -->
    <li class="nav-item">
      <a class="nav-link" href="/profile">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Perfil</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="/">
        <i class=""></i>
        <span>Sitio Web</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('logout') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Cerrar Sesión</span></a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> 
</ul>