@extends('adminlte::page')

@section('title', 'Productos')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon"
    style="border-radius: 50%;">

@section('content_top_nav_right')
    @livewire('notifications')
@endsection

@section('content_header')
    <h1>Reporte de Cajas</h1>
@stop

@section('content')
    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
        Seleccionar Tipo de Reporte
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title">Tipo de Reporte</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{route('caja_analitico')}}" class="text-decoration-none">
                                <div class="mb-3">
                                    <i class="fa fa-chart-bar fa-3x text-white"></i>
                                    <p class="mt-2 text-white">Analiticos</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{route('caja_ejecutivo')}}" class="text-decoration-none">
                                <div class="mb-3">
                                    <i class="fa fa-user-tie fa-3x text-white"></i>
                                    <p class="mt-2 text-white">Ejecutivos</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="text-decoration-none">
                                <div class="mb-3">
                                    <i class="fa fa-cogs fa-3x text-white"></i>
                                    <p class="mt-2 text-white">Personalizados</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Abre el modal automáticamente al cargar la página
            $('#modal-info').modal('show');

            // Desactiva el cierre del modal al hacer clic fuera o presionar Esc
            $('#modal-info').modal({
                backdrop: 'static',
                keyboard: false
            });

            // Muestra el botón de cierre cuando se selecciona una opción
            $('#guardar-cambios').click(function() {
                $('#cerrar-modal').show();
            });
        });
    </script>
@stop
