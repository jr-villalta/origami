@extends('layouts.app')
  
@section('title', 'Registrar de Categorias')
  
@section('contents')
    <h1 class="mb-0">Registrar Categoria</h1>
    <hr />
    <form action="{{ route('categorias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="nombre" class="form-control" placeholder="nombre">
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </form>
@endsection
