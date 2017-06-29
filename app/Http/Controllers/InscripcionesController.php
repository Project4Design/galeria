<?php

namespace App\Http\Controllers;

use App\Inscripcion;
use App\Nota;
use App\Curso;
use App\Periodo;
use App\Bitacora;
use App\Estudiante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InscripcionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $inscripciones = Inscripcion::all();
      return view('inscripciones.index',['inscripciones'=>$inscripciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($estudiante = NULL)
    {
      $periodos    = Periodo::all()->where('status',1);
      $cursos      = Curso::all();
      $estudiantes = Estudiante::all();
      return view('inscripciones.create',['periodos'=>$periodos,'cursos'=>$cursos,'estudiantes'=>$estudiantes,'estudiante' => $estudiante]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	switch (Auth::user()->nivel) {
    		case 1:
		      $this->validate($request,[
		      	'periodo'    => 'required',
		      	'curso'      => 'required',
		      	'estudiante' => 'required'
	      	]);

	      	$p = $request->input('periodo');
    			$c = $request->input('curso');
    			$e = $request->input('estudiante');
    			$redirect = 'admin/inscripciones';
  			break;
    		
    		case 4:
    			$this->validate($request,['periodo' => 'required']);
    			$p = $request->input('periodo');
    			$c = $request->input('curso');
    			$estudiante = Estudiante::where('user_id',Auth::user()->id)->get()->first();
    			$e = $estudiante->estudiante_id;
    			$redirect = 'panel/cursos/'.$c;
  			break;
    	}

      $inscripcion = new Inscripcion;

      $cantidad = $inscripcion->verificarLimite($p,$c);
      $curso = Curso::find($c);

      if($cantidad < $curso->limit){

      	$repetido = $inscripcion->verificarRepetido($p,$c,$e);

      	if($repetido === 0){
		      $inscripcion->periodo_id = $p;
		      $inscripcion->curso_id = $c;
		      $inscripcion->estudiante_id = $e;

		      if($inscripcion->save()){
		      	$nota = new Nota;
		      	$nota->inscripcion_id = $inscripcion->inscripcion_id;
		      	$nota->save();

		        //Registro en la bitacora
		        $bitacora = New Bitacora;
		        $x = Estudiante::find($e);
		        $y = Curso::find($c);
		        $bitacora->usuario = Auth::user()->email;
		        $bitacora->modulo = 'Inscripcion';
		        $bitacora->accion = 'Se inscribio al usuario '.$x->user->email.' en el curso '.$y->titulo;
		        $bitacora->save();
		        // fin bitacora
		        if(Auth::user()->nivel===1){ $redirect = 'admin/pagos/create/'.$inscripcion->inscripcion_id;}
		      	return redirect($redirect)->with([
		      			'flash_message'=>'Inscripcion realizada correctamente.',
		      			'flash_class'=>'alert-success'
		      		]);
		      }else{
		      	return redirect($redirect)->with([
		            'flash_message' => 'Ha ocurrido un error.',
		            'flash_class' => 'alert-danger',
		            'flash_important' => true
		      		]);
		      }
		    }else{
      		return redirect($redirect)->with([
            'flash_message' => 'Este estudiante ya se encuentra inscrito en ese curso.',
            'flash_class' => 'alert-danger',
            'flash_important' => true
      		]);
		    }
	    }else{
      	return redirect($redirect)->with([
            'flash_message' => 'Error, limite de estudiantes alcanzado.',
            'flash_class' => 'alert-danger',
            'flash_important' => true
      		]);
	    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function show(Inscripcion $inscripcion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function edit(Inscripcion $inscripcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inscripcion $inscripcion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inscripcion $inscripcion)
    {
        //
    }

    public function view($inscripcion){
    	$inscripcion = Inscripcion::where([['inscripcion_id',$inscripcion],['estudiante_id',Auth::user()->estudiante->estudiante_id]])->first();

    	return view('panel.cursos.view',['inscripcion'=>$inscripcion]);
    }
}
