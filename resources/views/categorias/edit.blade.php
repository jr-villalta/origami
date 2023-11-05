@extends('layouts.app')
  
@section('title', 'Editar Categoria')
  
@section('contents')
    <h1 class="mb-0">Editar Categoria</h1>
    <hr />
    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="nombre" class="form-control" placeholder="nombre" value="{{ $categoria->nombre }}">
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-warning">Actualizar</button>
            </div>
        </div>
    </form>
@endsection