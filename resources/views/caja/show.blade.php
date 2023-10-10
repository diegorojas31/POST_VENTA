@extends('adminlte::page')

@section('title', 'Detalles de '.$cajas->title_caja)

@section('content_header')
    <h1>Dashboard de la caja</h1>
@stop

@section('content')
<a href="{{route('caja.index')}}">
    <x-adminlte-button label="volver al inicio"/>
</a>

    <div class="container">
    <h1>Detalle de la Caja</h1>
    <p><strong>ID:</strong> {{ $cajas->id }}</p>
    <p><strong>Nombre:</strong> {{ $cajas->title_caja }}</p>
    <p><strong>Estado:</strong> {{ $cajas->estado }}</p>
    
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
