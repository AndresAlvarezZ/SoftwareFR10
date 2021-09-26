@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="{{ asset('js/calculos.js') }}"defer></script>
    <link href="{{ asset('css/estilos.css') }}"defer rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card">
              <div id="slow" class="card-header">
                <h1>Editando Producto <a id="ajuste" href="/listarProductos">Cerrar ventana</a></h1>
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
                <form action="/editarProductos/{{$producto->id}}" method="post">
                  @csrf
                  @method('put')
                  <div class="form-group row">
                      <label for="nombreDelProducto" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                      <div class="col-md-6">
                          <input id="nombreDelProducto" type="text" class="form-control @error('nombreDelProducto') is-invalid @enderror" name="nombreDelProducto" value="{{$producto->nombreDelProducto}}" required autocomplete="nombreDelProducto" autofocus>

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
                        <input id="codigoDelProducto"  type="text" class="form-control @error('codigoDelProducto') is-invalid @enderror" name="codigoDelProducto" value="{{$producto->codigoDelProducto}}" required autocomplete="nombreDelProducto" autofocus>
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
                        <textarea id="descripcionDelProducto" rows="3" cols="40" name="descripcionDelProducto" class="form-control" required>{{$producto->descripcionDelProducto}}</textarea>
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
                          <input id="cantidadDelProducto" type="number" class="form-control @error('cantidadDelProducto') is-invalid @enderror" name="cantidadDelProducto" value="{{$producto->cantidadDelProducto}}" required autocomplete="cantidadDelProducto" autofocus>

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
                          <input id="precioDelProducto" type="number" class="form-control @error('precioDelProducto') is-invalid @enderror" name="precioDelProducto" value="{{$producto->precioDelProducto}}" required autocomplete="precioDelProducto" autofocus>

                          @error('precioDelProducto')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="alerta" class="col-md-4 col-form-label text-md-right">{{ __('Alerta') }}</label>

                      <div class="col-md-6">
                          <input id="alerta" type="number" class="form-control @error('alerta') is-invalid @enderror" name="alerta" value="{{$producto->alerta}}" required autocomplete="alerta" autofocus>

                          @error('alerta')
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
                          <option value="{{$producto->proveedorDelProducto}}">{{$producto->proveedorDelProducto}}</option>
                          @foreach ($proveedores as $proveedor)
                          <?php if ($proveedor->nombreDelProveedor ==$producto->proveedorDelProducto): ?>
                          <?php $ocultador = 'oculto'; ?>
                          <?php endif; ?>
                            <option id="{{$ocultador}}" value="{{$proveedor->nombreDelProveedor}}">{{$proveedor->nombreDelProveedor}}</option>
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
                          <button class="btn" type="submit" class="btn btn-primary">
                              {{ __('Editar Producto') }}
                          </button>
                      </div>
                  </div>
                </form>
                <form class="descartarCambios" action="/editarProductos/{{$producto->id}}" method="get">
                  @csrf
                  <br>
                  <div  class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                          <button class="btn" type="submit" title="Arriba para cerrar ventana" class="btn btn-primary">
                              {{ __('Cancelar edición') }}
                          </button>
                      </div>
                </form>
              </div>
            </div>
          </div>
      </div>
    </div>
  </body>
</html>

@endsection
