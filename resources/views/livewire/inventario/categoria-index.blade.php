<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            <strong>{{ session('error') }}</strong>
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Categorias</h3>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="col-6">
                    <input wire:model.live="search" class="form-control" type="text" placeholder="Buscar categorias..">
                </div>
                {{-- <a href="{{ route('categorias.create') }}" class="btn btn-success">Añadir nuevo</a> --}}
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-lg">
                    Añadir nuevo
                </button>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        {{-- <th style="width: 10px">#</th> --}}
                        <th style="width: 200px">Nombre</th>
                        <th style="width: 650px">Descripción</th>
                        <th class="text-center">Imagen</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->nombre }}</td>
                            <td>{{ $categoria->descripcion }}</td>
                            <td class="text-center"><img src="{{ asset($categoria->image) }}" alt=""
                                    width="20"></td>
                            <td class="text-center">
                                <!-- Icono de editar con enlace -->
                                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                <!-- Icono de eliminar con formulario (puedes usar un modal para confirmar la eliminación) -->
                                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?');">
                                        <i class="fa fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <div class="pagination pagination-sm m-0 float-right">
                {{ $categorias->links() }}
            </div>
        </div>
    </div>
    {{-- Modal para crear nueva categoria --}}
    <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                @livewire('inventario.categoria-create')
            </div>
        </div>
    </div>
</div>
