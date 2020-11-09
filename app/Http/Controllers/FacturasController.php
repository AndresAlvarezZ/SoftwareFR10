<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Compra;
Use App\Facturas;
Use App\Productos;

class FacturasController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:web');
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
        }
      }
      if ($existe=='si') {
          Facturas::create([
          'idUsuario' => auth()->user()->id,
          'fecha'=> request('fechaFactura'),
          'nombreDelCliente'=> request('nombreDelClienteFactura'),
          'total'=> request('totalFactura'),
          'cambio'=> request('cambioFactura'),
          'vuelto'=> request('vueltoFactura')
        ]);
          return redirect('/home')->with('exito','Facturacion exitosa');
      }
        return redirect('/home')->with('status','No hay compras agregadas!!');


    }
    public function listarFacturas()
    {
      $idUsuario = auth()->user()->id;
      $fecha = date('Y-m-d');
      $indice = 0;
      $indiceFactura = 0;
      $misFacturas = Facturas::where('idUsuario',$idUsuario)->get();
      $compras = Compra::where('idUsuario',$idUsuario)->get();

      return view('Facturas.listarFacturas',compact('fecha','indice','indiceFactura','misFacturas','compras'));

    }
}
