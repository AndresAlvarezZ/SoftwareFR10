<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compra;
use App\Productos;
use App\Facturas;

class AjustesController extends Controller
{

      /**
       * Create a new controller instance.
       *
       * @return void
       */
      public function __construct()
      {
          $this->middleware('auth');
      }

      /**
       * Show the application dashboard.
       *
       * @return \Illuminate\Contracts\Support\Renderable
       */
  public function ajuste()
  {
    $idUsuario = auth()->user()->id;
    $comprasTotales = Compra::whereIn('idUsuario',[$idUsuario])->get();
    $compras = [];
    $identificador =0;
    foreach ($comprasTotales as $compra) {
      if ($compra->estado=='pendiente') {
        $compras[$identificador] = $compra;
        $identificador++;
      }
    }
    $subtotal = 0;
    $total = 0;
      return view('ajuste',compact('compras','subtotal','total'));
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
      return redirect('/ajuste')->with('status','El codigo ingresado no existe!!');
    }
    return redirect('/ajuste');
  }
  public function editarProducto(Compra $producto)
  {
    return view('Compras.editarProductoPantallaAjustada',compact('producto'));
  }
  public function editarProductoPost(compra $producto)
  {
    $producto->update(request()->all());
    return redirect('/ajuste')->with('exito','Producto editado correctamente');
  }
  public function eliminarProducto(Compra $producto)
  {
    $producto->delete();
    return redirect('/ajuste')->with('exito','Producto eliminado');
  }
  public function generarFactura()
  {
    $vuelto =(int)request('vueltoFactura');
    if ($vuelto<0) {
      return redirect('/ajuste')->with('status','Has ingresado un cambio menor al total a pagar!!');
    }

    $idUsuario = auth()->user()->id;
    $comprasAFacturar = Compra::where('idUsuario',$idUsuario)->get();
    $comprasRestadas = Productos::where('idUsuario','=',$idUsuario)->get();
    $sumador=0;
    $existe = 'no';
    foreach ($comprasAFacturar as $compra) {
      if ($compra->estado == 'pendiente') {
          $existe = 'si';
          $sumador++;
          foreach ($comprasRestadas as $resta) {
            if ($compra->codigoDelProducto == $resta->codigoDelProducto) {
              $resta->cantidadDelProducto = $resta->cantidadDelProducto-$compra->cantidadDelProducto;
              $resta->update();
            }
          }
          $compra->estado = 'cancelado';
          $compra->fecha = request('fechaFactura');
          $compra->update();
          Facturas::create([
            'idUsuario' => auth()->user()->id,
            'fecha'=> request('fechaFactura'),
            'nombreDelCliente'=> request('nombreDelClienteFactura'),
            'total'=> request('totalFactura'),
            'cambio'=> request('cambioFactura'),
            'vuelto'=> request('vueltoFactura')
          ]);
      }
    }
    if ($existe=='si') {
        return redirect('/ajuste')->with('exito','Facturacion exitosa');
    }
      return redirect('/ajuste')->with('status','No hay compras agregadas!!');

  }
}
