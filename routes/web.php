<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Excel;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/etiqueta', 'etiquetas/etiqueta')->name('etiqueta');
Route::view('/ordenconfirm', 'ordenes/listadoorden_confirmada')->name('ordenconfirm');
Route::view('/ordenlistado', 'ordenes/listadoOrdenesR')->name('ordenlistado');
Route::view('/awb', 'documentacion/awb_nuevo')->name('awb');


//Rutas AJAX
//Get method
Route::get('mcipio', 'Tc\TcProvMcipioController@getMcipio')->name('mcipio');
Route::get('generatepdf', 'Etiqueta\EtiquetaController@generatePDF')->name('generatepdf');
Route::get('etiquetaResumen', 'Etiqueta\EtiquetaController@generatePDFResumen')->name('etiquetaResumen');
Route::get('generatepdfFactura', 'CargoFactura\FacturaController@facturaPdf')->name('generatepdfFactura');
Route::get('generaexcel', 'PDFController@generaExcel')->name('generaexcel');
Route::get('getCi', 'Tc\TcRemDestController@getCI')->name('getCi');
Route::get('getId', 'Tc\TcRemitterController@getID')->name('getId');
Route::get('voyage', 'Tc\TcViajeController@getVoyage')->name('voyage');
Route::get('articulos', 'Tc\ArticuloDescripController@getArticulos')->name('articulos');
Route::get('cp', 'Tc\TcProvMcipioController@getCP')->name('mcipio');
Route::get('noproducto', 'Producto\ProductoController@getNoProducto')->name('noproducto');
Route::get('/excel/{id?}', 'ExportController@export')->name('excel');
Route::get('/excela/{id?}', 'ExportController@exporta')->name('excela');
Route::get('/excelf/{embarque?}/{fdesde?}/{fhasta?}/{nofact?}/{estado?}/{concepto?}', 'ExportController@exportFactura')->name('excelf');
Route::get('/excelof/{embarque?}/{fdesde?}/{doc?}/{estadof?}/{estado_orden?}', 'ExportController@exportOrdenes')->name('excelof');
Route::get('generatebl', 'BL\BlController@generaBlPdf')->name('generatebl');
Route::get('generaawb', 'BL\BlController@generaGuiaPdf')->name('generaawb');
Route::get('generalempaque', 'BL\BlController@generaLEPdf')->name('generalempaque');
Route::get('tipocambio', 'Tc\TcMonedaController@getTipoCambio')->name('tipocambio');

//POST method
//Embarques
Route::post('verificaCont', 'Embarque\EmbarqueController@checkContainer')->name('verificaCont');
Route::post('listaMfto', 'Embarque\DocEmbarqueController@getManifiesto')->name('listaMfto');
Route::post('getport', 'Tc\TcPortController@getAir_Port')->name('getport');
Route::post('getEmbarquesCombo', 'Embarque\EmbarqueController@getNoEmbarque')->name('getEmbarquesCombo');
//Ordenes
Route::post('listaproductoorden', 'Orden\OrdenController@getListadoProducto')->name('listaproductoorden');
Route::post('listaproductodetalle', 'Orden\OrdenController@getProductoDetalle')->name('listaproductodetalle');
Route::post('listaBultoConfirmado', 'Orden\OrdenController@listaBultoConfirmado')->name('listaBultoConfirmado');
Route::post('listaordenestoembarque', 'Orden\OrdenController@ordenesToEmbarcar')->name('listaordenestoembarque');
Route::post('muevesolicitud', 'Orden\OrdenController@moveRequest')->name('muevesolicitud');
Route::post('listaordenes', 'Orden\OrdenController@listaOrdenes')->name('listaordenes');

//Etiquetas
Route::post('listaEtiquetas', 'Etiqueta\EtiquetaController@getListado')->name('listaEtiquetas');
//Producto
Route::post('articuloscapitulo', 'Producto\ProductoController@getArticulosCap')->name('articuloscapitulo');
Route::post('listaArticulos', 'Producto\ProductoController@getProductos')->name('listaArticulos');
//BL y MFTO
Route::post('urlgetSolicitudes', 'BL\BlController@getSolicitudes')->name('urlgetSolicitudes');
//TC
Route::post('listaremitentes_remitters', 'Tc\TcRemitterController@getListRemitter')->name('listaremitentes');

//Rutas Resources
Route::resource('tccont', 'Tc\TcContenedorController');
Route::resource('tcvessel', 'Tc\TcBuqueController');
Route::resource('tccliente', 'Tc\TcClienteController');
Route::resource('tcviaje', 'Tc\TcViajeController');
Route::resource('tcremdest', 'Tc\TcRemDestController');
Route::resource('tcport', 'Tc\TcPortController');
Route::resource('tcremitter', 'Tc\TcRemitterController');
Route::resource('embarques', 'Embarque\EmbarqueController');
Route::resource('ordenes', 'Orden\OrdenController');
Route::resource('itemprod', 'Tc\ArticuloDescripController');
Route::resource('producto', 'Producto\ProductoController');
Route::resource('etiqueta', 'Etiqueta\EtiquetaController');
Route::resource('mftoybl', 'BL\BlController');


