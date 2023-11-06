@extends('adminlte::page')

@section('title', 'Bitacora')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">

@section('content_header')
    <h1>BITACORA</h1>
@stop

@section('content')
   

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
        <!-- Bootstrap Dropify CSS -->
        <link href="{{ asset('Template/vendors/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- select2 CSS -->
        <link href="{{ asset('Template/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    
        <!-- CSS -->
        <link href="{{ asset('Template/dist/css/style.css') }}" rel="stylesheet" type="text/css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
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
      
          <!-- Select2 JS -->
          <script src="{{ asset('Template/vendors/select2/dist/js/select2.full.min.js') }}"></script>
          <script src="dist/js/select2-data.js"></script>
      
          <!-- Dropify JS -->
          <script src="{{ asset('Template/vendors/dropify/dist/js/dropify.min.js') }}"></script>
          <script src="{{ asset('Template/dist/js/dropify-data.js') }}"></script>
      
          <!-- Init JS -->
          <script src="{{ asset('Template/dist/js/init.js') }}"></script>
          <script src="{{ asset('Template/dist/js/contact-data.js') }}"></script>
          <script src="{{ asset('Template/dist/js/chips-init.js') }}"></script>
@stop