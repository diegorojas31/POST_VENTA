@extends('adminlte::page')

@section('title', 'Productos')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">

@section('content_top_nav_right')
    @livewire('notifications')
@endsection

@section('content_header')
@stop
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">DETALLES DE PRODUCTO</h3>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-3 text-center"> <!-- Centramos el contenido -->
                    <img src="{{ asset($producto->image) }}" alt="Imagen" class="img-fluid">
                    <h2 class="mt-2">{{ $producto->nombre }}</h2>
                    <p>{{ $producto->descripcion }}</p>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Informacion del producto</h3>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <span class="fa fa-pen"></span>
                                        <b>Codigo</b> <a class="float-right">{{ $producto->barcode }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-tag"></span>
                                        <b>Precio</b> <a class="float-right">{{ $producto->precio }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-tag"></span>
                                        <b>Unidad de Medida</b> <a class="float-right">{{ $medida->nombre }}
                                            ({{ $medida->abreviatura }})</a>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-tag"></span>
                                        <b>Marca</b> <a class="float-right">{{ optional($producto->marca)->nombre ?? 'Sin marca' }}</a>
                                    </li>
                                </ul>
                                <span class="fa fa-barcode"></span>
                                <b>Codigo de Barra</b>
                                <br>
                                <div class="mb-3">{!! DNS1D::getBarcodeHTML($producto->barcode, $producto->tipo_codigo, 5,75,'black') !!}</div>
                        </div>
                        <div class="col-md-6">
                            <h4>Stock del producto</h3>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Stock Porcentaje</b> <a class="float-right">13,287</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Stock Disponible</b> <a class="float-right">{{ $stock->cantidad }}
                                            ({{ $medida->abreviatura }})</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Almacen</b> <a class="float-right">{{ optional($stock->almacen)->nombre ?? 'Sin almacén' }}</a>
                                    </li>
                                </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="#" class="btn btn-primary">
                <i class="fa fa-edit"></i> Editar
            </a>
            <a href="#" class="btn btn-dark ml-auto">
                <i class="fa fa-list"></i> Ver Lista
            </a>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
