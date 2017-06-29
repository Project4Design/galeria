<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Nota;
use App\Curso;
use App\Periodo;
use App\Bitacora;
use App\Profesores;

class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    	$cursos = Curso::all();
    	return view('cursos.index',['cursos'=>$cursos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    	$curso = new curso;

      $profesores = Profesores::all();
      return view("cursos.create", ["title" => "Agregar","curso" => $curso,"url" => "admin/cursos", "method" => "POST" , "profesor" => $profesores]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
      $this->validate($request, [
      	'titulo' => 'required',
      	'descripcion' => 'required',
        'precio' => 'required|numeric',
        'limit' => 'required',
        'image' => 'required|image',
        'id_profesor'=>'required'
      ]);

    	$curso = new Curso;
    	$curso->fill($request->all());

      if(input::hasFile('image')){
        $file = Input::file('image');
        $file->move(public_path().'/images/cursos/',$file->getClientOriginalName());
        $curso->foto = $file->getClientOriginalName();
      }

      if($curso->save()){
        //Registro en la bitacora
        $bitacora = New Bitacora;
        $bitacora->usuario = Auth::user()->email;
        $bitacora->modulo = 'Cursos';
        $bitacora->accion = 'Registro de curso '.$curso->titulo;
        $bitacora->save();
        // fin bitacora
	      return redirect("admin/cursos")->with([
	          'flash_message' => 'Curso agregado correctamente.',
	          'flash_class' => 'alert-success'
	          ]);
	    }else{
          return view("admin/cursos")->with([
          		'title' => 'Agregar',
          		'curso' => $curso,
          		'url'=> 'admin/cursos',
          		'method' => 'POST',
              'flash_message' => 'Ha ocurrido un error.',
              'flash_class' => 'alert-danger',
              'flash_important' => true
              ]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$periodo = NULL)
    {
        //
    	$curso = Curso::findOrFail($id);
    	switch (Auth::user()->nivel) {
    		case 1:
		    	$estudiantes = $curso->estudiantes();
		      return view("cursos.view", ["curso" => $curso,'estudiantes' => $estudiantes]);
    		break;
    		case 2:
		    	$estudiantes = $curso->estudiantesByPeriodo($periodo);
		    	$periodo = Periodo::find($periodo);
		      return view("area.cursos.view", ["curso" => $curso,'estudiantes' => $estudiantes,'periodo'=>$periodo]);
    		break;
    		case 3:
    		case 4:
    			return view("panel.cursos.view", ["curso" => $curso]);
    		break;
    	}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    	$curso = curso::findOrFail($id);

        $profesores = Profesores::all();
      return view("cursos.create", ["title" => "Edit","curso" => $curso,"url"=> "admin/cursos/{$id}/","method" => 'PATCH','profesor' => $profesores]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
      $this->validate($request, [
      	'titulo' => 'required',
      	'descripcion' => 'required',
        'precio' => 'required|numeric',
        'limit' => 'required',
        'image' => 'nullable|image',
        'id_profesor'=>'required'
      ]);

    	$curso = Curso::findOrFail($id);
    	$curso->fill($request->all());

    	if(input::hasFile('image')){
        $file = Input::file('image');
        $file->move(public_path().'/images/cursos/',$file->getClientOriginalName());
        $curso->foto = $file->getClientOriginalName();
      }

    	if($curso->save()){
        //Registro en la bitacora
        $bitacora = New Bitacora;
        $bitacora->usuario = Auth::user()->email;
        $bitacora->modulo = 'Cursos';
        $bitacora->accion = 'Se modifico el curso '.$curso->titulo;
        $bitacora->save();
        // fin bitacora
        return redirect("admin/cursos")->with([
            'flash_message' => 'Curso editado correctamente.',
            'flash_class' => 'alert-success'
            ]);
    	}else{
        return redirect("admin/cursos")->with([
            'flash_message' => 'Ha ocurrido un error.',
            'flash_class' => 'alert-danger',
            'flash_important' => true
            ]);
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        
        if ($curso->selete()) {
		        //Registro en la bitacora
		        $bitacora = New Bitacora;
		        $bitacora->usuario = Auth::user()->email;
		        $bitacora->modulo = 'Cursos';
		        $bitacora->accion = 'Se elimino el curso '.$curso->titulo;
		        $bitacora->save();
		        // fin bitacora
            return redirect("admin/cursos")->with([
                'flash_message' => 'Cuadro se ha eliminado correctamente.',
                'flash_class' => 'alert-success'
                ]);
        }else{
            return redirect("admin/cursos")->with([
                'flash_message' => '¡Ha ocurrido un error!',
                'flash_class' => 'alert-danger'
                ]);
        }
    }


    //FUNCIONES DEL FRONT

    public function cursos()
    {
      $cursos = Curso::all();

      return view('front.cursos',['cursos'=>$cursos]);
    }

    public function display($id)
    {
      $curso = Curso::find($id);

      return view('front.display',['curso'=>$curso]);
    }

    public function calificar(Request $request,$curso,$periodo){
    	$curso = Curso::find($curso);
    	$total = count($curso->estudiantesByPeriodo($periodo));

    	for ($i=0; $i < $total; $i++) {
    		$nota = Nota::where('inscripcion_id',$request->input("id_".($i+1)))->first();
    		$nota->nota = $request->input("nota_".($i+1));
    		$nota->save();
    	}

    	return redirect("area/cursos/{$curso->curso_id}/{$periodo}")->with([
    			'flash_class'   => 'alert-success',
    			'flash_message' => 'Notas asignadas'
    		]);
    }

    public function panel_show($id)
    {
    	$curso = Curso::findOrFail($id);
    	$periodos = Periodo::all();

    	return view('panel.cursos.show',['curso'=>$curso,'periodos'=>$periodos]);
    }
}
