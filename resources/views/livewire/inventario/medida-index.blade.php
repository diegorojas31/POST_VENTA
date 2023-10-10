<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Unidades de Medida</h3>
        </div>

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="col-6">
                    <input wire:model="search" class="form-control" placeholder="Buscar">
                </div>
                <a href="{{ route('medidas.create') }}" class="btn btn-success">Añadir nuevo</a>
            </div>
            <!-- MODAL PARA EDITAR UNIDAD DE MEDIDA  -->
            {{--<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Categoria</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>One fine body…</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>

                </div>

            </div>--}}
            <!-- FIN DE MODAL PARA EDITAR UNIDAD DE MEDIDA -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 200px">Nombre</th>
                        <th style="width: 650px">Descripción</th>
                        <th style="width: 50px" class="text-center">Abreviatura</th>
                        <!-- Agregamos "text-center" a la columna Abreviatura -->
                        <th class="text-center">Acciones</th> <!-- Agregamos "text-center" a la columna Acciones -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medidas as $medida)
                        <tr>
                            <td>{{ $medida->id }}</td>
                            <td>{{ $medida->nombre }}</td>
                            <td>{{ $medida->descripcion }}</td>
                            <td class="text-center">{{ $medida->abreviatura }}</td>
                            <td class="text-center"> <!-- Agregamos "text-center" a la celda de Acciones -->
                                <a href="{{ route('medidas.edit', $medida->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                {{--<button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#modal-editar">
                                    <i class="fa fa-edit"></i> Editar
                                </button>--}}

                                <!-- Icono de eliminar con formulario (puedes usar un modal para confirmar la eliminación) -->
                                <form action="{{ route('medidas.destroy', $medida->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar esta unidad de medida?');">
                                        <i class="fa fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="pagination pagination-sm m-0 float-right">
                {{ $medidas->links() }}
            </div>
        </div>
    </div>
</div>
