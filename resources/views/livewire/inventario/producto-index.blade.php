<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Productos</h3>
        </div>

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="col-6">
                    <input wire:model="search" class="form-control" placeholder="Buscar">
                </div>
                <a href="{{ route('productos.create') }}" class="btn btn-success">Añadir nuevo</a>
            </div>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th class="text-center">Codigo</th>
                        <th>Nombre</th>
                        <th class="text-center">Imagen</th>
                        <th>Descripción</th>
                        <th>Marca</th>
                        <th>Ubicación</th>
                        <th class="text-center">Precio</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        @php
                            $stock = $stocks->where('producto_id', $producto->id)->first();
                        @endphp
                        <tr>
                            <td class="text-center">{{ $producto->barcode }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td class="text-center"><img src="{{ asset($producto->image) }}" alt=""
                                    width="20"></td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>{{ optional($producto->marca)->nombre ?? 'Ninguno' }}</td>
                            <td>{{ optional($stock->almacen)->nombre ?? 'Ninguno' }}</td>
                            <td class="text-center">{{ $producto->precio }}</td>
                            <td class="text-center">{{ $stock ? $stock['cantidad'] : 'N/A' }}</td>
                            <td class="text-center">
                                <div class="btn-group-sm">
                                    <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-info"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary"><i
                                            class="fa fa-edit"></i></a>
                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem;"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="pagination pagination-sm m-0 float-right">
                {{ $productos->links() }}
            </div>
        </div>
    </div>
</div>
