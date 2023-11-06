@extends('adminlte::page')

@section('title', 'Crear Medida')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">

@section('content_top_nav_right')
    @livewire('notifications')
@endsection

@section('content_header')
@stop


@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Crear Unidades de Medida</h3>
        </div>
        @if (session('info'))
            <div class="alert alert-success">
                <strong>{{ session('info') }}</strong>
            </div>
        @endif
        {!! Form::open(['route' => 'medidas.store']) !!}
        <div class="card-body">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre') !!}
                            {!! Form::text('nombre', null, [
                                'class' => 'form-control',
                                'placeholder' => 'Ingrese el nombre de la Unidad de Medida',
                            ]) !!}

                            @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('descripcion', 'Descripción') !!}
                            {!! Form::textarea('descripcion', '', [
                                'class' => 'form-control',
                                'placeholder' => 'Ingrese una descripción',
                                'rows' => 4,
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('abreviatura', 'Abreviatura') !!}
                            {!! Form::text('abreviatura', null, [
                                'class' => 'form-control',
                                'placeholder' => 'Ingrese la abreviatura',
                            ]) !!}
                            @error('abreviatura')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            {!! Form::submit('Crear', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
