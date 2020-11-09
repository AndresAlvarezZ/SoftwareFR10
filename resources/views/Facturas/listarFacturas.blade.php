@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="es-ES">

<head>
    <title>Carrito de compras</title>
    <link href="{{ asset('css/estilos.css') }}?v=<?php echo(rand()); ?>" rel="stylesheet">

<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h1 class=>Estas son tus facturas <a id="ajuste" href="/home">Cerrar ventana</a></h1>
        </div>
        <div class="card-body">
          <div class="mostarFacturas">
            <table class="tablaDeFacturas">
              <?php $indiceFactura = 1; ?>
              <?php foreach ($misFacturas as $factura): ?>
                @php
                $fecha = date('d-m-Y', strtotime($factura->fecha))
                @endphp
                <tr>
                  <td id="factura"><strong>Factura #{{$indiceFactura}}</strong></td>
                  <td id="factura"></td>
                </tr>
                <tr>
                  <td id="sinRaya"><strong>Numero de factura</strong></td>
                  <td id="sinRaya">{{$factura->id}}</td>
                </tr>
                <tr>
                  <td id="sinRaya"><strong>Fecha</td></strong>
                  <td id="sinRaya">{{$fecha}}</td>
                </tr>
                <tr>
                  <td id="sinRaya"><strong>Nombre del cliente</td></strong>
                  <td id="sinRaya">{{$factura->nombreDelCliente}}</td>
                </tr>
                <tr>
                  <td id="articulos"><strong>Artículos</strong></td>
                  <td id="articulos"><strong>Cantidad</strong></td>
                  <td id="articulos"><strong>Precio</strong></td>
                </tr>
                <?php
                $indice =1;
                ?>
                <?php foreach ($compras as $articulos): ?>
                  <?php if ($articulos->fecha == $factura->fecha): ?>
                    <tr>
                      <td id="articulos">{{$indice}}-{{$articulos->nombreDelProducto}}</td>
                      <td id="articulos">{{$articulos->cantidadDelProducto}}</td>
                      <td id="articulos">{{$articulos->precioDelProducto}}</td>
                    </tr>
                    <?php $indice++; ?>
                  <?php endif; ?>
                <?php endforeach; ?>
                <tr>
                  <td id="sinRaya"><strong>Total</strong></td>
                  <td id="sinRaya">{{$factura->total}}</td>
                </tr>
                <tr>
                  <td id="sinRaya"><strong>Cambio</strong></td>
                  <td id="sinRaya">{{$factura->cambio}}</td>
                </tr>
                <tr>
                  <td id="ultimo"><strong>Vuelto</strong></td>
                  <td id="ultimo">{{$factura->vuelto}}</td>
                  <td id="ultimo"></td>
                </tr>
                <?php $indiceFactura++; ?>
              <?php endforeach; ?>
            </table>
          </div>
        <div class="btnFacturas" class="card-foot">
          <div class="">
            <a href="/home" type="button" class="btn btn-primary">Entendido</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
@endsection
