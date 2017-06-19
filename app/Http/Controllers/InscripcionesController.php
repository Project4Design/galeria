<?php

namespace App\Http\Controllers;

use App\Inscripcion;
use App\Periodo;
use App\Curso;
use App\Estudiante;
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
    public function create()
    {
      $periodos = Periodo::all()->where('status',1);
      $cursos = Curso::all();
      $estudiantes = Estudiante::all();
      return view('inscripciones.create',['periodos'=>$periodos,'cursos'=>$cursos,'estudiantes'=>$estudiantes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
      	'periodo' => 'required',
      	'curso' => 'required',
      	'estudiante' => 'required'
      	]);

      $inscripcion = new Inscripcion;

      $cantidad = $inscripcion->verificarLimite($request->input('periodo'),$request->input('curso'));

      $curso = Curso::find($request->input('curso'));

      if($cantidad < $curso->limit){

      	$repetido = $inscripcion->verificarRepetido($request->input('periodo'),$request->input('curso'),$request->input('estudiante_id'));

      	if($repetido === 0){
		      $inscripcion->periodo_id = $request->input('periodo');
		      $inscripcion->curso_id = $request->input('curso');
		      $inscripcion->estudiante_id = $request->input('estudiante');

		      if($inscripcion->save()){
		      	return redirect('admin/inscripciones/')->with([
		      			'flash_message'=>'Inscripcion realizada correctamente.',
		      			'flash_class'=>'alert-success'
		      		]);
		      }else{
		      	return redirect('admin/inscripciones/')->with([
		            'flash_message' => 'Ha ocurrido un error.',
		            'flash_class' => 'alert-danger',
		            'flash_important' => true
		      		]);
		      }
		    }else{
      		return redirect('admin/inscripciones/')->with([
            'flash_message' => 'Este estudiante ya se encuentra inscrito en ese curso.',
            'flash_class' => 'alert-danger',
            'flash_important' => true
      		]);
		    }
	    }else{
      	return redirect('admin/inscripciones/')->with([
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
}
