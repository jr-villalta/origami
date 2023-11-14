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
                <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Compras</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Tabla de Descuento</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab4-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false">Alerta de Bajo Stock</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab5-tab" data-toggle="tab" href="#tab5" role="tab" aria-controls="tab5" aria-selected="false">Valor Total de Inversión del Stock</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab6-tab" data-toggle="tab" href="#tab6" role="tab" aria-controls="tab6" aria-selected="false">Descargas para Manualidades</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                <div class="container-fluid">
                    <a href="{{ route('plantillaInventario') }}" class="btn btn-info mt-4">Descargar Plantilla</a>
                    <form id="inventarioForm" action="{{ route('cargarInventario') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="archivoExcel" class="h4 mt-3">Selecciona el archivo Excel:</label>
                            <input type="file" class="form-control-file" id="archivoExcel" name="plantilla">
                        </div>
                        <div id="excel-table" class="mt-3"></div>
                        <button type="button" class="btn btn-danger" id="cancelarCarga" style="display: none;" disabled>Cancelar Carga</button>
                        <button type="submit" class="btn btn-primary" id="cargarInventario" style="display: none;" disabled>Cargar Inventario</button>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@latest"></script>

    <script>
        function readExcel(file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const data = e.target.result;
                const workbook = XLSX.read(data, { type: 'binary' });
                const sheet_name_list = workbook.SheetNames;
                const sheet = workbook.Sheets[sheet_name_list[0]];

                const jsonData = XLSX.utils.sheet_to_json(sheet, { header: 1 });
                const header = jsonData[0];
                const rows = jsonData.slice(1);

                const table = generateBootstrapTable(header, rows);
                const hasDataRows = rows.some(row => row.some(value => value !== null && value !== ''));

                if (hasDataRows) {
                    // Mostrar y habilitar el botón de cancelar después de cargar y mostrar la tabla
                    $('#cancelarCarga').show().prop('disabled', false);
                    
                    // Mostrar y habilitar el botón de cargar después de cargar y mostrar la tabla
                    $('#cargarInventario').show().prop('disabled', false);
                    
                    $('#excel-table').html(table);
                } else {
                    $('#cancelarCarga').show().prop('disabled', false);
                    $('#cargarInventario').hide().prop('disabled', true);
                    $('#excel-table').html('');
                }
            };

            reader.readAsBinaryString(file);
        }

        // valida si hay mas filas aparte de la cabecera
        function generateBootstrapTable(header, rows) {
            
            const columnsToExtract = ['nombre', 'descripcion', 'precio_venta', 'stock_minimo', 'cantidad_sugerida'];
            const columnIndexes = columnsToExtract.map(column => header.indexOf(column));

            let tableHtml = '<table class="table table-bordered table-striped">';
            tableHtml += '<thead class="thead-dark"><tr>';
            columnsToExtract.forEach(column => {
                tableHtml += `<th>${column}</th>`;
            });
            tableHtml += '</tr></thead>';

            let errors = [];

            tableHtml += '<tbody>';
            rows.forEach((row, rowIndex) => {
                let rowIsValid = true;
                let errorMessage = `Error en la fila ${rowIndex + 2}: `;

                if (!columnIndexes.every(index => typeof row[index] !== 'undefined' && row[index] !== '')) {
                    rowIsValid = false;
                    errorMessage += 'La fila contiene celdas vacías.';
                } else if (row.every(value => value === null || value === '')) {
                    rowIsValid = false;
                    errorMessage += 'La fila contiene celdas nulas.';
                } else {
                    const precioVenta = parseFloat(row[columnIndexes[2]]);
                    const stockMinimo = parseInt(row[columnIndexes[3]]);
                    const cantidadSugerida = parseInt(row[columnIndexes[4]]);

                    if (isNaN(precioVenta) || isNaN(stockMinimo) || isNaN(cantidadSugerida) ||
                        precioVenta < 0 || stockMinimo < 0 || cantidadSugerida < 0 ||
                        !/^\d+(\.\d{1,2})?$/.test(precioVenta.toString()) ||
                        !Number.isInteger(stockMinimo) ||
                        !Number.isInteger(cantidadSugerida)) {
                        rowIsValid = false;
                        errorMessage += 'Los valores de precio_venta, stock_minimo, o cantidad_sugerida son inválidos.';
                    }
                }

                if (rowIsValid) {
                    tableHtml += '<tr>';
                    columnIndexes.forEach(index => {
                        tableHtml += `<td>${row[index]}</td>`;
                    });
                    tableHtml += '</tr>';
                } else {
                    errors.push(errorMessage);
                }
            });
            tableHtml += '</tbody></table>';

            // Mostrar una sola alerta que resume todos los errores encontrados
            if (errors.length > 0) {
                alert(errors.join('\n'));
            }

            return tableHtml;
        }

        document.getElementById('archivoExcel').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const archivoInput = document.getElementById('archivoExcel');
            const archivoRuta = archivoInput.value;
            const extPermitidas = /(.xlsx)$/i;
            
            if (file && extPermitidas.exec(archivoRuta)) {
                readExcel(file);
            } else {
                
                $('#cancelarCarga').hide().prop('disabled', true);
                $('#cargarInventario').hide().prop('disabled', true);
                $('#excel-table').html('');
            }
        });

        $('#cancelarCarga').on('click', function () {
            Swal.fire({
                icon: 'success',
                title: 'Cancelado con exito!',
                showConfirmButton: false,
                timer: 1500
            });
            $('#archivoExcel').val(null); // Limpiar el campo de entrada de archivos
            $('#excel-table').html(''); // Limpiar la tabla
            $(this).hide().prop('disabled', true); // Ocultar y deshabilitar el botón

            // Ocultar y deshabilitar el botón de cargar
            $('#cargarInventario').hide().prop('disabled', true);
        });

        // valida que el archivo sea de tipo excel
        $('#archivoExcel').on('change', function () {
            var archivoInput = document.getElementById('archivoExcel');
            var archivoRuta = archivoInput.value;
            var extPermitidas = /(.xlsx)$/i;

            if (!extPermitidas.exec(archivoRuta)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Asegurate de haber seleccionado un archivo Excel (.xlsx)',
                });
                
                archivoInput.value = '';
                return false;
            }
        });

        // insertar datos del archivo excel a la base de datos
        $('#inventarioForm').on('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#inventarioForm').submit();

                    Swal.fire(
                        '¡Cargado!',
                        'El archivo ha sido cargado.',
                        'success'
                    )
                }
            });
        });


    </script>

@endsection
