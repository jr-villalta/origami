@extends('layouts.app')

@section('title', 'Inventario')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Inventario de Productos</h1>
    </div>
    <hr />

    <div class="container-fluid">
        <ul class="nav nav-tabs mt-2" id="myTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Carga por Lotes de Inventario</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Tabla de Descuento</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Alerta de Bajo Stock</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab4-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false">Valor Total de Inversión del Stock</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab5-tab" data-toggle="tab" href="#tab5" role="tab" aria-controls="tab5" aria-selected="false">Descargas para Manualidades</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab6-tab" data-toggle="tab" href="#tab6" role="tab" aria-controls="tab6" aria-selected="false">Compras</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                <div class="container-fluid">
                    <a href="{{ route('plantillaInventario') }}" class="btn btn-info mt-4">Descargar Plantilla</a>
                    <form action="{{ route('cargarInventario') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="archivoExcel" class="h4 mt-3">Selecciona el archivo Excel:</label>
                            <input type="file" class="form-control-file" id="archivoExcel" name="plantilla">
                        </div>
                        <button type="submit" class="btn btn-primary">Cargar Inventario</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                
            </div>
            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                
            </div>
            <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                
            </div>
            <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
                
            </div>
            <div class="tab-pane fade" id="tab6" role="tabpanel" aria-labelledby="tab6-tab">
                
            </div>
        </div>
    </div>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>

@endsection
