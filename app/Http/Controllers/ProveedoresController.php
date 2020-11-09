<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedores;

class ProveedoresController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:web');
  }
    public function agregarProveedor()
    {
      return view('Proveedores.agregar');
    }
    public function agregarProveedorPost()
    {
      $this->validate(request(),[
        'nombreDelProveedor' => 'required',
        'dniDelProveedor' => 'required',
        'telefonoDelProveedor' => 'required',
        'domicilioDelProveedor' => 'required',
      ]);
      Proveedores::create([
        'nombreDelProveedor' => request('nombreDelProveedor'),
        'dniDelProveedor' => request('dniDelProveedor'),
        'telefonoDelProveedor' => request('telefonoDelProveedor'),
        'domicilioDelProveedor' => request('domicilioDelProveedor'),
        'idUsuario' => auth()->user()->id
      ]);
      return redirect('/home')->with('exito','Proveedor agregado exitosamente!');
    }
    public function listarProveedores()
    {
      $idUsuario = auth()->user()->id;
      $lista = Proveedores::whereIn('idUsuario',[$idUsuario])->get();
      return view('Proveedores.listarProveedores',compact('lista'));
    }
    public function editarProveedor(Proveedores $proveedor)
    {
        return view('Proveedores.editarProveedor',compact('proveedor'));
    }
    public function editarProveedorPost(Proveedores $proveedor)
    {
      $proveedor->update(request()->all());
      return redirect('/listarProveedores')->with('exito','Proveedor editado correctamente');
    }
}
