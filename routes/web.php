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
Route::get('/admin','FrontCrontroller@login')->name('login');
Route::post('auth', 'LoginController@login')->name('auth');
Route::post('/logout', 'LoginController@logout')->name('logout');

//VIEWS ADMIN
//verificar rutas con permiso auth
Route::group(['middleware' => 'auth','prefix' => 'admin'],function(){
	Route::get('dashboard', 'LoginController@index')->name('admin_index');
	//Usuarios
	Route::get('perfil','UsersController@perfil')->name('perfil');
	Route::resource('/users','UsersController');
	//Pagos
	Route::resource('/pagos','PagosController');
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
	Route::resource('/periodos','PeriodosController');

});