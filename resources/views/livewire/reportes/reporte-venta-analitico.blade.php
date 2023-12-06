<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <section class="content-header mb-5 no-print">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reportes Analitico de Ventas</h1>
                </div>
            </div>

            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;"
                onclick="imprimirOGuardarPDF()">
                <i class="fas fa-download"></i> Imprimir PDF
            </button>
        </div>
    </section>

    <div class="row no-print">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Rango de Fechas</h3>
                </div>
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="from_date">Desde:</label>
                            <input type="date" wire:model.live="from_date" id="from_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="to_date">Hasta:</label>
                            <input type="date" wire:model.live="to_date" id="to_date" class="form-control">
                        </div>
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
                <h3><strong>Reporte Analitico de Ventas</strong>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Todas las Ventas</h3>
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
                                                <th>
                                                    Nro Venta</th>

                                                <th>
                                                    Fecha de Venta</th>
                                                <th>
                                                    Vendedor</th>
                                                <th>
                                                    Cliente</th>
                                                <th>
                                                    Monto Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allVentas as $venta)
                                                <tr class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $venta->nro }}</td>
                                                    <td>{{ $venta->FechaVenta }}</td>
                                                    <td>{{ $venta->Vendedor }}</td>
                                                    <td>{{ $venta->Cliente }}</td>
                                                    <td>{{ $venta->MontoTotal }}</td>
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

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">10 Productos Mas Vendidos</h3>
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
                                                <th>
                                                    Producto</th>

                                                <th>
                                                    Cantidad</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($productosMasVendidos as $pr)
                                                <tr class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">
                                                        {{ $pr->ProductoNombre }}</td>
                                                    <td>{{ $pr->cantidadtotal }}</td>
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
