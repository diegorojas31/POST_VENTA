<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <!--Agregar filtros-->
    {{-- <div class="card card-success no-print">
        <div class="card-header">
            <h3 class="card-title">Filtros</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Almacenes</label>
                        <select class="form-control" wire:model.live="almacenFilter">
                            <option value="">Todos</option>
                            @foreach ($almacenes as $almacen)
                                <option value="{{ $almacen->id }}">
                                    {{ $almacen->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Categoria</label>
                        <select class="form-control" wire:model.live="categoriaFilter">
                            <option value="">Todos</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Unidad de Medida</label>
                        <select class="form-control" wire:model.live="unidadFilter">
                            <option value="">Todos</option>
                            @foreach ($unidades as $unidad)
                                <option value="{{ $unidad->id }}">
                                    {{ $unidad->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Marca</label>
                        <select class="form-control" wire:model.live="marcaFilter">
                            <option value="">Todos</option>
                            @foreach ($marcas as $marca)
                                <option value="{{ $marca->id }}">
                                    {{ $marca->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </div> --}}

    <!-- Reporte para imprimir-->
    <div class="invoice p-3 mb-3">
        <div class="row">
            <div class="col-12">
                <h4>
                    <img src="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" alt="Logo" class="img-fluid"
                        style="max-height: 60px;">
                    {{ $datos->razon_social }}
                    <small class="float-right">Fecha: {{ date('n/j/Y') }}</small>
                </h4>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <address>
                    <b>Direccion:</b> No registrado<br>
                    <b>Telefono: </b>{{ $datos->celular_titular }}<br>
                    <b>Email:</b><br>
                    <b>Nit: </b>{{ $datos->nit_empresa }}<br>
                    <b>Propietario:</b> {{ $datos->nombre_titular }} {{ $datos->apellido_titular }}<br>
                </address>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <h3><strong>Reporte de Stock Ejecutivo</strong>
                </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 invoice-col">
                <b>Usuario:</b> {{ Auth::check() ? Auth::user()->name : 'Invitado' }}<br>
                <b>Email:</b> {{ Auth::check() ? Auth::user()->email : 'ninguno' }}<br>
                <br>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Total de Productos:</th>
                                <td>{{ $productos->count() }}</td>
                            </tr>
                            <tr>
                                <th>Total de Stock Disponible:</th>
                                <td>{{ $cantidadTotalEnStock }}</td>
                            </tr>
                            <tr>
                                <th>Productos con Stock Disponible</th>
                                <td>{{$cantidadProductosConStock}}</td>
                            </tr>
                            <tr>
                                <th>Productos sin Stock</th>
                                <td>{{$cantidadProductosSinStock}}</td>
                            </tr>
                            <tr>
                                <th>Valor Total:</th>
                                <td>{{$valorTotalProductos}} Bs</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="row no-print">
            <div class="col-12">
                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                </button>
            </div>
        </div>
    </div>
</div>
