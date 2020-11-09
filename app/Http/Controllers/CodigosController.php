<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Codigos;

class CodigosController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:web');
  }
  
    function listarCodigos()
    {
      $idUsuario = auth()->user()->id;
      $lista = Codigos::whereIn('idUsuario',[$idUsuario])->get();
      return view('Codigos.listarCodigos',compact('lista'));
    }
    public function editarCodigo(Codigos $producto)
    {
      return view('Codigos.editarCodigo',compact('producto'));
    }
    public function editarCodigoPost(Codigos $producto)
    {
      $producto->update(request()->all());
      return redirect('/home')->with('exito','Codigo editado correctamente');
    }
    public function eliminarCodigo(Codigos $producto)
    {
      $producto->delete();
      return redirect('/home')->with('exito','Codigo eliminado');
    }
}
