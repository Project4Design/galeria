<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Estudiante;

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
        //dd($request->all());
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
          return view("admin/galeria")->with([
                'title' => 'Agregar',
                'estudiante' => $estudiante,
                'url'=> '/galeria',
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

      return view('estudiantes.view',['estudiante'=>$estudiante,'cursos'=>$cursos]);
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
