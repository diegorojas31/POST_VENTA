<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FACTURA POST VENTA</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">
</head>
<body>
<div class="control-bar">
  <div class="container">
    <div class="row">
      <div class="col-2-4">
        <div class="slogan">Facturación </div>

        <label for="config_tax">IVA:
          <input type="checkbox" id="config_tax" />
        </label>
        <label for="config_tax_rate" class="taxrelated">Tasa:
          <input type="text" id="config_tax_rate" value="13"/>%
        </label>
        <label for="config_note">Nota:
          <input type="checkbox" id="config_note" />
        </label>
        
      </div>
      <div class="col-4 text-right">
        <a href="javascript:window.print()">Imprimir</a>
      </div><!--.col-->
    </div><!--.row-->
  </div><!--.container-->
</div><!--.control-bar-->

<header class="row">
  <div class="logoholder text-center" >
    <img src="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" style="width: 80px">
  </div><!--.logoholder-->

  <div class="me">
    <p  >
      <strong>POST VENTA</strong><br>
      postventasi2oficial@gmail.com<br>
      Santa Cruz - Bolivia<br>
      
    </p>
  </div><!--.me-->

  <div class="info">
    <p  >
    
    </p>
  </div><!-- .info -->

  <div class="bank">
    <p  >
      Nit Empresa :  {{ $datos_empresa['nit_empresa'] }}<br>
      Titular de la cuenta: {{ $datos_empresa['razon_social'] }}<br>

    </p>
  </div><!--.bank-->

</header>


<div class="row section">

	<div class="col-2 text-right details">
    <h1  >Factura</h1>
  </div><!--.col-->

  <div class="col-2 text-right details">
    <p  >
      Fecha: <input type="text" class="datePicker" value="{{ $venta['fecha_venta'] }}" /><br>
      Factura #: <input type="text" value="{{ $venta['id'] }}" /><br>
     Vence: <input class="twoweeks" type="text"/>
    </p>
  </div><!--.col-->
  
  
  
  <div class="col-4">
    

    <p   class="client">
      <strong>Facturar a</strong><br>
      <strong>NIT/CI/CEX : </strong>  <br>
      <strong>Nombre/Razon Social : </strong> <br>
      <strong>Fecha : </strong> <br>
	  <strong>Celular/Telefono : </strong>
    </p>
  </div><!--.col-->
  
  
  <div class="col-2">
   

    <p   class="client">
      <strong>Enviar a</strong><br>
      {{ $venta['nit_cliente'] }} <br>
      {{ $venta['nombre_cliente'] }} {{ $venta['apellido_cliente'] }}<br>
	  {{ $venta['fecha_venta'] }}<br>
	  {{ $venta['celular_cliente'] }}
    </p>
  </div><!--.col-->

  

</div><!--.row-->

<div class="row section" style="margin-top:-1rem">


</div><!--.row-->

<div class="invoicelist-body">
  <table>
    <thead  >
      <th width="5%">Código</th>
      <th width="60%">Descripción</th>
      
      <th width="10%">Cant.</th>
      <th width="15%">Precio</th>
      <th class="taxrelated">IVA</th>
      <th width="10%">Total</th>
    </thead>
    <tbody>
      @foreach($detalle_venta as $detalle)
      <tr>
        <td width='5%'> <span  >{{ $detalle['barcode'] }}</span></td>
        <td width='60%'><span  >{{ $detalle['nombre'] }} - {{ $detalle['descripcion'] }}</span></td>
        <td class="amount"><input type="text" value="{{ $detalle['cantidad'] }}"/></td>
        <td class="rate"><input type="text" value="{{ $detalle['subtotal'] }}" /></td>
        <td class="tax taxrelated"></td>
        <td class="sum"></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  
</div><!--.invoice-body-->

<div class="invoicelist-footer">
  <table  >
    <tr class="taxrelated">
      <td>IVA:</td>
      <td id="total_tax"></td>
    </tr>
    <tr>
      <td><strong>Total:</strong></td>
      <td id="total_price"></td>
    </tr>
  </table>
</div>

<div class="note"  >
  <h2>Nota:</h2>
</div><!--.note-->

<footer class="row">
  <div class="col-1 text-center">
    <p class="notaxrelated"  >ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS. EL USO ILÍCITO DE ÉSTA SERÁ SANCIONADO DE ACUERDO A LEY.</p>
    
  </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"><\/script>')</script>
<script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>