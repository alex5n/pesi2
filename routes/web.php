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
    return view('index');
});
Route::post('/','UsuarioController@login')->name('user.login');
Route::get('/home',function(){
    return view('bienvenido');
})->name('home');

//Usuario
Route::resource('usuario', 'UsuarioController');
Route::get('cancelarusuario', function(){
    return redirect()->route('usuario.index')->with('datos','Accion Cancelada');
})->name('cancelarusuario');
Route::get('usuario/{usuario_id}/confirmar','UsuarioController@confirmar')->name('usuario.confirmar');
Route::post('usuarios/{idusuario}','UsuarioController@store')->name('usuario.store');
Route::put('usuariou/{id}/{idusuario}','UsuarioController@update')->name('usuario.update');
Route::delete('usuariod/{id}/{idusuario}','UsuarioController@destroy')->name('usuario.destroy');

//Empresa
Route::resource('empresa','EmpresaController');
Route::get('cancelarempresa', function(){
    return redirect()->route('empresa.index')->with('datos','Accion Cancelada');
})->name('cancelarempresa');
Route::get('empresa/{empresa}/confirmar','EmpresaController@confirmar')->name('empresa.confirmar');
Route::get('empresa/{empresa}/infogeneral','EmpresaController@infogeneral')->name('empresa.infogeneral');
Route::get('cancelarinfo/{RUC}', function($RUC){
    return redirect()->route('empresa.infogeneral',$RUC)->with('datos','Accion Cancelada');
})->name('cancelarinfo');
Route::put('empresa/{id}/{iduser}','EmpresaController@update')->name('empresa.update');
Route::post('empresa/{idusuario}','EmpresaController@store')->name('empresa.store');
Route::delete('empresad/{id}/{idusuario}','EmpresaController@destroy')->name('empresa.destroy');

//Proceso
Route::resource('proceso','ProcesoController');
Route::get('cancelarproceso/{id}', function($id){
    return redirect()->route('proceso.show', ['id' => $id, 'valor' => 1])->with('datos','Accion Cancelada');
})->name('cancelarproceso');
Route::get('proceso/{idproceso}/confirmar','ProcesoController@confirmar')->name('proceso.confirmar');
Route::get('procesoc/{id}','ProcesoController@create')->name('proceso.create');
Route::get('procesoc/{id}/{valor}','ProcesoController@show')->name('proceso.show');
Route::post('procesos/{id}/{idusuario}','ProcesoController@store')->name('proceso.store');
Route::put('procesosu/{id}/{idusuario}','ProcesoController@update')->name('proceso.update');
Route::delete('procesosd/{id}/{idusuario}','ProcesoController@destroy')->name('proceso.destroy');
Route::get('general/{id}','ProcesoController@general')->name('proceso.general');

//Subproceso
Route::resource('subproceso','SubprocesoController');
Route::get('cancelarsubproceso/{id}', function($id){
    return redirect()->route('proceso.show', ['id' => $id, 'valor' => 2])->with('datos','Accion Cancelada');
})->name('cancelarsubproceso');
Route::get('subproceso/{idsubproceso}/confirmar','SubprocesoController@confirmar')->name('subproceso.confirmar');
Route::get('subprocesoc/{id}','SubprocesoController@create')->name('subproceso.create');
Route::post('subprocesos/{id}/{idusuario}','SubprocesoController@store')->name('subproceso.store');
Route::put('subprocesosu/{id}/{idusuario}','SubprocesoController@update')->name('subproceso.update');
Route::delete('subprocesosd/{id}/{idusuario}','SubprocesoController@destroy')->name('subproceso.destroy');

//Organización
Route::resource('organizacion','OrganizacionController');
Route::get('cancelarorganizacion/{id}', function($id){
    return redirect()->route('organizacion.show', $id)->with('datos','Accion Cancelada');
})->name('cancelarorganizacion');
Route::get('organizacion/{idarea}/confirmar','OrganizacionController@confirmar')->name('organizacion.confirmar');
Route::post('organizacions/{id}/{idusuario}','OrganizacionController@store')->name('organizacion.store');
Route::put('organizacionu/{id}/{idusuario}','OrganizacionController@update')->name('organizacion.update');
Route::delete('organizaciond/{id}/{idusuario}','OrganizacionController@destroy')->name('organizacion.destroy');


Route::resource('detalleproceso','DetalleProcesoController');
Route::get('cancelardetalle/{id}', function($id){
    return redirect()->route('detalleproceso.show', $id)->with('datos','Accion Cancelada');
})->name('cancelardetalle');

//Reportes
Route::get('informe1/{id}','ReporteController@informe1')->name('reporte.informe1');
Route::get('informe2/{id}','ReporteController@informe2')->name('reporte.informe2');
Route::get('informe3/{id}','ReporteController@informe3')->name('reporte.informe3');
Route::get('matriz/{id}','ReporteController@matriz')->name('reporte.matriz');
Route::get('auditoria','ReporteController@auditoria')->name('reporte.auditoria');

//Descargas
Route::get('/imprimirpdf/{id}', 'imprimirController@pdf')->name('descargapdf');
Route::get('/imprimirword/{id}', 'imprimirController@word')->name('descargaword');