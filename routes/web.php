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

Route::get('/', function () {
    return view('login');
});


Route::get('dashboard', 'LoginController@index');
Route::post('auth', 'LoginController@login')->name('auth');
Route::post('/logout', 'LoginController@logout')->name('logout');

//Usuarios
Route::get('perfil','UsersController@perfil')->name('perfil');
Route::resource('/users','UsersController');

//Cursos
Route::resource('/cursos','CursosController');