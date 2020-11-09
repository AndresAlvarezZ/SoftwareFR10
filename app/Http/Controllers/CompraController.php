<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use App\Compra;

class CompraController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:web');
  }
    public function agregarCompra()
    {
      /*$this validate(request(),[
        'codigo' => 'required',
        'cantidad' => 'required',
      ]);*/
      $codigo = request('codigo');
      $idUsuario = auth()->user()->id;
        $compras = Productos::where('idUsuario','=',$idUsuario)->get();
        $existe = "no";
        foreach ($compras as $compra) {
          if ($compra->cantidadDelProducto<request('cantidad')) {
            return redirect('/home')->with('status','No tienes inventario suficiente!!');
          }
        //  return view ('pruebas',compact('compras'));
        if ($compra->codigoDelProducto==$codigo) {
          $existe = "si";
          Compra::create([
            'idUsuario' => $idUsuario,
            'nombreDelProducto' => $compra->nombreDelProducto,
            'codigoDelProducto' => $compra->codigoDelProducto,
            'cantidadDelProducto' => request('cantidad'),
            'precioDelProducto' => $compra->precioDelProducto,
            'fecha' => request('fecha'),
            'estado' => 'pendiente'
          ]);
        }
        }
      if ($existe=="no") {
        return redirect('/home')->with('status','El codigo ingresado no existe!!');
      }
      return redirect('/home');
    }
    public function editarProducto(Compra $producto)
    {
      return view('Compras.editarProducto',compact('producto'));
    }
    public function editarProductoPost(compra $producto)
    {
      $producto->update(request()->all());
      return redirect('/home')->with('exito','Producto editado correctamente');
    }
    public function eliminarProducto(Compra $producto)
    {
      $producto->delete();
      return redirect('/home')->with('exito','Producto eliminado');
    }
}
