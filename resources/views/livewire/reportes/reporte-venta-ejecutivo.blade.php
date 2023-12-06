<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <section class="content-header mb-5 no-print">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reportes Ejecutivo de Ventas</h1>
                </div>
            </div>

            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;"
                onclick="imprimirOGuardarPDF()">
                <i class="fas fa-download"></i> Imprimir PDF
            </button>
        </div>
    </section>

    <div class="row no-print">
        <div class="col-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Rango de Fechas</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="from_date">Desde:</label>
                        <input type="date" wire:model.live="from_date" id="from_date" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="from_date">Hasta:</label>
                        <input type="date" wire:model.live="to_date" id="to_date" class="form-control">
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
                <h3><strong>Reporte Ejecutivo de Ventas</strong>
                </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 invoice-col">
                <b>Solicita:</b> {{ Auth::check() ? Auth::user()->name : 'Invitado' }}<br>
                <b>Desde:</b> {{ $from_date }}<br>
                <b>Hasta:</b> {{ $to_date }}<br>
                <br>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12">
                <p class="lead">Resumen genral de Ventas</p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Total de Ventas:</th>
                                <td style="text-align: right;">{{ $cantidadVentas }}</td>
                            </tr>
                            <tr>
                                <th>Total Importe:</th>
                                <td style="text-align: right;">{{ $sumaMontosVentas }}</td>
                            </tr>
                            <tr>
                                <th>Total Productos Vendidos:</th>
                                <td style="text-align: right;">{{ $cantidadProductosDiferentes }}</td>
                            </tr>
                            <tr>
                                <th>Total de Stock:</th>
                                <td style="text-align: right;">{{ $sumaCantidadDetalles }}</td>
                            </tr>
                            <tr>
                                <th>Producto mas vendido:</th>
                                <td style="text-align: right;">{{ optional($productoMasVendido)->nombre ?? 'Ninguno' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Cliente mas Frecuente:</th>
                                <td style="text-align: right;">{{ optional($cliente)->nombre_cliente ?? 'Ninguno' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Clientes nuevos:</th>
                                <td style="text-align: right;">{{$cantidadClientesNuevos}}</td>
                            </tr>
                        </tbody>
                    </table>
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
