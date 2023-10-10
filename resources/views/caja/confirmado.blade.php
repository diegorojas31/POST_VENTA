@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success">
            <h4><i class="fa fa-check"></i> Edicion Confirmada</h4>
            El registro ha sido Actualizado exitosamente.
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