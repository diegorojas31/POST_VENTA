@extends('adminlte::page')

@section('title', 'Caja')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">

@section('content_header')
    <h1>Cajas De venta</h1>
@stop

@section('content')
<div class="contact-body">
    <div data-simplebar class="nicescroll-bar">
        

        <div class="contact-list-view">
            <table id="datable_1" class="table nowrap w-100 mb-5">
                <thead>
                    <tr>
                        <th><span class="form-check mb-0">
                            <input type="checkbox" class="form-check-input check-select-all" id="customCheck1">
                            <label class="form-check-label" for="customCheck1"></label>
                        </span></th>
                        <th>Nombre</th>
                        <th>Estado</th>

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cajas as $caja)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="contact-star marked"><span class="feather-icon"><i data-feather="star"></i></span></span>
                            </div>
                        </td>
                        <td>
                            <div class="media align-items-center">
        
                                <div class="media-body">
                                    <span class="d-block text-high-em">{{ $caja->title_caja}}</span> 
                                </div>
                            </div>
                        </td>
                        <td class="text-truncate">{{ $caja->estado }}</td>

                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-flex">
                                    @if($caja->estado == 'habilitado')
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Continuar Caja" href="{{ route('abrir_ventas',['cajaventa_id'=>$caja->cajaventa]) }}">
                                        <span class="icon">
                                            <span class="feather-icon">
                                                <i class="bi bi-shop"></i>
                                            </span>
                                        </span>
                                    </a>
                                @else
                                    <!-- Aquí colocas el código HTML y el icono que deseas mostrar cuando $datos->estado no sea 'habilitado' -->
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Iniciar Caja" href="{{ route('apertura.create',['caja'=>$caja->id]) }}">
                                        <span class="icon">
                                            <span class="feather-icon">
                                                <i class="bi bi-cart-plus"></i> <!-- Cambia 'otro-icono' por la clase del otro icono que desees usar -->
                                            </span>
                                        </span>
                                    </a>
                                @endif
                                
                                    
                                    
                                </div>

                            </div>
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>
    </div>
</div>
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