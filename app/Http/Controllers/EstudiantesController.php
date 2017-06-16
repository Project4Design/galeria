<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Estudiante;
use App\Representante;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
      $estudiantes = Estudiante::all();
    	return view('estudiantes.index',['estudiantes'=>$estudiantes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $estudiante = new Estudiante;
      return view("estudiantes.create", ["title" => "Agregar","estudiante" => $estudiante,"url" => "admin/estudiantes", "method" => "POST"]);
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
    		'foto' => 'required|image',
    		'nombres' => 'required',
    		'apellidos' => 'required',
    		'cedula' => 'required|numeric|unique:estudiantes',
    		'sexo' => 'required',
    		'nacimiento' => 'required',
    		'residencia' => 'required',
    		'email' => 'required|unique:email',
    		'alergico' => 'required',
    		'tld_personal' => 'tlf_personal',
    	]);

      $hoy = date('d-m-Y');
      $date = date_diff(date_create($fecha),date_create($hoy));
    	$edad = $date->format('%a');

    	if($edad<18){
    		$Representante = new Representante;
    		dd(true);
    	}

      $estudiante = new Estudiante;
      $estudiante->fill($request->all());

      if(input::hasFile('foto')){
        $file = Input::file('foto');
        $file->move(public_path().'/images/estudiantes/',$file->getClientOriginalName());
        $estudiante->foto = $file->getClientOriginalName();
      }

      if($estudiante->save()){
          return redirect("admin/estudiantes")->with([
              'flash_message' => 'Estudiante agregado correctamente.',
              'flash_class' => 'alert-success'
              ]);
      }else{
          return view("admin/estudiantes")->with([
                'title' => 'Agregar',
                'estudiante' => $estudiante,
                'url'=> 'admin/estudiantes',
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
    public function show($id)
    {
      $estudiante = Estudiante::findOrFail($id);
      $cursos = array();

      $hoy = date('d-m-Y');
      $x = explode("/",$estudiante->nacimiento);
      $fecha = $x[1]."-".$x[0]."-".$x[2];
      $date = date_diff(date_create(date('d-m-Y',strtotime($fecha))),date_create($hoy));
      $edad = $date->format('%y');

      return view('estudiantes.view',['estudiante'=>$estudiante,'cursos'=>$cursos,'edad'=>$edad]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estudiante = Estudiante::findOrFail($id);
      return view("estudiantes.create", ["title" => "Editar","estudiante" => $estudiante,"url"=> "admin/estudiantes/{$id}/","method" => 'PATCH']);
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
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->fill($request->all());

        if(input::hasFile('foto')){
        $file = Input::file('foto');
        $file->move(public_path().'/images/estudiantes/',$file->getClientOriginalName());
        $estudiante->foto = $file->getClientOriginalName();
      }

        if($estudiante->save()){
        return redirect("admin/estudiantes")->with([
            'flash_message' => 'Estudiante editado correctamente.',
            'flash_class' => 'alert-success'
            ]);
        }else{
        return view("admin/estudiantes")->with([
            'title' => 'Editar',
            'estudiante' => $estudiante,
            'url'=> "/admin/estudiantes/{$id}/",
            'method' => 'PATCH',
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
        //
    }
}
