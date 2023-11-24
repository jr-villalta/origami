@extends('layouts.app')
  
@section('title', 'Dashboard - Admin Panel')
  
@section('contents')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Productos</h5>
                    <p class="card-text">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Productos Activos</h5>
                    <p class="card-text">{{ $activeProducts }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">Productos Inactivos</h5>
                    <p class="card-text">{{ $inactiveProducts }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Categorias</h5>
                    <p class="card-text">{{ $totalCategories }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Clientes</h5>
                    <p class="card-text">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Pedidos</h5>
                    <p class="card-text">{{ $totalPedidos }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection