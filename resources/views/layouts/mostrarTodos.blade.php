@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if ($product->imagen)
                        <img src="{{ $product->imagen }}" class="card-img-top" alt="{{ $product->nombre }}">
                    @else
                        <img src="{{ asset('images/imagen-no-disponible.png') }}" class="card-img-top" alt="Imagen no disponible">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nombre }}</h5>
                        <p class="card-text">{{ $product->descripcion }}</p>
                        <p class="card-text">Cantidad disponible: {{ $product->cantidad }}</p>
                        <p class="card-text">Precio: ${{ $product->precio }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection