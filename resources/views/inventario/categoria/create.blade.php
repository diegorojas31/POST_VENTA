@extends('adminlte::page')

@section('title', 'New Categoria')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Crear Categorias</h3>
        </div>
        @if (session('info'))
            <div class="alert alert-success">
                <strong>{{ session('info') }}</strong>
            </div>
        @endif

        <div class="card-body">
            {!! Form::open(['route' => 'categorias.store', 'files' => true]) !!}
            <div class="row">
                <div class="col-md-4">
                    <!-- Contenido de la primera columna -->
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            Imagen de la Categoria (Opcional)
                        </div>
                        <div class="image-wrapper">
                            <img id="picture" src="{{ asset('images/no-image.png') }}" alt="">
                        </div>
                        <div class="card-body text-center">
                                <p>Tamaño maximo 2MB, archivos: jpg y png.</p>
                        </div>
                        <div class="card-footer text-center">
                            <div class="form-group text-center">
                                <div class="d-flex justify-content-center">
                                    <label class="input-group-btn mr-2">
                                        <span class="btn btn-sm btn-primary">
                                            <i class="fas fa-image"></i> Subir Imagen
                                            {!! Form::file('file', [
                                                'class' => 'form-control-file',
                                                'id' => 'file',
                                                'style' => 'display:none',
                                                'accept' => 'image/*',
                                            ]) !!}
                                        </span>
                                    </label>
                                    <label class="input-group-btn ml-2">
                                        <span class="btn btn-sm btn-danger">
                                            <i class="fas fa-eye-slash"></i> Eliminar Imagen
                                            {{-- {!! Form::file('file', ['style' => 'display:none', 'accept' => 'image/*']) !!} --}}
                                        </span>
                                    </label>
                                </div>
                                @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ml-5">
                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre') !!}
                        {!! Form::text('nombre', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Ingrese el nombre de la categoria',
                        ]) !!}

                        @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripción (opcional)') !!}
                        {!! Form::textarea('descripcion', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Ingrese una descripción',
                            'rows' => 4,
                        ]) !!}
                    </div>
                    <div class="form-group d-flex justify-content-center mt-5">
                        {!! Form::submit('Crear Categoria', ['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>

        <div class="card-footer">
        </div>
    </div>
@stop
@section('css')
    <style>
        .image-wrapper {
            position: relative;
            padding-bottom: 56%;
        }

        .image-wrapper img {

            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
@stop

@section('js')
    <script>
        document.querySelector('input[type="file"]').addEventListener('change', cambiarImagen);

        function cambiarImagen(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result);
            };

            reader.readAsDataURL(file);
        }
    </script>
@stop
