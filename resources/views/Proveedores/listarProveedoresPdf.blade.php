
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
                  <h1>Lista de Proveedores</h1>
                </div>
                <div id="ingresarProveedor" class="card-body">
                  <div class="tablaPricipal">
                  <table class="table" border="1">
                              <thead class="thead-dark">
                                  <tr>
                                      <th scope="col"><center>Nombre</center></th>
                                      <th scope="col"><center>Cédula</center></th>
                                      <th scope="col"><center>Telefono</center></th>
                                      <th scope="col"><center>Domicilio</center></th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($lista as $listando): ?>
                                    <tr>
                                        <th scope="row"><center>{{$listando->nombreDelProveedor}}</center></th>
                                        <td scope="row"><center>{{$listando->dniDelProveedor}}</center></td>
                                        <td scope="row"><center>{{$listando->telefonoDelProveedor}}</center></td>
                                        <td scope="row"><center>{{$listando->domicilioDelProveedor}}</center></td>

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
