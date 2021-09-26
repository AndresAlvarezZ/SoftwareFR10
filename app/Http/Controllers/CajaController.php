<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Caja;

class CajaController extends Controller
{
  public function apertura()
  {
    return view('Caja.apertura');
  }
    public function aperturaPost()
    {
      $idUsuario = auth()->user()->id;
      $chequeo = Caja::where('idUsuario',$idUsuario)->get();
      foreach ($chequeo as $caja) {
        if ($caja->estado=='abierta') {
          return redirect('/home')->with('status','ya tienes una caja abierta');
        }
      }
      $fecha = request('fechaApertura');
      $monto = request('saldoInicial');
      $this->validate(request(),[
        'fechaApertura' => 'required',
        'saldoInicial' => 'required',
        'descripcion' => 'required',
      ]);
      Caja::create([
        'idUsuario' => auth()->user()->id,
        'fechaApertura' => request('fechaApertura'),
        'saldoInicial' => request('saldoInicial'),
        'saldoDeCierre' => 0,
        'descripcion' => request('descripcion'),
        'estado' => 'abierta'
      ]);
      return redirect('/home')->with('exito',"La caja se abrió el: $fecha con un saldo inicial de: $monto colones");
    }
    public function cerrarCaja()
    {
      $idUsuario = auth()->user()->id;
      $cierre = Caja::where('idUsuario',$idUsuario)->get();
      foreach ($cierre as $caja) {
        if ($caja->estado=='abierta') {
          $abierta = $caja;
          return view('Caja.cierre',compact('abierta'));
        }
      }
      return redirect('/home')->with('status','No tienes una caja abierta');
    }
    public function cerrarCajaPost(Caja $caja)
    {
      $fecha = request('fechaCierre');
      $monto = request('saldoDeCierre');
      $caja->fechaCierre = request('fechaCierre');
      $caja->saldoDeCierre = request('saldoDeCierre');
      $caja->estado ='cerrada';
      $caja->update();
      return redirect('/home')->with('exito',"La caja se cerró el: $fecha con un saldo final de: $monto colones");
    }
}
