<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use App\Galeria;

class FrontCrontroller extends Controller
{
    //
	public function index(){
		$cursos = Curso::all();

		return view('front.front',['cursos'=>$cursos]);
	}

	public function galeria()
	{
		$cuadro = Galeria::all();

		return view('front.galeria',['cuadro' => $cuadro]);
	}
}
