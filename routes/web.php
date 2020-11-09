<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//ruta de agregar y listar y editar codigos
Route::get('/agregarCodigo','CodigosController@agregarCodigo');
Route::post('/agregarCodigo','CodigosController@agregarCodigoPost');
Route::get('/listarCodigos','CodigosController@listarCodigos');
Route::get('/editarCodigo/{producto}','CodigosController@editarCodigo');
Route::put('/editarCodigo/{producto}','CodigosController@editarCodigoPost');
Route::delete('/eliminarCodigo/{producto}','CodigosController@eliminarCodigo');
//rutas para agregar y listar proveedores
Route::get('/agregarProveedor','ProveedoresController@agregarProveedor');
Route::Post('/agregarProveedor','ProveedoresController@agregarProveedorPost');
Route::get('/listarProveedores','ProveedoresController@listarProveedores');
Route::get('editarProveedor/{proveedor}','ProveedoresController@editarProveedor');
Route::put('/editarProveedor/{proveedor}','ProveedoresController@editarProveedorPost');
//rutas para agregar, listar y editar Productos
Route::get('/ingresarProducto','ProductosController@ingresarProducto');
Route::Post('/ingresarProducto','ProductosController@ingresarProductoPost');
Route::get('/listarProductos','ProductosController@listarProductos');
Route::get('/editarProductos/{producto}','ProductosController@editarProducto');
Route::put('/editarProductos/{producto}','ProductosController@editarProductoPost');
Route::delete('/eliminarProductos/{producto}','ProductosController@eliminarProducto');
//rutas para agregar o editar compras
Route::post('/agregarCompra','compraController@agregarCompra');
Route::get('/editarProducto/{producto}','compraController@editarProducto');
Route::put('/editarProducto/{producto}','compraController@editarProductoPost');
Route::delete('/eliminarProducto/{producto}','compraController@eliminarProducto');
//rutas de Facturas
Route::get('/generarFactura','FacturasController@generarFactura');
Route::get('/listarFacturas','FacturasController@listarFacturas');
//ruta para ajustar pantalla
Route::get('ajuste','AjustesController@ajuste');
Route::post('/agregarCompraPantallaAjustada','AjustesController@agregarCompra');
Route::get('/generarFacturaPantallaAjustada','AjustesController@generarFactura');
Route::get('/editarProductoPantallaAjustada/{producto}','AjustesController@editarProducto');
Route::put('/editarProductoPantallaAjustada/{producto}','AjustesController@editarProductoPost');
Route::delete('/eliminarProductoPantallaAjustada/{producto}','AjustesController@eliminarProducto');
//rutas para agregar Claves
Route::get('agregarClave','ClavesController@agregarClave');
Route::Post('/agregarClavePost','ClavesController@agregarClavePost');
Route::get('/listarClaves','ClavesController@listarClaves');
