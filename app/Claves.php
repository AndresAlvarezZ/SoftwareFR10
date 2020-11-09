<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claves extends Model
{
    protected $fillable = [
      'clave',
      'estado',
    ];
}
