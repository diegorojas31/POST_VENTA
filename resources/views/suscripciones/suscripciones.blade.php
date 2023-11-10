@extends('adminlte::page')

@section('title', 'Plan de Suscripciones')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon"
    style="border-radius: 50%;">


@section('content_header')
    <h1>Suscribirme</h1>
@stop

@section('content')

    @livewire('metodo-pago')

    @livewire('subscription')

    @stack('modals')

    @livewireScripts

    @stack('js')


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- CSS -->
    <link href="{{ asset('Template/dist/css/style.css') }}" rel="stylesheet" type="text/css">
        <!-- ========================= CSS here ========================= -->
        <link rel="stylesheet" href="{{ asset('Site/assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('Site/assets/css/LineIcons.3.0.css') }}" />
        <link rel="stylesheet" href="{{ asset('Site/assets/css/animate.css') }}" />
        <link rel="stylesheet" href="{{ asset('Site/assets/css/tiny-slider.css') }}" />
        <link rel="stylesheet" href="{{ asset('Site/assets/css/glightbox.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('Site/assets/css/main.css') }}" />
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
    <!-- jQuery -->
    <script src="{{ asset('Template/vendors/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('Template/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- FeatherIcons JS -->
    <script src="{{ asset('Template/dist/js/feather.min.js') }}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{ asset('Template/dist/js/dropdown-bootstrap-extended.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('Template/vendors/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Init JS -->
    <script src="{{ asset('Template/dist/js/init.js') }}"></script>



@stop
