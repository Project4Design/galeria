<?php

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

//VIEWS FRONT
Route::get('/','FrontCrontroller@index')->name('front_index');
Route::get('/about','FrontCrontroller@about')->name('about');
Route::get('/contacto','FrontCrontroller@contacto')->name('contacto');
Route::get('/galeria', 'FrontCrontroller@galeria')->name('galeria');
Route::get('/cursos','CursosController@cursos')->name('cursos.cursos');
Route::get('/cursos/{id}','CursosController@display')->name('cursos.display');

//LOGIN
Route::get('/login','FrontCrontroller@login')->name('login');
Route::post('auth', 'LoginController@login')->name('auth');
Route::post('/logout', 'LoginController@logout')->name('logout');

//PANEL DE USUARIO
Route::get('panel/dashboard', 'LoginController@index')->name('index');
//Cursos
Route::get('panel/cursos/{id}','CursosController@show');
//Pagos
Route::resource('panel/pagos','PagosController');
//Perfil
Route::get('panel/perfil','UsersController@perfil')->name('perfil');
Route::patch('panel/perfil','UsersController@update_perfil')->name('update_perfil');
//===========================================================================================

//AREA - PROFESORES
Route::get('area/dashboard', 'LoginController@index')->name('index');
Route::get('area/cursos/{curso}/{periodo}','CursosController@show');
Route::get('area/perfil','UsersController@perfil')->name('perfil');
Route::patch('area/perfil','UsersController@update_perfil')->name('update_perfil');
//===========================================================================================

//VIEWS ADMIN
//verificar rutas con permiso auth
Route::group(['middleware' => 'auth','prefix' => 'admin'],function(){
	Route::get('dashboard', 'LoginController@index')->name('admin_index');
	//Usuarios
	Route::get('perfil','UsersController@perfil')->name('perfil');
	Route::patch('perfil','UsersController@update_perfil')->name('update_perfil');
	Route::resource('/users','UsersController');
	//Pagos
	Route::resource('/pagos','PagosController');
	Route::get('/pagos_bus','PagosController@busqueda')->name('pagos.busqueda');
	//Cursos
	Route::resource('/cursos','CursosController');
	//Galeria
	Route::resource('/galeria','GaleriaController');
	//Profesores
	Route::resource('/profesores','ProfesoresController');
	//Estudiantes
	Route::resource('/estudiantes','EstudiantesController');
	//Representantes
	Route::resource('/representantes','RepresentantesController');
	//Periodos
	Route::patch('/periodos/{id}/cerrar','PeriodosController@cerrar');
	Route::resource('/periodos','PeriodosController');
	//Inscripciones
	Route::resource('/inscripciones','InscripcionesController');
	//Bitacora
	Route::get('/bitacora','BitacoraController@index')->name('bitacora.index');

	/* ----  REPORTES PDF --------*/
	Route::get('/rep_usuarios','ReportesController@usuarios')->name('pdf.usuarios');
	Route::get('/rep_estudiantes','ReportesController@estudiantes')->name('pdf.estudiantes');
	Route::post('/rep_pagos_fe','ReportesController@pagos_fecha')->name('pdf.pagos');

});