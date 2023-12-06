<div>
    {{-- Do your work, then step back. --}}
    <section class="content-header mb-5 no-print">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reportes Personalizado de Inventario</h1>
                </div>
            </div>

            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;"
                onclick="imprimirOGuardarPDF()">
                <i class="fas fa-download"></i> Imprimir PDF
            </button>
        </div>
    </section>

    <div class="row no-print">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos de Salida</h3>
                </div>
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Titulo del Reporte:</label>
                            <input type="text" wire:model.live="titulo" class="form-control">
                        </div>


                        <div class="form-group">
                            <label>Selecciona las columnas a mostrar:</label>
                            <select wire:model.live="columnasSeleccionadas" class="form-control" multiple>
                                @foreach ($columasDefinidas as $columna)
                                    <option value="{{ $columna }}">{{ $columna }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha de Solicitud</label>
                            <input type="date" wire:model.live="fecha" class="form-control">
                        </div>
                        {{-- <div class="form-group">
                            <label for="to_date">Hasta:</label>
                            <input type="date" wire:model.live="to_date" id="to_date" class="form-control">
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Criterios de Busqueda</h3>
                </div>
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Producto:</label>
                            <input type="text" wire:model.live="nombre" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Categoria</label>
                            <select wire:model.live="categoria" class="form-control">
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->nombre }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Marca</label>
                            <select wire:model.live="marca" class="form-control">
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->nombre }}">{{ $marca->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label>Medida</label>
                            <select wire:model.live="columnasSeleccionadas" class="form-control">
                                @foreach ($columasDefinidas as $columna)
                                    <option value="{{ $columna }}">{{ $columna }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="invoice p-3 mb-3">
        <div class="row">
            <div class="col-12">
                <h4>
                    <img src="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" alt="Logo"
                        class="img-fluid" style="max-height: 60px;"> {{ $datos->razon_social }}
                    {{-- <small class="float-right">Date: 2/10/2014</small> --}}
                </h4>
            </div>
        </div>

        <div class="row invoice-info ml-2">
            <div class="col-sm-4 invoice-col">
                <address style="font-size: small;">
                    <b>Teléfono: {{ $datos->celular_titular }}</b> <br>
                    <b>NIT: {{ $datos->nit_empresa }}</b> <br>
                    <b>Propietario: {{ $datos->nombre_titular }} {{ $datos->apellido_titular }}</b> <br>
                </address>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <h3><strong>{{ $titulo }}</strong>
                </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 invoice-col">
                <b>Solicita:</b> {{ Auth::check() ? Auth::user()->name : 'Invitado' }}<br>
                <b>Fecha:</b> {{ $fecha }}<br>
                <br>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Productos</h3>
                    </div>
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1"
                                        class="table table-bordered table-striped dataTable dtr-inline"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr>
                                                @foreach ($columnasSeleccionadas as $columna)
                                                    <th>{{ $columna }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tablaProductos as $producto)
                                                <tr>
                                                    @foreach ($columnasSeleccionadas as $columna)
                                                        <td>{{ $producto->{$columna} ?? 'Ninguno' }}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <p class="mt-5"><strong>Firma</strong></p>
        </div>
    </div>



    <script>
        function imprimirOGuardarPDF() {
            console.log("print");
            // Verifica si la API html2pdf está disponible (puede ser necesario incluir la librería)
            if (typeof html2pdf !== 'undefined') {
                // Utiliza html2pdf para generar un archivo PDF
                html2pdf(document.body);
            } else {
                // Si html2pdf no está disponible, utiliza la función de impresión predeterminada
                window.print();
            }
        }
    </script>


</div>
