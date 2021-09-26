@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="{{ asset('js/calculos.js') }}"defer></script>
    <script src="{{ asset('js/anularEnter.js') }}"defer></script>
    <link href="{{ asset('css/estilos.css') }}="defer rel="stylesheet">
  </head>
  <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                  <div class="">
                    <a id="ajuste" href="/home">Pantalla normal</a>
                  </div>
                  <div class="card-body">
                    @if (session('alerta')=='si')
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if (session('exito'))
                        <div class="alert alert-success" role="alert">
                            {{ session('exito') }}
                            <div class="cierre">
                              <button class="btn-danger" type="button" onclick="cerrar()" name="">X</button>
                            </div>

                        </div>
                    @endif
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                        <div class="cierre">
                          <button class="btn-danger" type="button" onclick="cerrar()" name="">X</button>
                        </div>

                    </div>
                    @endif
                        <form class="tablaBaja" action="/agregarCompraPantallaAjustada" method="post">
                          @csrf
                          <table>
                            <tr>
                              <td><input class="codigoDeCompra" placeholder="Codigo" type="text" required name="codigo" value=""></td>
                              <td><input class="codigoDeCompra" placeholder="Cantidad" type="number" required name="cantidad" value=""></td>
                              <td><button  class="btn btn-success " type="submit" name="button">Agregar a la compra</button></td>
                            </tr>
                          </table>


                          <input id="fecha" type="datetime" readonly hidden name="fecha" value="<?php echo date("Y-m-d H:i");?>">


                        </form>
                        <div class="tablaPricipal">
                          <table class="table">
                                      <thead class="thead-dark">
                                          <tr>
                                              <th scope="col"><center>Codigo</center></th>
                                              <th scope="col"><center>Nombre</center></th>
                                              <th scope="col"><center>Cantidad</center></th>
                                              <th scope="col"><center>P. unitario<center></th>
                                              <th scope="col"><center>Sub-total<center></th>
                                              <th scope="col"><center>Acción<center></th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php foreach ($compras as $compra): ?>
                                          <tr>
                                              <th scope="row"><center>{{$compra->codigoDelProducto}}</center></th>
                                              <td scope="row"><center>{{$compra->nombreDelProducto}}</center></td>
                                              <td scope="row"><center>{{$compra->cantidadDelProducto}}</center></td>
                                              <td scope="row"><center>{{$compra->precioDelProducto}}</center></td>
                                              <?php $subtotal = $compra->cantidadDelProducto*$compra->precioDelProducto ?>
                                              <td scope="row"><center>{{$subtotal}}</center></td>
                                              <td scope="row"><center><a href="/editarProductoPantallaAjustada/{{$compra->id}}" class="btn btn-primary">Editar Producto</a>
                                              </center></td>
                                          </tr>
                                          <?php $total = $total + $subtotal ?>
                                        <?php endforeach; ?>
                                      </tbody>
                                      <tfoot>
                                      </tfoot>
                                  </table>
                        </div>
                        <br>
                                  <form  class="tablaBaja" action="/generarFacturaPantallaAjustada" method="get">
                                    <input  id="nombreDelClienteFactura" placeholder="Nombre del cliente" type="text"  name="nombreDelClienteFactura" value="">
                                    <br>
                                    <br>
                                    <table>
                                      <tr class="trFactura">
                                        <td class="tdFactura"><strong>TOTAL</strong></td>
                                        <td class="tdFactura"><strong>CAMBIO</strong></td>
                                        <td class="tdFactura"><strong>VUELTO</strong></td>
                                      </tr>
                                      <tr class="trFactura">
                                        <td class="tdFactura"><input  class="codigoDeCompra" id="total" readonly type="number" name="" value="{{$total}}"></td>
                                        <td class="tdFactura"><input  class="codigoDeCompra" id="cambio" type="number" name="" required onkeypress="calcularVuelto()" value=""></td>
                                        <td class="tdFactura"><input  class="codigoDeCompra" id="vuelto" readonly type="number" name="" value=""></td>
                                        <input hidden id="fechaFactura" type="datetime" name="fechaFactura" value="">
                                        <input hidden id="cambioFactura" type="number" name="cambioFactura" value="">
                                        <input hidden id="totalFactura" type="number" name="totalFactura" value="">
                                        <input hidden id="vueltoFactura" type="number" name="vueltoFactura" value="">

                                        <td class="tdFactura"><button  type="submit" class="btn btn-success" name="button">Generar factura</button></td>
                                      </tr>
                                    </table>
                                  </form>
                                  <br>
                                  <p style="color:red;">**si el monto de cambio es menor al total no se generará la factura**</p>
                        </div>
                        <div class="card-footer">
                          © 2019-<?php echo date("Y"); ?> - Software de facturacion FR10.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
@endsection
