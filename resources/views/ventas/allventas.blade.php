@extends('adminlte::page')

@section('title', 'Dashboard')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">

@section('content_header')


    <div style="display: flex; align-items: center;">
        <h1 style="margin-left: 10px;">Todas Las Ventas</h1>
    </div>
@stop

@section('content')


    <div data-simplebar class="nicescroll-bar">
        <div class="invoice-list-view">
            <table id="datable_1" class="table nowrap w-100 mb-5">
                <thead>
                    <tr>
                        <th><span class="form-check mb-0">
                                <input type="checkbox" class="form-check-input check-select-all" id="customCheck1">
                                <label class="form-check-label" for="customCheck1"></label>
                            </span></th>
                        
                        <th>Fecha</th>
                        <th>Monto Vendido</th>
                        <th>Cliente</th>
                        
                        <th>Caja</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $venta)
                    <tr>
                        <td></td>
                        <td>{{ $venta->fecha_venta }}</td>
                        <td><a href="#" class="table-link-text link-high-em">{{ $venta->montototal }}  Bs. </a></td>
                        <td>
                            <div class="text-dark">{{ $venta->nombre_cliente }}  {{ $venta->apellido_cliente }} </div>
                            
                        </td>
                        <td>
                            <span class="badge badge-danger">{{ $venta->title_caja }}</span>
                            <div class="fs-8 mt-1">{{ $venta->name }}</div>
                        </td>

                        <td>
                            <div class="d-flex align-items-center">

                                <a data-id="{{ $venta->id_venta }}" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover " 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                title="Descargar Venta Pdf" 
                                data-bs-original-title="Archivo" 
                                href="{{ route('abrir_factura', ['idventa' => $venta->id_venta]) }}">
                                <span class="btn-icon-wrap">
                                   <span class="fas fa-file-pdf"></span>
                                </span>
                             </a>
                                 
                                 
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Edit" href="contact-details.html"><span
                                            class="btn-icon-wrap"><span class="feather-icon"><i
                                                    data-feather="edit"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover del-button"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Delete" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>















@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- Data Table CSS -->
    <link href="{{ asset('Template/vendors/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('Template/vendors/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />

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

    <!-- Init JS -->
    <script src="{{ asset('Template/dist/js/init.js') }}"></script>
    <script src="{{ asset('Template/dist/js/invoice-data.js') }}"></script>
    <script src="{{ asset('Template/dist/js/chips-init.js') }}"></script>
    <script>
        $('.cerrar_caja').click(function() {
            console.log('le di click');
            var caja_id = $('#caja_id').val();

            $.ajax({
                url: '/allventas_caja/' + caja_id,
                type: 'GET',
                success: function(data) {
                    if (data) {

                    } else {
                        alert('No se pueden cerrar las ventas de la caja en este momento.');
                    }
                }
            });
        });
    </script>

<script>
    $(document).ready(function() {
        $('.descargar-pdf').click(function(e) {
            e.preventDefault(); // Prevenir el comportamiento predeterminado del enlace
    
            var ventaId = $(this).data('id'); // Obtener el ID de la venta
            console.log(ventaId);
            // Realizar la solicitud AJAX utilizando el ID de la venta
         /*   $.ajax({
                url: 'ruta/de/tu/controlador/accion/' + ventaId, // Reemplaza con la URL correcta
                method: 'GET', // Puedes usar 'POST' si necesitas enviar datos al servidor
                success: function(response) {
                    // Manejar la respuesta del servidor aquí
                    console.log(response);
                },
                error: function(error) {
                    // Manejar errores de la solicitud AJAX aquí
                    console.error('Error:', error);
                }
            });*/
        });
    });
    </script>
@stop
