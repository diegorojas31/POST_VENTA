@extends('adminlte::page')

@section('title', 'Edit Producto')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon"
    style="border-radius: 50%;">

@section('content_top_nav_right')
    @livewire('notifications')
@endsection

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
                                            <i class="fas fa-image"></i> Subir Imagen
                                            {!! Form::file('file', [
                                                'class' => 'form-control-file',
                                                'id' => 'file',
                                                'style' => 'display:none',
                                                'accept' => 'image/*',
                                            ]) !!}
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
                <div class="col-md-8">
                    <div class="form-group">
                        {!! Form::label('barcode', 'Codigo de barra') !!}
                        {!! Form::text('barcode', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Codigo único',
                            'id' => 'barcode-input',
                        ]) !!}
                        @error('barcode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('categoria_id', 'Categoria') !!}
                                <div class="input-group">
                                    {!! Form::select('categoria_id', $categorias, null, ['class' => 'form-control']) !!}
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success">
                                            <i class="fas fa-plus"></i> <!-- Icono + -->
                                        </button>
                                    </div>
                                </div>

                                @error('categoria_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- @livewire('inventario.componentes.categoria-select') --}}
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('medida_id', 'Unidad de Medida') !!}
                                <div class="input-group">
                                    {!! Form::select('medida_id', $medidas, null, ['class' => 'form-control']) !!}
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success">
                                            <i class="fas fa-plus"></i> <!-- Icono + -->
                                        </button>
                                    </div>
                                </div>

                                @error('medida_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <!-- Marca -->
                            <div class="form-group">
                                {!! Form::label('marca_id', 'Marca') !!}
                                <div class="input-group">
                                    {!! Form::select('marca_id', ['' => 'Ninguno'] + $marcas->all(), null, ['class' => 'form-control']) !!}
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success">
                                            <i class="fas fa-plus"></i> <!-- Icono + -->
                                        </button>
                                    </div>
                                </div>

                                @error('marca_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Stock Actual -->
                            <div class="form-group">
                                {!! Form::label('cantidad', 'Stock (actual)') !!}
                                {!! Form::number('cantidad', $stock->cantidad, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Cantidad Actual',
                                ]) !!}

                                @error('cantidad')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Almacen -->
                            <div class="form-group">
                                {!! Form::label('almacen_id', 'Almacen') !!}
                                <div class="input-group">
                                    {!! Form::select('almacen_id', ['' => 'Ninguno'] + $almacens->all(), $stock->almacen_id ?? null, ['class' => 'form-control']) !!}
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success">
                                            <i class="fas fa-plus"></i> <!-- Icono + -->
                                        </button>
                                    </div>
                                </div>

                                @error('almacen_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('minimo', 'Stock minimo') !!}
                                {!! Form::number('minimo', $stock->minimo, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Cantidad minima del producto.',
                                ]) !!}

                                @error('minimo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('maximo', 'Stock máximo') !!}
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
                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripción') !!}
                        {!! Form::textarea('descripcion', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Ingrese una descripción',
                            'rows' => 4,
                        ]) !!}
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
