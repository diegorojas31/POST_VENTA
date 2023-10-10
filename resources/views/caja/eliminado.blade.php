
@extends('adminlte::page')

@section('title', 'PostVenta -DELETE')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success">
            <h4><i class="fa fa-check"></i> Eliminado</h4>
            El registro ha sido eliminado exitosamente.
        </div>
        <a href="{{ route('caja.index') }}" class="btn btn-primary">Volver al inicio</a>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
