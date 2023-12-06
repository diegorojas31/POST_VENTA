<div>
    {{-- Do your work, then step back. --}}
    <section class="content-header mb-5 no-print">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reportes Ejecutivo de Inventario</h1>
                </div>
            </div>

            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;"
                onclick="imprimirOGuardarPDF()">
                <i class="fas fa-download"></i> Imprimir PDF
            </button>
        </div>
    </section>

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
                <h3><strong>Reporte Ejecutivo de Inventario</strong>
                </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 invoice-col">
                <b>Solicita:</b> {{ Auth::check() ? Auth::user()->name : 'Invitado' }}<br>
                <b>Fecha:</b> {{ \Illuminate\Support\Carbon::now()->format('d/m/Y') }}<br>
                <br>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12">
                <p class="lead">Resumen genral de inventario</p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Total de Productos:</th>
                                <td style="text-align: right;">{{$totalProductos}}</td>
                            </tr>
                            <tr>
                                <th>Total de Productos en Stock:</th>
                                <td style="text-align: right;">{{$totalStock}}</td>
                            </tr>
                            <tr>
                                <th>Valor total del Inventario</th>
                                <td style="text-align: right;">Bs {{$valorTotal}}</td>
                            </tr>

                            <tr>
                                <th>Productos con Stock Bajo</th>
                                <td style="text-align: right;">{{$productosBajos}}</td>
                            </tr>

                            <tr>
                                <th>Productos sin Stock</th>
                                <td style="text-align: right;">{{$productosSinStock}}</td>
                            </tr>
                            <tr>
                                <th>Productos con Stock</th>
                                <td style="text-align: right;">{{$productosConStok}}</td>
                            </tr>
                            <tr>
                                <th>Productos con Stock al 100%</th>
                                <td style="text-align: right;">{{$productosFull}}</td>
                            </tr>
                            <tr>
                                <th>Categoria con mas Productos</th>
                                <td style="text-align: right;">500</td>
                            </tr>
                            <tr>
                                <th>Almacen con mas Productos</th>
                                <td style="text-align: right;">500</td>
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
