@extends('layouts.app')

@section('title', 'Resultados de Búsqueda')

@section('contents')
    <div class="container mt-4">
        <h2>Resultados de Búsqueda para "{{ $query }}"</h2>

        @if ($resultados->isEmpty())
            <p>No se encontraron resultados.</p>
        @else
            <ul>
                @foreach ($resultados as $resultado)
                    <li>{{ $resultado->nombre }} - {{ $resultado->descripcion }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection