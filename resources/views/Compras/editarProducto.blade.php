@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">
        <div class="card-header">
            <h3><b><center>Procesar Solicitud <a id="ajuste" href="/listarProductos">Cerrar ventana</a></center></b></h3>
        </div>

        <div class="card-body">

            <form action="/editarProducto/{{$producto->id}}" method="POST">
                @csrf
                @method ('put')

                <div class="row ">
                    <div class="col">
                        <label for="exampleFormControlSelect1">Codigo del producto</label>
                        <input type="text" class="form-control" readonly name="codigoDelProducto" value="{{$producto->codigoDelProducto}}" /> <br>
                        @error('codigoDelProducto')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="exampleFormControlSelect1">Nombre del producto</label>
                        <input type="text" class="form-control" readonly name="nombreDelProducto" value="{{$producto->nombreDelProducto}}"/> <br>
                        @error('nombreDelProducto')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                        <label for="exampleFormControlSelect1">Cantidad del producto</label>
                        <input type="number" class="form-control" name="cantidadDelProducto" value="{{$producto->cantidadDelProducto}}"/> <br>
                        @error('cantidadDelProducto')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="exampleFormControlSelect1">Precio del producto</label>
                        <input type="number" class="form-control"  name="domicilioDelCiente" value="{{$producto->precioDelProducto}}"/> <br>
                        @error('precioDelProducto')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                  </div>

                <div class="row">
                    <div class="col">
                        <center><button type="submit" class="btn btn-success">Editar producto</button></center>
                    </div>
                    <div class="col">
                        <center><a href="javascript: history.go(-1)" class="btn btn-primary">Cancelar y Volver</a></center>
                    </div>
                </div>
            </form>
            <form action="/eliminarProducto/{{$producto->id}}" method="post">
              @csrf
              @method('delete')
              <center><button type="submit" class="btn btn-warning">Eliminar producto</button></center>
            </form>
            <p>**el producto solamente se elimina de la compra**</p>
        </div>
    </div>
</div>
@endsection
