@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


    <div style="display: flex; align-items: center;">
        <button type="button" class="btn btn-primary btn-sm cerrar_caja" data-bs-toggle="modal" data-bs-target="#miModal">
            Cerrar Caja
        </button>
        <h1 style="margin-left: 10px;">Ventas Del Empleado -> {{ $datos->name }}</h1>
    </div>


@stop

@section('content')


    <input type="hidden" id="caja_id" name="caja_id" value="{{ $caja->cajaventa_id }}">

    <div class="blogapp-content">
        <div class="blogapp-detail-wrap">

            <div class="blog-body">
                <div data-simplebar class="nicescroll-bar">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xxl-9 col-lg-8">
                                <form class="edit-post-form">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="form-label">Nit </label>
                                            <select id="search" class="js-example-basic-single" style="width: 100%;">
                                                <!-- Opciones pre-cargadas o vacías -->
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Nombre</label>
                                            <input class="form-control" name="nombre_cliente" id="nombre_cliente"
                                                placeholder="Nombre">
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="form-label">Celular </label>
                                            <input class="form-control" name="celular_cliente" id="celular_cliente">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Apellido</label>
                                            <input class="form-control" name="apellido_cliente" id="apellido_cliente"
                                                placeholder="Apellido">

                                        </div>

                                    </div>
                                    <div class="card card-border">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="tabla_ventas" class="table nowrap w-100 mb-5">
                                                    <thead>
                                                        <tr>
                                                            <th>Cod</th>
                                                            <th>Item/Producto</th>
                                                            <th>Cant.</th>
                                                            <th>Precio Uni.</th>
                                                            <th>Total</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="empty-message" style="display:none; text-align:center;">
                                                            <td colspan="6">Productos Vacíos</td>
                                                        </tr>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th>Total Venta</th>
                                                            <th>0</th>
                                                            <th>(Bs.)</th>
                                                        </tr>
                                                    </tfoot>

                                                </table>
                                            </div>

                                        </div>
                                    </div>


                                </form>
                            </div>
                            <div class="col-xxl-3 col-lg-4">
                                <div class="content-aside">

                                    <button class="btn btn-primary btn-block mb-3" id="registrar_venta">Registra
                                        Venta</button>
                                    <div class="form-group">
                                        <label class="form-label">Metodo de pago</label>
                                        <select class="form-select">
                                            <option selected value="1">En efectivo</option>
                                            <option value="2">Tarjeta</option>
                                            <option value="2">Qr</option>
                                        </select>
                                    </div>
                                    <div class="card card-border">
                                        <div class="card-body">
                                            <form class="edit-post-form">
                                                <div class="form-group">
                                                    <label class="form-label">Buscar Producto</label>
                                                    <select id="buscar_producto" class="js-example-basic-single"
                                                        style="width: 100%;">
                                                        <!-- Opciones pre-cargadas o vacías -->
                                                    </select>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Precio Venta </label>
                                                        <input class="form-control" name="stock_precio" id="stock_precio"
                                                            disabled>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Cod Producto</label>
                                                        <input class="form-control" name="stock_codigo" id="stock_codigo"
                                                            type="number" disabled>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Disponible </label>
                                                        <input class="form-control" name="stock_disponible" type="number"
                                                            id="stock_disponible" disabled>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Cantidad</label>
                                                        <input class="form-control" name="stock_cantidad"
                                                            id="stock_cantidad" type="number">
                                                        <div class="invalid-feedback">No hay suficiente Stock.</div>
                                                    </div>

                                                </div>
                                                <div class="d-flex justify-content-center text-center">
                                                    <button id="agregarProductoBtn"
                                                        class="btn btn-outline-secondary flex-grow-12">Agregar
                                                        Producto</button>
                                                    <button id="limpiar_producto"
                                                        class="btn btn-outline-secondary flex-grow-3"><i
                                                            class="bi bi-trash2"></i></button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>















    <!----------- MODAL PARA  CERRAR VENTA-->
    <div class="modal" tabindex="-1" id="miModal" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('cerrar_caja') }}" method="POST">
                    @csrf
                    <input type="hidden" id="id_caja_venta" name="id_caja_venta">
                    <div class="modal-header">
                        <h5 class="modal-title">Monto Final</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group ">

                            <label class="form-label">Moto final Caja </label>
                            <input class="form-control" name="montofinal_caja" id="montofinal_caja">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Terminar
                            Ventas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- Bootstrap Dropify CSS -->
    <link href="{{ asset('Template/vendors/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Daterangepicker CSS -->
    <link href="{{ asset('Template/vendors/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />

    <!-- Select2 CSS -->
    <link href="{{ asset('Template/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Data Table CSS -->
    <link href="{{ asset('Template/vendors/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('Template/vendors/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />

    <link href="{{ asset('dist_select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist_tokenize2/tokenize2.min.css') }}" rel="stylesheet">
    <!-- CSS -->
    <link href="{{ asset('Template/dist/css/style.css') }}" rel="stylesheet" type="text/css">
@stop

@section('js')
    <!-- jQuery -->
    <script src="{{ asset('Template/vendors/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('Template/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- FeatherIcons JS -->
    <script src="{{ asset('Template/dist/js/feather.min.js') }}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{ asset('Template/dist/js/dropdown-bootstrap-extended.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('Template/vendors/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Data Table JS -->
    <script src="{{ asset('Template/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Template/vendors/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Template/vendors/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <!-- Select2 JS -->
    <script src="{{ asset('Template/vendors/select2/dist/js/select2.full.min.js') }}"></script>


    <script src="{{ asset('dist_select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('dist_tokenize2/tokenize2.min.js') }}"></script>


    <!-- Tinymce JS -->
    <script src="{{ asset('Template/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('Template/dist/js/tinymce-data.js') }}"></script>
    <!-- Dropify JS -->
    <script src="{{ asset('Template/vendors/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('Template/dist/js/dropify-data.js') }}"></script>



    <!-- Daterangepicker JS -->
    <script src="{{ asset('Template/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('Template/vendors/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('Template/dist/js/daterangepicker-data.js') }}"></script>
    <!-- Init JS -->
    <script src="{{ asset('Template/dist/js/init.js') }}"></script>
    <script src="{{ asset('Template/dist/js/contact-data.js') }}"></script>
    <script src="{{ asset('Template/dist/js/chips-init.js') }}"></script>

    <script>
        $(document).ready(function() {

            var tablaVentas = $('#tabla_ventas tbody');
            var mensajeVacio = $('.empty-message');

            if (tablaVentas.find('tr').length === 1) {
                mensajeVacio.show();
            } else {
                mensajeVacio.hide();
            }


            var nitValue; // Declara la variable fuera del contexto de select2


            $('#limpiar_producto').click(function(event) {
                event.preventDefault();
                $('#buscar_producto').val('').trigger('change');
                $('#stock_precio').val('');
                $('#stock_codigo').val('');
                $('#stock_disponible').val('');
                $('#stock_cantidad').val('');
            });

            $('#search').select2({
                ajax: {
                    url: function(params) {
                        nitValue = params.term; // Asigna el valor del select2 a la variable nitValue
                        return '/buscar-por-nit/' + params.term;
                    },
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        if (!data.error) {
                            console.log('id', data);

                            return {
                                results: [{
                                    text: data.nombre_cliente + ' ' + data.apellido_cliente,
                                    nombre: data.nombre_cliente,
                                    apellido: data.apellido_cliente,
                                    celular: data.celular_cliente,
                                    id: data.nit_cliente
                                }]
                            };
                        } else {
                            console.log('else', data, nitValue);
                            return {
                                results: [{
                                    text: nitValue, // Utiliza el valor de nitValue en lugar de params.term
                                    id: nitValue,
                                    selected: true
                                }]

                            };
                        }
                    },
                    cache: true
                }
            }).on('select2:select', function(e) {
                if (e.params.originalEvent) {
                    console.log(e.params);
                    $('#nombre_cliente').val(e.params.data.nombre || '');
                    $('#apellido_cliente').val(e.params.data.apellido || '');
                    $('#celular_cliente').val(e.params.data.celular || '');
                    $('#search').append('<option value="' + nitValue + '" selected>' + nitValue +
                        '</option>');
                    $('#search').trigger('change');
                }
            });

            // Función para eliminar una fila
            $(document).on('click', '.borrarFila', function() {
                $(this).closest('tr').remove();
                actualizarTotalVenta();
            });
            $('#agregarProductoBtn').click(function(event) {
                // Aquí puedes escribir el código que se ejecutará cuando se presione el botón
                event.preventDefault();
                // Obtener los valores de los campos
                if ($('.invalid-feedback').is(':visible')) {
                    return; // No se ejecuta más código si el mensaje de error está visible
                }
                var buscarProducto = $('#buscar_producto').val();
                var stockPrecio = $('#stock_precio').val();
                var stockCodigo = $('#stock_codigo').val();
                var stockDisponible = $('#stock_disponible').val();
                var stockCantidad = $('#stock_cantidad').val();

                var buscarProductotetx = $('#buscar_producto option:selected').text();
                console.log(buscarProductotetx);

                // Insertar nueva fila en la tabla
                var newRow = '<tr>' +
                    '<td>' + stockCodigo + '</td>' +
                    '<td>' + buscarProductotetx + '</td>' +
                    '<td>' + stockCantidad + '</td>' +
                    '<td>' + stockPrecio + ' Bs. </td>' +
                    '<td>' + (parseFloat(stockCantidad) * parseFloat(stockPrecio)).toFixed(2) +
                    ' Bs. </td>' +
                    '<td><button type="button" class="btn btn-danger btn-sm borrarFila"><i class="bi bi-trash"></i></button></td>' +
                    '</tr>';

                $('#tabla_ventas tbody').append(newRow);
                var mensajeVacio = $('.empty-message');
                mensajeVacio.hide();

                actualizarTotalVenta();

                // Limpiar campos
                $('#buscar_producto').val('').trigger('change');
                $('#stock_precio, #stock_codigo, #stock_disponible, #stock_cantidad').val('');


            });

            $('#registrar_venta').click(function(event) {
                event.preventDefault();

                var productos = [];

                // Obtener todos los valores de la tabla
                $('#tabla_ventas tbody tr:not(:first-child)').each(function() {
                    var cod = $(this).find('td:eq(0)')
                        .text(); // Obtener el valor de la primera celda
                    var producto = $(this).find('td:eq(1)')
                        .text(); // Obtener el valor de la segunda celda
                    var cantidad = $(this).find('td:eq(2)')
                        .text(); // Obtener el valor de la tercera celda
                    var precioUnitario = $(this).find('td:eq(3)')
                        .text(); // Obtener el valor de la cuarta celda
                    var total = $(this).find('td:eq(4)')
                        .text(); // Obtener el valor de la quinta celda

                    // Crear un objeto para el producto actual
                    var productoObj = {
                        cod: cod,
                        producto: producto,
                        cantidad: cantidad,
                        precioUnitario: precioUnitario,
                        total: total
                    };

                    // Agregar el objeto a la lista de productos
                    productos.push(productoObj);
                });

                var productosJSON = JSON.stringify(productos);
                console.log(productosJSON);
            });


            function actualizarTotalVenta() {
                var nuevoTotalVenta = 0;

                // Iterar sobre todas las filas en el cuerpo de la tabla, excepto la primera
                $('#tabla_ventas tbody tr:not(:first-child)').each(function() {
                    var totalProducto = parseFloat($(this).find('td:nth-child(5)').text().replace(' Bs.',
                        ''));
                    nuevoTotalVenta += totalProducto;
                });

                // Actualizar el total de la venta en el pie de tabla
                $('#tabla_ventas tfoot th:nth-child(5)').text(nuevoTotalVenta.toFixed(2) + ' Bs.');
            }

            $('#stock_cantidad').on('change', function() {
                var cantidad = parseInt($(this).val()); // Convierte a número
                var disponible = parseInt($('#stock_disponible').val()); // Convierte a número
                console.log(cantidad, disponible);

                if (cantidad > disponible) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            $('.cerrar_caja').click(function() {

                // Realiza una solicitud GET a la URL '/ruta/de/tu/endpoint'
                $.ajax({
                    url: '/obtener_datos_cajaventa/' + $('#caja_id').val(), // Ruta a tu endpoint
                    type: 'GET', // Tipo de solicitud (GET en este caso)
                    dataType: 'json', // Tipo de datos esperados en la respuesta (puede ser 'json', 'xml', etc.)
                    success: function(data) {
                        // Se ejecuta si la solicitud fue exitosa
                        console.log('Respuesta del servidor:', data);
                        $('#montofinal_caja').val(data.montofinal);
                        $('#id_caja_venta').val(data.cajainfo.id_cajaventa);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Se ejecuta si la solicitud falla
                        console.error('Error en la solicitud:', textStatus, errorThrown);
                    }
                });
            });

            $('#buscar_producto').select2({
                ajax: {
                    url: function(params) {
                        nitValue = params.term; // Asigna el valor del select2 a la variable nitValue
                        return '/buscar_producto/' + params.term;
                    },
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        if (!data.error) {
                            console.log('if', data);

                            return {
                                results: data.map(function(item) {
                                    return {
                                        text: item.nombre + ' - ' + item.marca,
                                        disponible: item.cantidad,
                                        precio: item.precio,
                                        codigo: item.barcode,
                                        id: item.stock_id
                                    };
                                })
                            };
                        } else {
                            console.log('else', data);
                            /*   return {
                                   results: [{
                                       text: nitValue, // Utiliza el valor de nitValue en lugar de params.term
                                       id: nitValue,
                                       selected: true
                                   }]
                                   
                               };*/
                        }
                    },
                    cache: true
                }
            }).on('select2:select', function(e) {
                if (e.params.originalEvent) {
                    console.log(e.params);
                    $('#stock_disponible').val(e.params.data.disponible || '');
                    $('#stock_precio').val(e.params.data.precio || '');
                    $('#stock_codigo').val(e.params.data.codigo || '');
                    $('#buscar_producto').append('<option value="' + e.params.data.id + '" selected>' + e
                        .params.data
                        .text + '</option>');
                    $('#buscar_producto').trigger('change');
                }
            });


        });
    </script>
@stop
