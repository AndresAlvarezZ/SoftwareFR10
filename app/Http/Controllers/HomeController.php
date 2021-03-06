<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compra;
use PDF;
use App\Proveedores;
use App\Facturas;

class HomeController extends Controller
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
    public function index()
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
      return view('central',compact('compras','subtotal','total'));
        return view('home',compact('compras','subtotal','total'));
    }
    public function imprimir(Facturas $factura)
    {
      $idUsuario = auth()->user()->id;
      $fecha = date('Y-m-d');
      $indice = 0;
      $indiceFactura = 0;
      $compras = Compra::where('idUsuario',$idUsuario)->get();
      $pdf = PDF::loadView('Facturas.imprimirFacturas',compact('factura','compras','indice','fecha'))->setOptions(['defaultFont' => 'sans-serif']);
      return $pdf->download('factura.pdf');
    }
}
