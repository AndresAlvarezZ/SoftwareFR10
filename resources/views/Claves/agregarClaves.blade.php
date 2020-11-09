@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="/agregarClavePost" method="post">
      @csrf
        <h3>Agregando claves</h3>
        <input placeholder="Clave" required type="text" name="clave" value="">
        <button type="submit" name="button">Agregar</button>
    </form>
  </body>
</html>
@endsection
