@extends('layouts.app')
  
@section('title', 'Create Product')
  
@section('contents')
    <h1 class="mb-0">Add Product</h1>
    <hr />
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="nombre" class="form-control" placeholder="nombre">
            </div>
            <div class="col">
                <input type="text" name="precio" class="form-control" placeholder="precio">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <input type="text" name="cantidad" class="form-control" placeholder="cantidad">
            </div>
            <div class="col">
                <textarea class="form-control" name="descripcion" placeholder="descripcion"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection