<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $fillable = [
      'idUsuario',
      'fechaApertura',
      'fechaCierre',
      'saldoInicial',
      'saldoDeCierre',
      'descripcion',
      'estado'
    ];
}
