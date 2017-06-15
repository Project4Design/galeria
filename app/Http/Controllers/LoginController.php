<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Curso;
use App\Pago;
use App\Profesores;
use App\Estudiante;

class LoginController extends Controller
{
    public function index()
    {
    	$users = User::all();
    	$cursos = Curso::all();
    	$pagos = Pago::all();
    	$profesores = Profesores::all();
    	$estudiantes = Estudiante::all();

 			return view('dashboard',['users'=>$users,'cursos'=>$cursos,'pagos'=>$pagos,'profesores'=>$profesores,'estudiantes'=>$estudiantes]);
	 }


	 public function login(Request $request)
	 {
	 	/*----------- LOGIN MANUAL , MODIFICABLE ----------*/

	 	//attemp suelta un booleano
    	//dd($request->all());

    	$this->validate($request, [

    		'email' =>'required|email',
    		'password' => 'required|max:8',

    		]);

	        if (Auth::attempt($request->only(['email' , 'password'])))
	        {
	        	return redirect()->intended('admin/dashboard');
	        }else{
	        	return redirect()->route('login')->withErrors('An error has occurred, check your credentials');
	        }
	 }

	 public function logout()
	 {
	 	/*---- funcion de salir/logout/cerrar sesion --*/
	 	Auth::logout();
	 	return view('login');

	 }
    
}
