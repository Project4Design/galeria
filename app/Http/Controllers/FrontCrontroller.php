<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;

class FrontCrontroller extends Controller
{
    //
	public function index(){
		$cursos = Curso::all();

		return view('front.front',['cursos'=>$cursos]);
	}
}
