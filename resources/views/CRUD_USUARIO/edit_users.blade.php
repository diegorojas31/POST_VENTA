@extends('adminlte::page')

@section('title', 'Editar Usuario')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">



@section('content_header')
    
        <h1 class="pg-title">Editar Mi Perfil</h1>
   
@stop

@section('content')


            <div class="row edit-profile-wrap">
                <div class="col-lg-2 col-sm-3 col-4">
                    <div class="nav-profile mt-4">
                        <div class="nav-header">
                            <span>Cuenta</span>
                        </div>
                        <ul class="nav nav-light nav-vertical nav-tabs">
                            @if (!isset($datos_empresa))
                                <li class="nav-item">
                                    <a data-bs-toggle="tab" href="#tab_block_1" class="nav-link active">
                                        <span class="nav-link-text">Perfil Personal</span>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a data-bs-toggle="tab" href="#tab_block_2" class="nav-link">
                                        <span class="nav-link-text">Perfil Empresarial</span>
                                    </a>
                                </li>
                            @endif

                            <li class="nav-item">
                                <a data-bs-toggle="tab" href="#tab_block_4" class="nav-link">
                                    <span class="nav-link-text">Cambiar Contraseña</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-lg-10 col-sm-9 col-8">
                    <div class="tab-content">
                        @if (!isset($datos_empresa))
                            <div class="tab-pane fade show active" id="tab_block_1">
                                <form action="{{ route('update_perfil') }}" method="POST">
                                    @csrf
                                    <div class="title title-xs title-wth-divider text-primary text-uppercase my-4">
                                        <span>Informacion Personal</span>
                                    </div>
                                    <div class="row gx-3">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Nombre</label>
                                                <input class="form-control @error('name') is-invalid @enderror"
                                                    id="name" name="name" type="text"
                                                    value="{{ $datos_empleado['nombre_empleado'] }}" />
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Apellido </label>
                                                <input class="form-control @error('lastname') is-invalid @enderror"
                                                    id="lastname" name="lastname" type="text"
                                                    value="{{ $datos_empleado['apellido_empleado'] }}" />
                                                @error('lastname')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row gx-3">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Correo</label>
                                                <input class="form-control @error('email') is-invalid @enderror"
                                                    type="email" id="email" name="email"
                                                    value="{{ $datos['email'] }}" />
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <input type="hidden" id="business_id" name="business_id"
                                        value="{{ $datos->empresa_id }}">
                                    <input type="hidden" id="rol_id" name="rol_id" value="{{ $datos->rol_id }}">
                                    <button type="submit" class="btn btn-primary mt-5">Guardar Cambios</button>
                                </form>
                            </div>
                        @else
                            <div class="tab-pane fade show active" id="tab_block_2">
                                <div class="title-lg fs-4"><span>Cuenta Empresarial</span></div>
                                <form method="POST" action="{{ route('update_perfil') }}">
                                    @csrf
                                    <div class="row gx-3">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Razon Social</label>
                                                <input class="form-control @error('razon_social') is-invalid @enderror"
                                                    type="text" id="razon_social" name="razon_social"
                                                    value="{{ old('razon_social', $datos_empresa['razon_social']) }}" />
                                                @error('razon_social')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Correo</label>
                                                <input class="form-control @error('email') is-invalid @enderror"
                                                    type="email" id="email" name="email"
                                                    value="{{ old('email', $datos['email']) }}" />
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">NIT</label>
                                                <input class="form-control @error('nit') is-invalid @enderror"
                                                    type="number" id="nit" name="nit"
                                                    value="{{ old('nit', $datos_empresa['nit_empresa']) }}" />
                                                @error('nit')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Nombre Titular</label>
                                                <input class="form-control @error('name') is-invalid @enderror"
                                                    id="name" name="name" type="text"
                                                    value="{{ old('name', $datos_empresa['nombre_titular']) }}" />
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Apellido Titular</label>
                                                <input class="form-control @error('lastname') is-invalid @enderror"
                                                    id="lastname" name="lastname" type="text"
                                                    value="{{ old('lastname', $datos_empresa['apellido_titular']) }}" />
                                                @error('lastname')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Celular</label>
                                                <input class="form-control @error('celular') is-invalid @enderror"
                                                    type="number" id="celular" name="celular"
                                                    value="{{ old('celular', $datos_empresa['celular_titular']) }}" />
                                                @error('celular')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="rol_id" name="rol_id" value="{{ $datos->rol_id }}">
                                    <input type="hidden" id="business_id" name="business_id"
                                        value="{{ $datos->empresa_id }}">
                                    <button type="submit" class="btn btn-primary mt-5">Guardar Cambios</button>
                                </form>

                            </div>
                        @endif
                        <div class="tab-pane fade" id="tab_block_4">
                            <div class="title-lg fs-4"><span>Cambiar Contraseña</span></div>

                            <form id="cambiarContraseñaForm">
                                @csrf
                                <div class="title title-xs title-wth-divider text-primary text-uppercase my-4">
                                    <span>Actualizar Contraseña</span>
                                </div>
                                <div class="row gx-3">
                                    <div id="mensaje"></div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Contraseña Antigua</label>
                                            <input class="form-control @error('antigua_contraseña') is-invalid @enderror"
                                                type="password" id="antigua_contraseña" name="antigua_contraseña"
                                                required />
                                            @error('antigua_contraseña')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    </div>
                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label class="form-label">Contraseña Nueva</label>
                                            <input class="form-control @error('nueva_contraseña') is-invalid @enderror"
                                                type="password" id="nueva_contraseña" name="nueva_contraseña" required />
                                            @error('nueva_contraseña')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Cambiar Contraseña</button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>

   



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- Bootstrap Dropify CSS -->
    <link href="{{ asset('Template/vendors/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- select2 CSS -->
    <link href="{{ asset('Template/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

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

    <!-- Select2 JS -->
    <script src="{{ asset('Template/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="dist/js/select2-data.js"></script>

    <!-- Dropify JS -->
    <script src="{{ asset('Template/vendors/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('Template/dist/js/dropify-data.js') }}"></script>

    <!-- Init JS -->
    <script src="{{ asset('Template/dist/js/init.js') }}"></script>
    <script src="{{ asset('Template/dist/js/contact-data.js') }}"></script>
    <script src="{{ asset('Template/dist/js/chips-init.js') }}"></script>
    <script>
        $('#cambiarContraseñaForm').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize();
            console.log(formData);

            $.ajax({
                url: '{{ route('cambiar_contraseña') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Manejar la respuesta del servidor aquí
                    console.log(response);
                    $('#mensaje').text('Contraseña Actualizada Correctamente').addClass('text-success')
                        .removeClass('text-danger');
                },
                error: function(error) {
                    // Manejar errores aquí
                    console.error(error);
                    $('#mensaje').text('La contraseña antigua no es correcta, Vuelve a Intentar')
                        .addClass('text-danger').removeClass('text-success');

                }
            });
        });
    </script>

@stop
