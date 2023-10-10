
@extends('adminlte::page')

@section('title', 'Crear Caja')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">

@section('content_header')
    <h1>Crear apertura de {{$caja->title_caja}}</h1>
@stop

@section('content')

<a href="{{route('apertura.index')}}">
    <x-adminlte-button label="volver al inicio"/>
</a>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Empezar apertura</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('apertura.store',$caja) }}">
                        @csrf
                        {{-- <div class="form-group">
                            <label for="nombre">Nombre de caja</label>
                            <input type="text" name="nombrecaja" id="nombre" class="form-control" required>
                        </div> --}}
                        
                        <div class="form-group">
                            <label for="numeroDecimal">Inserte el monto</label>
                            <input type="number" name="saldo_inicial" id="numeroDecimal" class="form-control" step="0.01" required>
                            <!-- El atributo step="0.01" permite números decimales con dos decimales -->
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
