@extends('adminlte::page')

@section('title', 'Crear Usuario')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">


@section('content_header')
    <h1>Crear un Usuario Empleado</h1>
@stop

@section('content')
    <form class="w-100" method="POST" action="{{ route('crear_empleado_users') }}">
        @csrf

        <div class="card card-border">
            <div class="card-body">


                <div class="row gx-3">
                    <div class="form-group col-lg-6">
                        <label class="form-label">Nombre</label>
                        <input class="form-control @error('nombre_empleado') is-invalid @enderror" id="nombre_empleado"
                            name="nombre_empleado" type="text" value="{{ old('nombre_empleado') }}">
                        @error('nombre_empleado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label">Apellido</label>
                        <input class="form-control @error('apellido_empleado') is-invalid @enderror" id="apellido_empleado"
                            name="apellido_empleado" type="text" value="{{ old('apellido_empleado') }}">
                        @error('apellido_empleado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label">Correo</label>
                        <input class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                            type="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label">Contraseña</label>
                        <div class="input-group password-check">
                            <span class="input-affix-wrapper affix-wth-text">
                                <input class="form-control @error('password') is-invalid @enderror" id="password"
                                    name="password" type="password">
                                <a href="#" class="input-suffix text-primary text-uppercase fs-8 fw-medium">
                                    <span>Show</span>
                                    <span class="d-none">Hide</span>
                                </a>
                            </span>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label">Celular</label>
                        <input class="form-control @error('celular_empleado') is-invalid @enderror" id="celular_empleado"
                            name="celular_empleado" type="number" value="{{ old('celular_empleado') }}">
                        @error('celular_empleado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label">Tipo Empleado</label>
                        <select class="form-control @error('cargo_id') is-invalid @enderror" name="cargo_id" id="cargo_id">
                            <option value="0">Seleccione un cargo</option>
                            @foreach ($cargos as $cargo)
                                <option value="{{ $cargo->id }}">{{ $cargo->nombre_cargo }}</option>
                            @endforeach
                        </select>
                        @error('cargo_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label">Selecione un Rol</label>
                        <select class="form-control @error('rol_id') is-invalid @enderror" name="rol_id" id="rol_id">
                            <option value="0">Seleccione un rol</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endforeach
                        </select>
                        @error('rol_id')
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
