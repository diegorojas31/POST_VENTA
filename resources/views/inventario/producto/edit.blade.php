@extends('adminlte::page')

@section('title', 'Edit Producto')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">

@section('content_header')
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar Producto</h3>
        </div>
        @if (session('info'))
            <div class="alert alert-success">
                <strong>{{ session('info') }}</strong>
            </div>
        @endif
        <div class="card-body">
            {!! Form::model($producto, ['route' => ['productos.update', $producto], 'method' => 'put', 'files' => true]) !!}
            <div class="row">
                <div class="col-md-4">
                    <!-- Contenido de la primera columna -->
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            Imagen del Producto (Opcional)
                        </div>
                        <div class="card-body text-center">
                            <img id="picture" src="{{ asset($producto->image) }}" alt="Imagen del producto"
                                class="img-thumbnail" style="max-width: 200px; display: inline-block;">

                            <p>Tamaño maximo 2MB, archivos: jpg y png.</p>
                        </div>
                        <div class="card-footer text-center">
                            <div class="form-group text-center">
                                <div class="d-flex justify-content-center">
                                    <label class="input-group-btn mr-2">
                                        <span class="btn btn-sm btn-primary">
                                            <i class="fas fa-user"></i> Subir Imagen
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
                                            <i class="fas fa-user"></i> Eliminar Imagen
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
                <div class="col-md-4">
                    <!-- Contenido de la segunda columna -->
                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre') !!}
                        {!! Form::text('nombre', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Ingrese el nombre del producto',
                        ]) !!}

                        @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('categoria_id', 'Categoria del Producto') !!}
                        {!! Form::select('categoria_id', $categorias, null, ['class' => 'form-control']) !!}

                        @error('categoria_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Unidad de Medida -->
                    <div class="form-group">
                        {!! Form::label('medida_id', 'Unidad de Medida') !!}
                        {!! Form::select('medida_id', $medidas, null, ['class' => 'form-control']) !!}

                        @error('medida_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Precio -->
                    <div class="form-group">
                        {!! Form::label('precio', 'Precio') !!}
                        {!! Form::number('precio', $producto->precio, [
                            'class' => 'form-control',
                            'placeholder' => 'Precio del producto.',
                        ]) !!}

                        @error('precio')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Contenido de la tercera columna -->
                    <div class="form-group">
                        {!! Form::label('barcode', 'Codigo de barra') !!}
                        {!! Form::text('barcode', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Codigo único',
                        ]) !!}

                        @error('barcode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripción') !!}
                        {!! Form::textarea('descripcion', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Ingrese una descripción',
                            'rows' => 4,
                        ]) !!}
                    </div>

                    <div class="form-group mt-4">
                        {!! Form::label('marca', 'Marca') !!}
                        {!! Form::text('marca', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Ingrese la Marca del producto (opcional)',
                        ]) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-8">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Stock Producto</strong></h3>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <!-- Cantidad -->
                    <div class="form-group">
                        {!! Form::label('cantidad', 'Cantidad (actual)') !!}
                        {!! Form::number('cantidad', $stock->cantidad, [
                            'class' => 'form-control',
                            'placeholder' => 'Cantidad Actual',
                        ]) !!}

                        @error('cantidad')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('minimo', 'Cantidad Minima') !!}
                        {!! Form::number('minimo', $stock->minimo, [
                            'class' => 'form-control',
                            'placeholder' => 'Cantidad minima del producto.',
                        ]) !!}

                        @error('minimo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('ubicacion', 'Ubicacion') !!}
                        {!! Form::text('ubicacion', $stock->ubicacion, [
                            'class' => 'form-control',
                            'placeholder' => 'Ubicacion del Procducto',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('maximo', 'Cantidad Maxima') !!}
                        {!! Form::number('maximo', $stock->maximo, [
                            'class' => 'form-control',
                            'placeholder' => 'Caantidad maxima del prducto.',
                        ]) !!}

                        @error('maximo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-8 text-right">
                    {!! Form::submit('Actualizar', ['class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('productos.index') }}" class="btn btn-dark float-right">
                <i class="fa fa-arrow-right"></i> Ver lista
            </a>
        </div>
    </div>
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
