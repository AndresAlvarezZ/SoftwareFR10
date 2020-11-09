@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">
        <div class="card-header">
            <h3><b><center>Procesar Solicitud</center></b></h3>
        </div>

        <div class="card-body">

            <form action="/editarCodigo/{{$producto->id}}" method="POST">
                @csrf
                @method ('put')

                <div class="row ">
                    <div class="col">
                        <label for="exampleFormControlSelect1">Codigo del producto</label>
                        <input type="text" class="form-control" name="codigo" value="{{$producto->codigo}}" /> <br>
                        @error('codigo')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="exampleFormControlSelect1">Nombre del producto</label>
                        <input type="text" class="form-control" name="nombreDelProducto" value="{{$producto->nombreDelProducto}}"/> <br>
                        @error('nombreDelProducto')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                  </div>
                <div class="row">
                    <div class="col">
                        <center><button type="submit" class="btn btn-success">Editar codigo</button></center>
                    </div>
                    <div class="col">
                        <center><a href="javascript: history.go(-1)" class="btn btn-primary">Cancelar y Volver</a></center>
                    </div>
                </div>
            </form>
            <form action="/eliminarCodigo/{{$producto->id}}" method="post">
              @csrf
              @method('delete')
              <center><button type="submit" class="btn btn-warning">Eliminar codigo</button></center>
            </form>
        </div>
    </div>
</div>
@endsection
