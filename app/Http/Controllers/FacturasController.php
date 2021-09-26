<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Compra;
Use App\Facturas;
Use App\Productos;
Use App\Caja;
use Illuminate\Support\Str;

class FacturasController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:web');
  }
    public function generarFactura()
    {
      $vuelto =(int)request('vueltoFactura');
      $alerta = 'no';
      $message = "";
      $messageStart = "El producto: ";
      if ($vuelto<0) {
        return redirect('/home')->with('status','Has ingresado un cambio menor al total a pagar!!');
      }

      $idUsuario = auth()->user()->id;
      $comprasAFacturar = Compra::where('idUsuario',$idUsuario)->get();
      $comprasRestadas = Productos::where('idUsuario','=',$idUsuario)->get();
      $sumador=0;
      $existe = 'no';
      $hayCaja = Caja::where('idUsuario',$idUsuario)->get();
      foreach ($hayCaja as $caja) {
        if ($caja->estado == 'abierta') {
          $existe = "sincompra";
          foreach ($comprasAFacturar as $compra) {
            if ($compra->estado == 'pendiente') {
                $existe = 'si';
                $sumador++;
                $compra->estado = 'cancelado';
                $compra->fecha = request('fechaFactura');
                $compra->update();
            }
          }
          foreach ($comprasRestadas as $producto) {
            if ($producto->cantidadDelProducto<=$producto->alerta) {
              $alerta = "si";
              $message = Str::finish($message,"$producto->nombreDelProducto, ");
            }
          }
        }
      }
      $message = Str::finish($messageStart,"$message tiene agotamiento de inventario");
      if ($existe=='si') {
        $saldo = Caja::where('estado','abierta')->get();
          Facturas::create([
          'idUsuario' => auth()->user()->id,
          'fecha'=> request('fechaFactura'),
          'nombreDelCliente'=> request('nombreDelClienteFactura'),
          'total'=> request('totalFactura'),
          'cambio'=> request('cambioFactura'),
          'vuelto'=> request('vueltoFactura')
        ]);
        foreach ($saldo as $caja) {
          $caja->saldoDeCierre = $caja->saldoDeCierre+request('totalFactura');
          $caja->update();
        }
          return redirect('/home')->with('exito','Facturacion exitosa')->with('alerta',$alerta)->with('message',$message);
      }
      if ($existe=='no') {
        return redirect('/home')->with('status','Primero debes Abrir la caja!!');
      }
      if ($existe=='sincompra') {
        return redirect('/home')->with('status','No hay compras agregadas!!');
      }


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
