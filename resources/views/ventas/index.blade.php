@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Ventas Del Empleado -> {{ $datos->name }} </h1>
@stop

@section('content')
    <div class="row">
        <button type="button" class="btn btn-primary cerrar_caja" data-bs-toggle="modal" data-bs-target="#miModal">
            Cerrar Caja
        </button>
    </div>
    <input type="hidden" id="caja_id" name="caja_id" value="{{ $caja->id_caja }}">
    <span> PROXIMAMENTE</span>
    <!-- Agrega este botón donde quieras que se abra el modal -->

    <!-- Agrega el modal, pero inicialmente oculto -->
    <div class="modal" tabindex="-1" id="miModal" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Monto Final</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="{{ route('cerrar_caja',['cajaventa_id'=> $caja->id]) }}" class="btn btn-primary">Terminar Ventas</a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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

    <!-- Daterangepicker JS -->
    <script src="{{ asset('Template/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('Template/vendors/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('Template/dist/js/daterangepicker-data.js') }}"></script>



    <!-- Apex JS -->
    <script src="{{ asset('Template/vendors/apexcharts/dist/apexcharts.min.js') }}"></script>

    <!-- Init JS -->
    <script src="{{ asset('Template/dist/js/init.js') }}"></script>
    <script src="{{ asset('Template/dist/js/chips-init.js') }}"></script>
    <script src="{{ asset('Template/dist/js/dashboard-data.js') }}"></script>
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
@stop
