<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codigos extends Model
{
    protected $fillable = [
      'codigo',
      'idUsuario',
      'idProducto',
      'nombreDelProducto',
    ];
}
