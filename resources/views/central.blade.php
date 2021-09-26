@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="{{ asset('js/calculos.js') }}"defer></script>
    <script src="{{ asset('js/anularEnter.js') }}?v=<?php echo(rand()); ?>"defer></script>
    <link href="{{ asset('css/estilos.css') }}?v=<?php echo(rand()); ?>"defer rel="stylesheet">
  </head>
  <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h1>Software de Facturación furiTEN <a id="ajuste" href="/ajuste">Ajustar pantalla</a>
                      @if (auth()->user()->id ==1)
                          <a id="ajuste" href="/agregarClave">Agregar clave</a>
                          <a id="ajuste" href="/listarClaves">Listar claves</a>
                      @endif
                      </h1> </div>

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
                        <div class="ulDesplegables">
                          <ul class="desplegable">
                            <li class="liDesplegable"><a class="desplegable1"  href="/agregarProveedor">Agregar Proveedor</a></li>
                            <li class="liDesplegable"><a class="desplegable1"  href="/ingresarProducto">Agregar Productos</a></li>
                            <li class="liDesplegable"><a class="desplegable1"  href="/listarFacturas">Ver Facturas</a></li>
                            <li class="liDesplegable"><a class="desplegable1"  href="/listarProductos">Ver Productos</a></li>
                            <li class="liDesplegable"><a class="desplegable1"  href="/listarCodigos">Listar Codigos</a></li>
                            <li class="liDesplegable"><a class="desplegable1"  href="/listarProveedores">Listar Proveedores</a></li>
                            <li class="liDesplegable"><a class="desplegable1"  href="/abrirCaja">Abrir Caja</a></li>
                            <li class="liDesplegable"><a class="desplegable1"  href="/cerrarCaja">Cerrar Caja</a></li>
                          </ul>
                        </div>
                                  <div class="desplegableDerecho">
                                    <form class="" action="/agregarCompra" method="post">
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
                                                          <td scope="row"><center><a href="/editarProducto/{{$compra->id}}" class="btn btn-primary">Editar Producto</a>
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
                                              <form  class="" action="/generarFactura" method="get">
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
                        </div>
                        <div class="card-footer">
                          © 2019-<?php echo date("Y"); ?> - Software de facturacion FR10. |
                          <a target="_blank" href="https://api.whatsapp.com/send?phone=50660866447">WhatsApp<img height=25px; src='/images/whatsapp.png' border="0"/></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
@endsection
