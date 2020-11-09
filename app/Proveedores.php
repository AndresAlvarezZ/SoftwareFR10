<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $fillable = [
      'nombreDelProveedor',
      'dniDelProveedor',
      'telefonoDelProveedor',
      'domicilioDelProveedor',
      'idUsuario'
    ];
}
