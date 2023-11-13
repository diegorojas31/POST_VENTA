@extends('adminlte::page')

@section('title', 'Productos')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon"
    style="border-radius: 50%;">

@section('content_top_nav_right')
    @livewire('notifications')
@endsection

@section('content_header')
    <h1>Reporte de Stock Analtico</h1>
@stop

@section('content')
    @livewire('reportes.reporte-stock-analitico')

@stop

@section('css')
@stop

@section('js')
  <!-- jQuery -->
  <script src="{{ asset('Template/vendors/jquery/dist/jquery.min.js') }}"></script>
  <!-- Incluir jsPDF -->
  
@stop
