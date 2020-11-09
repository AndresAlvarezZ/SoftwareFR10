<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compra;

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
      return 'deberia ir hasta aqui bien';
        return view('home',compact('compras','subtotal','total'));
    }
}
