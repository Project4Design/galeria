<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\User;
use App\Curso;
use App\Pago;
use App\Profesores;
use App\Bitacora;
use App\Estudiante;

class ReportesController extends Controller
{


    public function usuarios()
    {
    	$users = User::all();
    	 $fecha = Date('Y-m-d');
    	$pdf = PDF::loadView('reportes.usuarios',['users' => $users]);
        return $pdf->download('usuarios'.$fecha.'.pdf');
    }

    public function estudiantes()
    {
    	$estudiantes = Estudiante::all();
    	 $fecha = Date('Y-m-d');
    	$pdf = PDF::loadView('reportes.estudiantes',['estudiantes' => $estudiantes]);

    	return $pdf->download('estudiantes'.$fecha.'.pdf');

    }

    public function pagos_fecha(Request $request)
    {

    $desde = $request->input('desde');
    $hasta = $request->input('hasta');
    
    $pagos = new Pago;
    $resultado = $pagos->fechaBetween($desde,$hasta);

    if ($resultado->count() > 0) {

         $fecha = Date('Y-m-d');
        $pdf = PDF::loadView('reportes.pagos_fe',['pagos' => $resultado,'desde' => $desde,'hasta' => $hasta]);
        return $pdf->download('pagos'.$fecha.'.pdf');

        }else{
        return redirect('admin/pagos_bus')->with([
                'title' => "Agregar",
            'flash_message' => 'No se encontraron resultados.',
            'flash_class' => 'alert-danger',
            'flash_important' => true,

            ]);
      }//fin if
    
    }
}
