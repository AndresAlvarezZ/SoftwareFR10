<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use App\Proveedores;
use App\Codigos;

class ProductosController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:web');
  }
    public function ingresarProducto()
    {
      $idUsuario = auth()->user()->id;
      $nombre = "";
      $proveedores = Proveedores::whereIn('idUsuario',[$idUsuario])->get();
      $codigos = Codigos::whereIn('idUsuario',[$idUsuario])->get();
      return view('Productos.productoNuevo',compact('proveedores','codigos','nombre'));
    }
    public function ingresarProductoPost()
    {
      $this->validate(request(),[
        'nombreDelProducto' => 'required',
        'codigoDelProducto' => 'required',
        'descripcionDelProducto' => 'required',
        'cantidadDelProducto' => 'required',
        'precioDelProducto' => 'required',
        'proveedorDelProducto' => 'required',
      ]);
      $idUsuario = auth()->user()->id;
          $productosExistentes = Productos::where('idUsuario',$idUsuario)->get();
        // return view('pruebas',compact('productosExistentes','request'));
          foreach ($productosExistentes as $existencias) {
            if ($existencias->codigoDelProducto==request('codigoDelProducto') or $existencias->nombreDelProducto==request('nombreDelProducto')) {
              return redirect('/ingresarProducto')->with('error','El codigo o nombre del producto que intentas ingresar ya existe');
            }
          }
          // si no existe entonces lo crea
          Productos::create([
            'idUsuario' => auth()->user()->id,
            'nombreDelProducto' => request('nombreDelProducto'),
            'codigoDelProducto' => request('codigoDelProducto'),
            'descripcionDelProducto' => request('descripcionDelProducto'),
            'cantidadDelProducto' => request('cantidadDelProducto'),
            'precioDelProducto' => request('precioDelProducto'),
            'proveedorDelProducto' => request('proveedorDelProducto'),
          ]);
          $idProducto = Productos::where('idUsuario',$idUsuario)->get();
          foreach ($idProducto as $id) {
            if ($id->codigoDelProducto==request('codigoDelProducto')) {
              Codigos::create([
                'codigo' => request('codigoDelProducto'),
                'idUsuario' => auth()->user()->id,
                'idProducto' => $id->id,
                'nombreDelProducto' => request('nombreDelProducto')
              ]);
            }
          }
          return redirect('/ingresarProducto')->with('status','Producto agregado exitosamente');

        }
        public function listarProductos()
        {
          $idUsuario = auth()->user()->id;
          $lista = Productos::whereIn('idUsuario',[$idUsuario])->get();
          return view('Productos.listarProductos',compact('lista'));
        }
        public function editarProducto(productos $producto)
        {
          $idUsuario = auth()->user()->id;
          $ocultador = 'visible';
          $proveedores = Proveedores::whereIn('idUsuario',[$idUsuario])->get();
          return view('Productos.editarProducto',compact('producto','proveedores','ocultador'));
        }
        public function editarProductoPost(Productos $producto)
        {
          $idUsuario = auth()->user()->id;
          $codigos = Codigos::where('idUsuario',$idUsuario)->get();
          foreach ($codigos as $codigo) {
            if ($codigo->codigo==$producto->codigoDelProducto) {
              $codigo->codigo = request('codigoDelProducto');
              $codigo->nombreDelProducto = request('nombreDelProducto');
              $codigo->update();
            }
          }
          $producto->update(request()->all());
          return redirect('/listarProductos')->with('exito','Producto editado correctamente');
        }
        public function eliminarProducto(Productos $producto)
        {
          $producto->delete();
          return redirect('/listarProductos')->with('exito','Producto eliminado');
        }
}
