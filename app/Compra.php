<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = [
      'idUsuario',
      'nombreDelProducto',
      'codigoDelProducto',
      'cantidadDelProducto',
      'precioDelProducto',
      'fecha',
      'estado',
    ];
}
