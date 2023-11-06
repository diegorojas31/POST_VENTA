<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    @if (session('success'))
        <div class="alert alert-success">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Marcas de Producto</h3>
        </div>

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="col-6">
                    <input wire:model.live="search" class="form-control" placeholder="Buscar marcas...">
                </div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-lg">
                    Añadir nuevo
                </button>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        {{-- <th style="width: 10px">#</th> --}}
                        <th style="width: 650px">Nombre</th>
                        <th style="width: 100px">Estado</th>
                        <th style="width: 200px" class="text-center">Fecha Creación</th>
                        <!-- Agregamos "text-center" a la columna Abreviatura -->
                        <th class="text-center">Acciones</th> <!-- Agregamos "text-center" a la columna Acciones -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marcas as $marca)
                        <tr>
                            <td>{{ $marca->nombre }}</td>
                            <td>
                                @if ($marca->delete_marca)
                                    Disponible
                                @else
                                    Eliminado
                                @endif
                            </td>
                            <td class="text-center">{{ $marca->created_at }}</td>
                            <td class="text-center">
                                <a href="{{ route('marcas.edit', $marca->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                <!-- Icono de eliminar con formulario (puedes usar un modal para confirmar la eliminación) -->
                                <button wire:click="disable({{ $marca->id }})" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta marca?');">
                                    <i class="fa fa-trash"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="pagination pagination-sm m-0 float-right">
                {{ $marcas->links() }}
            </div>
        </div>
    </div>

    {{-- Modal para crear nueva unidad --}}
    <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                @livewire('inventario.marca-create')
            </div>
        </div>
    </div>
</div>
