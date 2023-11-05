@extends('layouts.app')
  
@section('title', 'Categorias')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Lista de categorias</h1>
        <a href="{{ route('categorias.create') }}" class="btn btn-primary">Agregar Categoria</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>+
            @if($categoria->count() > 0)
                @foreach($categoria as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->nombre }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('categorias.show', $rs->id) }}" type="button" class="btn btn-secondary">Detalles</a>
                                <a href="{{ route('categorias.edit', $rs->id)}}" type="button" class="btn btn-warning">Editar</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Categoria no fué encontrado</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
