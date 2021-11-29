<?php

use App\Events\OrderStatusChangedEvent;
use App\Events\TecnicoEvent;
use App\Http\Controllers\FoliosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PageController;
use App\Http\Controllers\getComboController;
use App\Http\Controllers\InformacionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\whatsappApiController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\PermissonController;


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
    return redirect('/login');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');

	Route::group(['middleware' => ['permiso:consultar-folio,']],function(){
		Route::get('consulta',[PageController::class,'consulta'])->name('folios.consulta');
		Route::get('consultaFolios',[FoliosController::class,'consulta']); 
		Route::get('/search-combo',[getComboController::class,'getComboSearch']);
		Route::post('/actualizarEstatus', [FoliosController::class, 'actualizarEstatus']);
	});	//Grupo que puede consultar folios
	Route::group(['middleware' => ['permiso:crear-folio,']],function(){
		Route::get('preventivo',[PageController::class,'captura'])->name('informacion.preventivo');
		Route::get('correctivo',[PageController::class,'correctivo'])->name('informacion.correctivo');
		Route::post('preventivo',[InformacionController::class,'envio_preventivo']);
		Route::post('correctivo',[InformacionController::class,'envio_correctivo']); 
	});	//Grupo que puede crear folios
	Route::group(['middleware' => ['permiso:modificar-folio,']],function(){
		Route::get('consulta/{id}',[FoliosController::class,'detalle']);
	});	//Grupo que puede modificar folios
	Route::group(['middleware' => ['permiso:asignar-rol,']],function(){
		Route::get('roles',[ConfiguracionController::class,'roles'])->name('configuraciones.roles');
		Route::get('registro',[ConfiguracionController::class,'registro'])->name('configuraciones.registro');
		Route::get('edicion-de-usuarios',[ConfiguracionController::class,'edicion'])->name('configuraciones.edicion');
	});	//Grupo que puede crear roles
	Route::get('/grafica',[PageController::class,'grafica']);
	Route::put('/actualizar-folio',[FoliosController::class,'update']);
	Route::put('/finalizar-folio',[FoliosController::class,'finalizarFolio']);
	Route::get('/distrito',[getComboController::class,'clusterCombo']);
	Route::get('/tiempo',[getComboController::class,'calcTiempo']);
	Route::get('/loadcomboPreventivo',[getComboController::class,'getComboFormPreventivo']);
	Route::get('/loadcomboCorrectivo',[getComboController::class,'getComboFormCorrectivo']);
	Route::get('/sla',[getComboController::class,'tiempoSla']);
	Route::get('/tecnico',[FoliosController::class,'folioTecnico'])->name('informacion.tecnico')->middleware('permiso:,tecnico'); //Solo el técnico puede entrar.
	Route::get('/enviar-script/{id}',[whatsappApiController::class,'enviarScriptController']);
	Route::get('/copiar-script/{id}',[whatsappApiController::class,'copiarScriptController']);
	Route::get('/markAsRead',[NotificationController::class,'markAsRead'])->name('markAsRead');
	Route::get('/reportes',[PageController::class,'reportes'])->name('/reportes');
	Route::get('/export', [PageController::class,'export']);
	Route::get('/comboTecnico',[getComboController::class,'ComboTecnico']);
	Route::get('/cargar-roles', [PermissonController::class,'selectRoles']);
	Route::get('/cargar-tabla-permisos', [PermissonController::class,'tablaRoles']);
	Route::get('/eliminar-permiso', [PermissonController::class,'eliminarPermiso']);
	Route::get('/cargar-checkbox-permiso', [PermissonController::class,'cargarCheckboxPermiso']);
	Route::get('/agregar-permisos', [PermissonController::class,'agregarPermisos']);
	Route::get('/cargar-usuarios', [PermissonController::class,'tablaUsuarios']);
	Route::get('/editar-usuario', [PermissonController::class,'editarUsuario']);
	Route::get('/editar-password', [PermissonController::class,'editarPassword']);
	Route::get('/editar-rol', [PermissonController::class,'editarRol']);

});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

