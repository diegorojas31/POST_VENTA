@extends('adminlte::page')

@section('title', 'Categorias')
{{-- <link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;"> --}}

@section('content_header')
@stop

@section('content')
    @livewire('inventario.categoria-index')
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

@stop