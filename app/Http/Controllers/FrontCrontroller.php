<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use App\Galeria;
use App\Profesores;

class FrontCrontroller extends Controller
{
    //
	public function index()
	{
		$cursos = Curso::all();
		$profesores = Profesores::all();
		return view('front.index',['cursos'=>$cursos,'profesores'=>$profesores]);
	}

	public function galeria()
	{
		$cuadro = Galeria::all();

		return view('front.galeria',['cuadro' => $cuadro]);
	}

	public function about()
	{
		return view('front.about');
	}

	public function contacto()
	{
		return view('front.contacto');
	}

	public function login()
	{
		return view('login');
	}

	public function registro()
	{
		return view('registro');
	}
}
