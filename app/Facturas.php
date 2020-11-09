<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facturas extends Model
{
    protected $fillable = [
      'idUsuario',
      'fecha',
      'nombreDelCliente',
      'total',
      'cambio',
      'vuelto',
    ];
}
