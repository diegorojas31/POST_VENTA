@extends('adminlte::page')

@section('title', 'Crear Usuario')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">


@section('content_header')
    <h1>Registrar Cliente</h1>
@stop

@section('content')
    <form class="w-100" method="POST" action="{{ route('crear_cliente') }}">
        @csrf

        <div class="card card-border">
            <div class="card-body">


                <div class="row gx-3">
                    <div class="form-group col-lg-6">
                        <label class="form-label">Nombre</label>
                        <input class="form-control @error('nombre_cliente') is-invalid @enderror" id="nombre_cliente"
                            name="nombre_cliente" type="text" value="{{ old('nombre_cliente') }}">
                        @error('nombre_cliente')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label">Apellido</label>
                        <input class="form-control @error('apellido_cliente') is-invalid @enderror" id="apellido_cliente"
                            name="apellido_cliente" type="text" value="{{ old('apellido_cliente') }}">
                        @error('apellido_cliente')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label">Celular</label>
                        <input class="form-control @error('celular_cliente') is-invalid @enderror" id="celular_cliente"
                            name="celular_cliente" type="number" value="{{ old('celular_cliente') }}">
                        @error('celular_cliente')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label">CI / Nit</label>
                        <input class="form-control @error('nit_cliente') is-invalid @enderror" id="nit_cliente"
                        name="nit_cliente" type="number" value="{{ old('nit_cliente') }}">
                        @error('nit_cliente')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <input type="hidden" id="id_bussines" name="id_bussines" value="{{ $datos->empresa_id }}">

                <button type="submit" class="btn btn-primary btn-rounded btn-uppercase btn-block">Registrar
                    Empleado</button>
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
