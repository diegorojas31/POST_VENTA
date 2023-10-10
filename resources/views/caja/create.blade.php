@extends('adminlte::page')

@section('title', 'Post Venta - Create')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">

@section('content_header')
    <h1>CREAR CAJA</h1>
@stop

@section('content')
    <p></p>
    <a href="{{route('caja.index')}}">
        <x-adminlte-button label="volver al inicio"/>
    </a>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Formulario</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('caja.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="nombre">Nombre de caja</label>
                                <input type="text" name="nombrecaja" id="nombre" class="form-control" required>
                            </div>
                            {{-- <div class="form-group">
                                <label for="estado">Estado</label>
                                <select name="estado" id="estado" class="form-control" required>
                                    <option value="inhabilitado">Inhabilitado</option>
                                    <option value="habilitado">Habilitado</option>
                                </select>
                            </div> --}}
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
