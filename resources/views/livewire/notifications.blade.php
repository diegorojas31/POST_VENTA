<div>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">
                {{ auth()->user()->unreadNotifications()->count() }}
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
            <span class="dropdown-item dropdown-header">
                {{ auth()->user()->unreadNotifications()->count() }} Notificaciones nuevas
            </span>
            <div class="dropdown-divider"></div>
            <div class="notification-list" style="max-height: 500px; overflow-y: auto;">
                @if ($this->notifications->count() > 0)
                    @foreach ($this->notifications as $notification)
                        <a href="{{ route('productos.show', $notification->data['producto_id']) }}"
                            class="dropdown-item"
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
            <a href="{{ route('notificaciones') }}" class="dropdown-item dropdown-footer">
                Ver todos
            </a>
        </div>
    </li>
</div>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const notificationItems = document.querySelectorAll('.notification-item');

        notificationItems.forEach(function(item) {
            item.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevenimos que se propague el evento
            });
        });
    });
</script> --}}
