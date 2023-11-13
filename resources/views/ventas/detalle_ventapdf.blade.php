<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>NOTA DE VENTA</title>
    <link rel="stylesheet" href="{{ public_path('PDF/css/reset.css') }}">
    <link rel="stylesheet" href="{{ public_path('PDF/css/bootstrap_prince.css') }}">
    <script src="{{ public_path('PDF/js/bootstrap_prince.js') }}"></script>
    <style>
      @import url(http://fonts.googleapis.com/css?family=Bree+Serif);
      body, h1, h2, h3, h4, h5, h6{
      font-family: 'Bree Serif', serif;
      }
      span, h4, .letra {
          font-family: "Times New Roman";
          font-size: 10px;
      }
      .titulo {
          font-family: "Arial Narrow", Arial, sans-serif;
          font-size: 12px;
          white-space: pre;
      }
      .titulopie {
          font-family: Tahoma, Verdana, Segoe, sans-serif;
          font-size: 12px;
          white-space: pre;
      }
      .row > .sinespacio {
          display: inline-block;
          margin: 0;
          float: left;
          white-space: nowrap;
      }
      .row > .limpiar {
          clear: both;
      }
      table {
          border: 0px;
          border-spacing: 0px;
          border-collapse: collapse;
      }
      td, th {
          padding: 0px;
          border: 0px;
          margin: 0px;
      }
      .izq {
          text-align: right;
      }
      .borde {
          border-style: solid;
          border-width: 1px;
          border-color: black;
          padding-bottom: 3px;
      }

      @page { size:8.5in 11in; margin: 1cm }
    </style>
  </head>
  
  <body>
    <div class="container">
      <div class="row">
          <div class="col-xs-4"><img style="width: 80px" src="{{ public_path('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}"></div>
          <div class="col-xs-4"><h1>Detalle Venta</h1></div>
          
      </div>
        <hr>
        <div class="row">
            <div class="col-xs-2">
                <div class="titulo">Nro. Factura:       </div>
            </div>
            <div class="col-xs-2">
                <div id="numerofactura">{{ $ventas->id }}</div>
            </div>
            <div class="col-xs-2">
                <div class="titulo">Fecha Emision:  </div>
            </div>
            <div class="col-xs-2">
                <div id="fechaemision">{{ $ventas->fecha_venta }}</div>
            </div>
           
        </div>   
        <div class="row">
           
            <div class="col-xs-2">
                <div class="titulo">NIT Cliente:   </div>
            </div>
            <div class="col-xs-2">
                <div id="rucCliente">{{ $ventas->nit_cliente }}</div>
            </div>
            <div class="col-xs-2">
                <div class="titulo">Nombres/Razon:  </div>
            </div>
            <div class="col-xs-2">
                <div id="razon"> {{ $ventas->nombre_cliente }} {{ $ventas->apellido_cliente }}</div>
            </div>
        </div>  
       
        <div class="row">
            <div class="col-xs-2">
                <div class="titulo">Telefono:      </div>
            </div>
            <div class="col-xs-2">
                <div id="telefono">{{ $ventas->celular_cliente }}</div>
            </div>            
            <div class="col-xs-2">
                <div class="titulo">Direccion:     </div>
            </div>
            <div class="col-xs-2">
                <div id="direccion"></div>
            </div>
        </div>          
   
        <br>
        <br>
        <table class="table table-bordered">
        <thead>
          <tr>
              <th><h4 class="titulo">&nbsp;&nbsp;&nbsp;Codigo&nbsp;&nbsp;&nbsp;</h4></th>
        <th><h4 class="titulo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descripcion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4></th>
        <th><h4 class="titulo">&nbsp;&nbsp;&nbsp;Cant.&nbsp;&nbsp;&nbsp;</h4></th>
        <th><h4 class="titulo">&nbsp;&nbsp;&nbsp;&nbsp;P.Unit.&nbsp;&nbsp;&nbsp;&nbsp;</h4></th>
        <th><h4 class="titulo">&nbsp;&nbsp;&nbsp;&nbsp;Dscto.&nbsp;&nbsp;&nbsp;&nbsp;</h4></th>
        <th><h4 class="titulo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Subtotal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4></th>
          </tr>
        </thead>
        <tbody>
            @foreach($detalle_venta as $producto)
            <tr>
                <td class="codigo">{{ $producto->barcode }}</td>
                <td class="descripcion">{{ $producto->nombre }}</td>
                <td class="cantidad izq">{{ $producto->cantidad}}</td>
                <td class="precio izq">{{ $producto->precio }}</td>
                <td class="descuento izq">{{ 0 }}</td>
                <td class="subtotal izq">{{ $producto->subtotal }}</td>
            </tr>
        @endforeach
        
        </tbody>
      </table>
        <div class="row sinespacio">

            <div class="col-xs-3">
                <div>Total :   </div>
            </div>
            <div class="col-xs-3">
                <div class="izq borde" id="totalSinImpto">{{ $ventas->montototal }}  Bs.</div>
            </div>          
        </div>
   



    </div>
  </body>
</html>
