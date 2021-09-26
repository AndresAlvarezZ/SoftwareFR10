@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Apertura de caja</title>
  </head>
  <body>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <div class="text-center">
                  <h1>Apertura de caja</h1>
                </div>
              </div>
              <div class="card-body">
                <form class="" action="/aperturaPost" method="post">
                  @csrf
                  <div class="form-group row">
                      <label for="fechaApertura" class="col-md-4 col-form-label text-md-right">{{ __('fecha') }}</label>

                      <div class="col-md-6">
                          <input id="fechaApertura" type="datetime" class="form-control @error('fechaApertura') is-invalid @enderror" name="fechaApertura" value="<?php echo date("Y-m-d H:i:s");?>" required autocomplete="fechaApertura" readonly>
                          @error('fechaApertura')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group row">
                    <label for="saldoInicial" class="col-md-4 col-form-label text-md-right">Saldo Inicial</label>
                    <div class="col-md-6">
                      <input type="number" class="form-control" name="saldoInicial" value="">

                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="saldoInicial" class="col-md-4 col-form-label text-md-right">Descripción</label>
                    <div class="col-md-6">
                      <textarea name="descripcion" class="form-control" ></textarea>
                    </div>
                  </div>
                  <div  class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4 text-center">
                          <button class="btn" type="submit" class="btn btn-primary">
                              {{ __('Abrir Caja') }}
                          </button>
                      </div>
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
