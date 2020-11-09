@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="/home" method="get">
    <?php foreach ($clavesDisponibles as $claves): ?>
        <h4><strong>Clave: </strong>{{$claves->clave}}</h4>
    <?php endforeach; ?>
    <button type="submit" name="button">Entendido</button>
  </form>
  </body>
</html>
@endsection
