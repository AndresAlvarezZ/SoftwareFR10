@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="{{ asset('js/calculos.js') }}?v=<?php echo(rand()); ?>"defer></script>
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
  </head>
  <body>
    <div id="carrito">
      <div id="div1" ><img src="/images/descarga.jfif" height=45px alt=""></div>
    </div>
    <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card">
              <div id="slow" class="card-header">
                <h1>Agregando Productos <a id="ajuste" href="/home">Cerrar ventana</a></h1>
              </div>
              <div id="ingresarProveedor" class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-warning" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="/ingresarProducto" method="post">
                  @csrf
                  <div class="form-group row">
                      <label for="nombreDelProducto" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                      <div class="col-md-6">
                          <input id="nombreDelProducto" readonly type="text" class="form-control @error('nombreDelProducto') is-invalid @enderror" name="nombreDelProducto" value="{{ old('nombreDelProducto') }}" required autocomplete="nombreDelProducto" autofocus>

                          @error('nombreDelProducto')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ 'debes escoger un codigo' }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="codigoDelProducto" class="col-md-4 col-form-label text-md-right">{{ __('Código') }}</label>

                      <div class="col-md-6">
                        <select id="codigoDelProducto" onchange="agregarNombre(this.value)" class="form-control" name="codigoDelProducto">
                          <option value=""></option>
                          @foreach ($codigos as $codigo)
                            <option value="{{$codigo->nombreDelProducto}}">{{$codigo->codigo}} - {{$codigo->nombreDelProducto}}</option>
                           @endforeach
                        </select>
                          @error('codigoDelProducto')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="descripcionDelProducto" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                      <div class="col-md-6">
                        <textarea id="descripcionDelProducto" rows="3" cols="40" name="descripcionDelProducto" class="form-control" required></textarea>
                          @error('descripcionDelProducto')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="cantidadDelProducto" class="col-md-4 col-form-label text-md-right">{{ __('Cantidad') }}</label>

                      <div class="col-md-6">
                          <input id="cantidadDelProducto" type="number" class="form-control @error('cantidadDelProducto') is-invalid @enderror" name="cantidadDelProducto" value="{{ old('cantidadDelProducto') }}" required autocomplete="cantidadDelProducto" autofocus>

                          @error('cantidadDelProducto')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="precioDelProducto" class="col-md-4 col-form-label text-md-right">{{ __('Precio') }}</label>

                      <div class="col-md-6">
                          <input id="precioDelProducto" type="number" class="form-control @error('precioDelProducto') is-invalid @enderror" name="precioDelProducto" value="{{ old('precioDelProducto') }}" required autocomplete="precioDelProducto" autofocus>

                          @error('precioDelProducto')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="proveedorDelProducto" class="col-md-4 col-form-label text-md-right">{{ __('Proveedor') }}</label>

                      <div class="col-md-6">
                        <select id="proveedorDelProducto" class="form-control" name="proveedorDelProducto">
                          <option value="Pendiente">Pendiente</option>
                          @foreach ($proveedores as $proveedor)
                            <option value="{{$proveedor->nombreDelProveedor}}">{{$proveedor->nombreDelProveedor}}</option>
                           @endforeach
                        </select>
                          @error('proveedorDelProducto')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  <div  class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                          <button  type="submit" class="btn btn-primary">
                              {{ __('Agregar') }}
                          </button>
                      </div>
                  </div>
                  <br>
                  <p id="alerta" >**Antes de agregar un producto debes agregar el codigo</p>
                </form>
                <br>
                <br>
              </div>
            </div>
          </div>
      </div>
    </div>
  </body>
</html>

@endsection
