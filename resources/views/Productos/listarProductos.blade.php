@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h1>Lista de tus productos <a id="ajuste" href="/home">Cerrar ventana</a></h1>
                </div>
                <div id="ingresarProveedor" class="card-body">
                  @if (session('status'))
                      <div class="alert alert-danger" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif
                  @if (session('exito'))
                      <div class="alert alert-success" role="alert">
                          {{ session('exito') }}
                      </div>
                  @endif
                  <div class="tablaProductos">
                  <table class="table">
                              <thead class="thead-dark">
                                  <tr>
                                      <th scope="col"><center>Código</center></th>
                                      <th scope="col"><center>Nombre</center></th>
                                      <th scope="col"><center>Descripción</center></th>
                                      <th scope="col"><center>Cantidad</center></th>
                                      <th scope="col"><center>Precio</center></th>
                                      <th scope="col"><center>Proveedor</center></th>
                                      <th scope="col"><center>Acción</center></th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($lista as $listando): ?>
                                    <tr>
                                        <th scope="row"><center>{{$listando->codigoDelProducto}}</center></th>
                                        <td scope="row"><center>{{$listando->nombreDelProducto}}</center></td>
                                        <td scope="row"><center>{{$listando->descripcionDelProducto}}</center></td>
                                        <td scope="row"><center>{{$listando->cantidadDelProducto}}</center></td>
                                        <td scope="row"><center>{{$listando->precioDelProducto}}</center></td>
                                        <td scope="row"><center>{{$listando->proveedorDelProducto}}</center></td>
                                        <td scope="row"><center><a  href="/editarProductos/{{$listando->id}}" class="btn btn-success">Editar Producto</a>
                                        </center></td>
                                    </tr>
                                  <?php endforeach; ?>

                              </tbody>
                          </table>
                        </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
@endsection
