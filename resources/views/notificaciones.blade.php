@extends('adminlte::page')

@section('title', 'Notificaciones')

@section('content_top_nav_right')
    @livewire('notifications')
@endsection

@section('content_header')
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Notificaciones</h3>
            </div>

            <div class="card-body">
                @if ($notificaciones)
                    @foreach ($notificaciones as $notification)
                        <a href="{{ route('productos.show', $notification->data['producto_id']) }}" class="dropdown-item"
                            style="@if (!$notification->read_at) background-color: #f0f0f0; @endif"
                            wire:click="readNotification('{{ $notification->id }}')">
                            <i class="fas fa-exclamation-triangle mr-2 text-warning"></i>Stock Bajo
                            <span class="float-right text-muted text-sm">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>
                            <br>
                            <p style="font-size: 15px; color: #888;"> <!-- Cambia #888 al color que desees -->
                                El producto {{ $notification->data['name'] }} tiene stock bajo:
                                {{ $notification->data['cantidad'] }}
                            </p>
                        </a>
                        <div class="dropdown-divider"></div>
                    @endforeach
                @else
                    <p>No tienes notificaciones</p>
                    <div class="dropdown-divider"></div>
                @endif

            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')

@stop
