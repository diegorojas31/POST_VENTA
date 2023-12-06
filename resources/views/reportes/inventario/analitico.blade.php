@extends('adminlte::page')

@section('title', 'Productos')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon"
    style="border-radius: 50%;">

@section('content_top_nav_right')
    @livewire('notifications')
@endsection

@section('content_header')
@stop

@section('content')
    @livewire('reportes.inventario.analitico')
@stop

@section('css')
@stop
