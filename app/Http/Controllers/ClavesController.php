<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Claves;

class ClavesController extends Controller
{
    public function agregarClave()
    {
      return view('Claves.agregarClaves');
    }
    public function agregarClavePost()
    {
      Claves::create([
        'clave' => request('clave'),
        'estado' =>'libre'
      ]);
      return redirect('/home')->with('exito','clave agregada');
    }
    public function listarClaves()
    {
      $clavesDisponibles = Claves::where('estado','libre')->get();
      return view('Claves.listarClaves',compact('clavesDisponibles'));
    }
}
