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
		public function login(Request $request)
		{
    	$this->validate($request, [
  		'email' =>'required|email',
  		'password' => 'required|min:6',
  		]);

      if (Auth::attempt($request->only(['email' , 'password'])))
      {
      	switch (Auth::user()->nivel) {
      		case 1:
      			return redirect()->intended('admin/dashboard');
      		break;
      		case 2:
      			return redirect()->intended('area/dashboard');
      		break;
      		case 4:
      			return redirect()->intended('panel/dashboard');
      		break;
      	}
      }else{
      	return redirect()->route('login')->withErrors('Ha ocurrido un error. Revise sus credenciales');
      }
	 	}

	 	public function logout()
	 	{
		 	Auth::logout();
		 	return view('login');
	 	}

    public function index()
    {
    	switch (Auth::user()->nivel) {
    		case 1:
		    	$users = User::all();
		    	$cursos = Curso::all();
		    	$pagos = Pago::all();
		    	$profesores = Profesores::all();
		    	$estudiantes = Estudiante::all();

		 			return view('dashboard',['users'=>$users,'cursos'=>$cursos,'pagos'=>$pagos,'profesores'=>$profesores,'estudiantes'=>$estudiantes]);
    		break;
    		case 2:
    			$profesor = Profesores::where('user_id',Auth::user()->id)->get()->first();
    			$cursos = $profesor->inscripciones();
    			return view('area.dashboard',['cursos'=>$cursos]);
    		break;
    		case 4:
    			$estudiante = Estudiante::where('user_id',Auth::user()->id)->get()->first();
    			$cursos = $estudiante->cursos();
    			$disponibles = Curso::all();
    			return view('panel.dashboard',['cursos'=>$cursos,'disponibles'=>$disponibles]);
    		break;
    	}
	 	}
}
