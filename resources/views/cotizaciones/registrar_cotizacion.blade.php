@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_top_nav_right')
    @livewire('notifications')
@endsection

@section('content_header')


    <div style="display: flex; align-items: center;">

        <h1 style="margin-left: 10px;">Cotizacion Del Empleado -> {{ $datos->name }}</h1>
    </div>


@stop

@section('content')




    <div class="blogapp-content">
        <div class="blogapp-detail-wrap">

            <div class="blog-body">
                <div data-simplebar class="nicescroll-bar">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xxl-9 col-lg-8">
                                <form class="edit-post-form">
                                    @csrf
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

                                    <button class="btn btn-primary btn-block mb-3" id="registrar_cotizacion">Registra
                                        Cotizacion</button>
                                    <!-- Agrega un campo oculto para almacenar el ID de la venta -->

                                    <div class="form-group">
                                        <label class="form-label">Fecha Limite</label>
                                        <input class="form-control cal-event-date-start" id="fecha"
                                            name="single-date-pick" type="text" />
                                    </div>


                                    <div class="card card-border">
                                        <div class="card-body">
                                            <form class="edit-post-form">
                                                <div class="form-group">
                                                    <label class="form-label">Buscar Producto</label>
                                                    <div class="row">
                                                        <div class="col-9">
                                                            <select id="buscar_producto" class="js-example-basic-single form-control" style="width: 100%;">
                                                                <!-- Opciones pre-cargadas o vacías -->
                                                            </select>
                                                        </div>
                                                        <div class="col-3">
                                                            <!-- Botón para abrir el modal -->
                                                            <button id="scanModal1" title="Escanear Código de Barras" type="button" class="btn btn-primary btn-block text-center" data-toggle="modal" data-target="#scanModal">
                                                                <i class="bi bi-upc-scan d-block mx-auto"></i>
                                                            </button>
                                                            
                                                        </div>
                                                    </div>
                                                    
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
                                                    <div class="invalid-feedback1">Selecciona una cantidad</div>
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















   
    <!-- Modal para escanear códigos de barras -->
<!-- Modal para escanear códigos de barras -->
<div class="modal fade" id="scanModal" tabindex="-1" role="dialog" aria-labelledby="scanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg d-flex align-items-center justify-content-center" role="document"> <!-- Utilizamos Flexbox para centrar vertical y horizontalmente -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scanModalLabel">Escanear Código de Barras</h5>
                <button  type="button" class="close close1" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-center"> <!-- Utilizamos Flexbox para centrar vertical y horizontalmente -->
                <!-- Aquí colocarás el lector de códigos de barras, por ejemplo, usando QuaggaJS -->
                <div id="barcode-scanner-modal" style="width: 480px; max-height: 480px; border: 2px solid #ddd; border-radius: 8px; overflow: hidden;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close1" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- Sweetalert2 CSS -->
    <link href="{{ asset('Template/vendors/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css') }}" rel="stylesheet"
        type="text/css">


    <!-- Bootstrap Dropify CSS -->
    <link href="{{ asset('Template/vendors/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Colorpicker -->
    <link href="{{ asset('Template/vendors/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}"
        rel="stylesheet" type="text/css" />
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

    <script src="{{ asset('Template/vendors/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    <!-- FeatherIcons JS -->
    <script src="{{ asset('Template/dist/js/feather.min.js') }}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{ asset('Template/dist/js/dropdown-bootstrap-extended.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('Template/vendors/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Bootstrap Colorpicker JS -->
    <script src="{{ asset('Template/vendors/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('Template/dist/js/color-picker-data.js') }}"></script>

    <!-- Data Table JS -->
    <script src="{{ asset('Template/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Template/vendors/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Template/vendors/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <!-- Fullcalendar JS -->
    <script src="{{ asset('Template/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('Template/vendors/fullcalendar/main.min.js') }}"></script>
    <script src="{{ asset('Template/vendors/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('Template/dist/js/daterangepicker-data.js') }}"></script>
    <script src="{{ asset('Template/vendors/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('Template/dist/js/fullcalendar-init.js') }}"></script>
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
    <script src="https://cdn.rawgit.com/serratus/quaggaJS/0.12.1/dist/quagga.min.js"></script>
    <script src="https://cdn.rawgit.com/serratus/quaggaJS/0.12.1/dist/adapter.js"></script>

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
                var stockCantidad = $('#stock_cantidad').val();
                var invalidFeedback = $('.invalid-feedback1');

                // Obtener los valores de los campos
                if ($('.invalid-feedback').is(':visible') || stockCantidad === '' || parseFloat(
                        stockCantidad) === 0) {
                    // No se ejecuta más código si el mensaje de error está visible o la cantidad es 0 o está vacía
                    invalidFeedback.text('Selecciona una cantidad').show();

                    return;
                }
                invalidFeedback.hide();
                // Tu código aquí para continuar con la lógica cuando la validación sea exitosa

                var buscarProducto = $('#buscar_producto').val();
                var stockPrecio = $('#stock_precio').val();
                var stockCodigo = $('#stock_codigo').val();
                var stockDisponible = $('#stock_disponible').val();


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
                    '<td><button type="button" class="btn btn-success btn-sm borrarFila"><i class="bi bi-trash"></i></button></td>' +
                    '</tr>';

                $('#tabla_ventas tbody').append(newRow);
                var mensajeVacio = $('.empty-message');
                mensajeVacio.hide();

                actualizarTotalVenta();

                // Limpiar campos
                $('#buscar_producto').val('').trigger('change');
                $('#stock_precio, #stock_codigo, #stock_disponible, #stock_cantidad').val('');


            });

            $('#registrar_cotizacion').click(function(event) {
                event.preventDefault();


                var nombre_cliente = $('#nombre_cliente').val();
                var apellido_cliente = $('#apellido_cliente').val();
                var celular_cliente = $('#celular_cliente').val();
                var nit_cliente = $('#search option:selected').text();

                // $('#buscar_producto option:selected').text();
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
                console.log(productosJSON, nombre_cliente, apellido_cliente, celular_cliente, nit_cliente);
                var totalVenta = $('#tabla_ventas tfoot tr th:last').prev().text();

                // Convierte el valor a un número (puede ser necesario si el valor está en formato de texto)
                totalVenta = parseFloat(totalVenta);



                // Ahora totalVenta contiene el valor total de la venta
                console.log('Total Venta:', totalVenta);

                Swal.fire({
                    html: '<div class="mb-3"><i class="bi bi-bag-check fs-5 text-success"></i></div><h5 class="text-success">Realizar una cotizacion</h5><p>TOTAL DE LA cotizacion:  ' +
                        totalVenta + ' Bs. </p>',
                    customClass: {
                        confirmButton: 'btn btn-outline-secondary text-success',
                        cancelButton: 'btn btn-outline-secondary text-grey',
                        container: 'swal2-has-bg'
                    },
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: 'Realizar Cotizacion',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.value) {

                        // Configura la solicitud AJAX
                        $.ajax({
                            url: '{{ route('registrar_cotizacion') }}', // URL de ejemplo
                            type: 'POST', // Método de solicitud (POST en este caso)
                            dataType: 'json', // Tipo de datos que enviarás y esperas recibir (JSON en este caso)
                            data: {
                                _token: '{{ csrf_token() }}',
                                nombre_cliente: nombre_cliente,
                                apellido_cliente: apellido_cliente,
                                celular_cliente: celular_cliente,
                                productosJSON: productosJSON,
                                nit_cliente: nit_cliente,
                                fechalimite: $('#fecha').val(),
                                totalVenta: totalVenta
                            }, // Datos que enviarás al servidor
                            success: function(data) {
                                // Esta función se ejecuta cuando la solicitud es exitosa
                                console.log('Respuesta exitosa:', data);
                                Swal.fire({
                                    html: '<div class="d-flex align-items-center"><i class="bi bi-bag-check me-2 fs-3 text-success"></i><h5 class="text-success mb-0">La venta fue registrada exitosamente!</h5></div>',
                                    timer: 2000,
                                    customClass: {
                                        content: 'p-0 text-left',
                                        actions: 'justify-content-start',
                                    },
                                    showConfirmButton: false,
                                    buttonsStyling: false,
                                })

                                //generarPdf(data.Ventas.id);
                            },
                            error: function(xhr, status, error) {
                                // Esta función se ejecuta en caso de error
                                console.error('Error en la solicitud:', status, error);
                                Swal.fire({
                                    html: '<div class="d-flex align-items-center"><i class="bi bi-bag-x me-2 fs-3 text-danger"></i><h5 class="text-danger mb-0">No se pudo procesar la venta!</h5></div>',
                                    timer: 2000,
                                    customClass: {
                                        content: 'p-0 text-left',
                                        actions: 'justify-content-start',
                                    },
                                    showConfirmButton: false,
                                    buttonsStyling: false,
                                })
                            }
                        });



                    }
                })
            });

            function generarPdf(idVenta) {
                // Construye la URL para la generación de PDF con el ID de la venta
                var urlPdf = '{{ route('generarpdfventas', ['idventa' => ':idVenta']) }}';
                urlPdf = urlPdf.replace(':idVenta', idVenta);

                // Crea un enlace temporal y haz clic en él para abrir la URL
                var link = document.createElement('a');
                link.href = urlPdf;
                link.target = '_blank';
                link.classList.add('d-none');
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }


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
                                        text: item.nombre,
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
      <script>
        // Configuración de QuaggaJS para el lector dentro del modal


        // Iniciar QuaggaJS cuando se abre el modal
        $('#scanModal1').on('click', function () {
            console.log('entro');
            Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#barcode-scanner-modal'),
            },
            decoder: {
                readers: ["ean_reader"],
            }
        });
        });

        // Detener QuaggaJS cuando se cierra el modal
        $('.close1').on('click', function () {
            Quagga.stop();
        });

        // Manejar el resultado del escaneo dentro del modal
        Quagga.onDetected(function(result) {
            var barcode = result.codeResult.code;
            console.log("Código de barras escaneado (modal): " + barcode);

            // Aquí puedes realizar acciones adicionales con el código escaneado
        });
    </script>
@stop
