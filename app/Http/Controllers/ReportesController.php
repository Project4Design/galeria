<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\User;
use App\Curso;
use App\Pago;
use App\Profesores;
use App\Bitacora;

class ReportesController extends Controller
{
    public function usuarios()
    {
    	$users = User::all();
    	$fecha = Date('Y-m-d');
    	$pdf = PDF::loadView('reportes.usuarios',['users' => $users]);
        return $pdf->download('usuarios'.$fecha.'.pdf');
    }
}
