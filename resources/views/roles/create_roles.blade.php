@extends('adminlte::page')

@section('title', 'Crear Roles')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">


@section('content_header')
    <h1>Crear un Roles</h1>
@stop

@section('content')
    <form class="w-100" method="POST" action="{{ route('crear_roles') }}">
        @csrf

        <div class="card card-border">
            <div class="card-body">


                <div class="row gx-3">
                    <div class="form-group col-lg-12">
                        <label class="form-label">Nombre Rol</label>
                        <input class="form-control @error('nombre_rol') is-invalid @enderror" id="nombre_rol"
                            name="nombre_rol" type="text" value="{{ old('nombre_rol') }}">
                        @error('nombre_rol')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="form-label">Asignarle Permisos</label>
                    </div>
                    <div class="form-group col-lg-6">
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="2" name="2">
                            <label class="form-check-label" for="checkbox1">Sucursales</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="3" name="3">
                            <label class="form-check-label" for="checkbox2">Inventarios</label>
                        </div>
                    </div>
                    
                    <div class="form-group col-lg-6">
                    
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="4" name="4">
                            <label class="form-check-label" for="checkbox3">Cajas </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="5" name="5">
                            <label class="form-check-label" for="checkbox4">Ventas Y clientes</label>
                        </div>
                    </div>
                    
                   
                </div>

                <input type="hidden" id="id_bussines" name="id_bussines" value="{{ $datos->empresa_id }}">

                <button type="submit" class="btn btn-primary btn-rounded btn-uppercase btn-block">Registrar
                    Rol </button>
            </div>
        </div>
    </form>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- CSS -->
    <link href="{{ asset('Template/dist/css/style.css') }}" rel="stylesheet" type="text/css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
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

    <!-- Init JS -->
    <script src="{{ asset('Template/dist/js/init.js') }}"></script>


@stop
