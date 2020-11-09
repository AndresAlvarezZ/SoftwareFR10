@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="{{ asset('css/estilos.css') }}"defer rel="stylesheet">
    <title></title>
  </head>
  <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <h1>Lista de codigos <a id="ajuste" href="/home">Cerrar ventana</a> </h1>
                </div>
                <div id="ingresarProveedor" class="card-body">
                  <table class="table">
                              <thead class="thead-dark">
                                  <tr>
                                      <th scope="col"><center>Codigo</center></th>
                                      <th scope="col"><center>Nombre</center></th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($lista as $listando): ?>
                                    <tr>
                                        <th scope="row"><center>{{$listando->codigo}}</center></th>
                                        <td scope="row"><center>{{$listando->nombreDelProducto}}</center></td>
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
  </body>
</html>
@endsection
