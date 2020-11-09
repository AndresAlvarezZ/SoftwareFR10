@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Agregando proveedor</title>
    <link href="{{ asset('css/estilos.css') }}"defer rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-7">
            <div class="card">
              <div class="card-header">
                <h1>Editando Proveedor<a id="ajuste" href="/home">Cerrar ventana</a></h1>
              </div>
              <div id="ingresarProveedor"class="card-body">
                <div class="">
                  <form action="/editarProveedor/{{$proveedor->id}}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <label id="label"  for="nombreDelProveedor" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="label"  type="text" class="form-control @error('nombreDelProveedor') is-invalid @enderror" name="nombreDelProveedor" value="{{$proveedor->nombreDelProveedor}}" required autocomplete="nombreDelProveedor" autofocus>

                            @error('nombreDelProveedor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label id="label"  for="dniDelProveedor" class="col-md-4 col-form-label text-md-right">{{ __('Cédula') }}</label>

                        <div class="col-md-6">
                            <input id="dniDelProveedor" type="number" min="9" class="form-control @error('dniDelProveedor') is-invalid @enderror" name="dniDelProveedor" value="{{$proveedor->dniDelProveedor}}" required autocomplete="dniDelProveedor" autofocus>

                            @error('dniDelProveedor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label id="label"  for="telefonoDelProveedor" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                        <div class="col-md-6">
                            <input id="telefonoDelProveedor" type="text" class="form-control @error('telefonoDelProveedor') is-invalid @enderror" name="telefonoDelProveedor" value="{{$proveedor->telefonoDelProveedor}}" required autocomplete="telefonoDelProveedor" autofocus>

                            @error('telefonoDelProveedor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label id="label"  for="domicilioDelProveedor" class="col-md-4 col-form-label text-md-right">{{ __('Domicilio') }}</label>

                        <div class="col-md-6">
                            <input id="domicilioDelProveedor" type="text" class="form-control @error('domicilioDelProveedor') is-invalid @enderror" name="domicilioDelProveedor" value="{{$proveedor->domicilioDelProveedor}}" required autocomplete="domicilioDelProveedor" autofocus>

                            @error('domicilioDelProveedor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button class="btn" type="submit" class="btn btn-primary">
                                {{ __('Editar') }}
                            </button>
                        </div>
                    </div>
                  </form>

                </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
              </div>
            </div>
          </div>
      </div>
    </div>
  </body>
</html>

@endsection
