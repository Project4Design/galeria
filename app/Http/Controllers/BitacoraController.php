<?php

namespace App\Http\Controllers;

use App\Bitacora;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
  public function index(){
  	$bitacora = Bitacora::all();
  	return view('bitacora.index',['bitacora'=>$bitacora]);
  }
}
