@extends('adminlte::page')

@section('title', 'Caja')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<a href="{{route('apertura.index')}}">
    <x-adminlte-button label="volver al inicio"/>
</a>
{{$apertura}};
<div class="box box-primary">
    <div class="box-body">
        <table class="table table-bordered">

            @foreach($apertura as $item)
                <tr>
                <th>ID</th>
                <td>{{ $item->id_caja }}</td>
                </tr>
                <tr>
                <th>Saldo Inicial</th>
                <td>{{ $item->saldo_inicial }}</td>
                </tr>
                <tr>
                    <th>Saldo Final</th>
                    <td>{{ $item->saldo_final ?? 'vacio' }}</td>
                </tr>
                <tr>
                    <th>Fecha de apertura</th>
                    <td>{{ $item->fecha_apertura}}</td>
                </tr>
                <tr>
                    <th>Fecha de cierre</th>
                    <td>{{ $item->fecha_cierre?? 'vacio'}}</td>
                </tr>
            @endforeach

            {{-- <tr>
                <th>ID de Usuario</th>
                <td>{{ $caja->id_usuario }}</td>
            </tr> --}}

            {{-- <tr>
                <th>ID de Caja</th>
                <td>{{ $caja->id_caja }}</td>
            </tr> --}}

            
            {{-- <tr>
                <th>Fecha</th>
                <td>{{ $caja->fecha }}</td>
            </tr>
            <tr>
                <th>Nombre</th>
                <td>{{ $caja->nombre }}</td>
            </tr>  --}}
        </table>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
