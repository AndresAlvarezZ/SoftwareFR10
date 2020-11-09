<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $fillable = [
      'nombreDelProducto',
      'codigoDelProducto',
      'idUsuario',
      'descripcionDelProducto',
      'cantidadDelProducto',
      'precioDelProducto',
      'proveedorDelProducto',
    ];
}
