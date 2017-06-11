<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Curso;

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
      return view("cursos.create", ["title" => "Agregar","curso" => $curso,"url" => "admin/cursos", "method" => "POST"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    	$curso = new Curso;
    	$curso->fill($request->all());

      if(input::hasFile('image')){
        $file = Input::file('image');
        $file->move(public_path().'/images/cursos/',$file->getClientOriginalName());
        $curso->foto = $file->getClientOriginalName();
      }

      if($curso->save()){
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
    public function show($id)
    {
        //
    	$curso = Curso::findOrFail($id);
      return view("cursos.view", ["curso" => $curso]);
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
      return view("cursos.create", ["title" => "Edit","curso" => $curso,"url"=> "admin/cursos/{$id}/","method" => 'PATCH']);
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
        //
    	$curso = Curso::findOrFail($id);
    	$curso->fill($request->all());

    	if(input::hasFile('image')){
        $file = Input::file('image');
        $file->move(public_path().'/images/cursos/',$file->getClientOriginalName());
        $curso->foto = $file->getClientOriginalName();
      }

    	if($curso->save()){
        return redirect("admin/cursos")->with([
            'flash_message' => 'Curso editado correctamente.',
            'flash_class' => 'alert-success'
            ]);
    	}else{
        return view("admin/cursos")->with([
        		'title' => 'Editar',
        		'curso' => $curso,
        		'url'=> "admin/cursos/{$id}/",
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
        $curso = new Curso;
            if ($curso->destroy($id)) {
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
}
