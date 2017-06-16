<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Representante;

class RepresentantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    	$representantes = Representante::all();

    	return view('representantes.index',['representantes'=>$representantes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$representante = new Representante;
      return view("representantes.create", ["title" => "Agregar","representante" => $representante,"url" => "admin/representantes", "method" => "POST"]);
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
          'email' =>'required|email|unique:representantes',
          'nombres' => 'required',
          'apellidos' => 'required',
          'cedula' => 'required|max:10|unique:representantes',
          'tlf_personal'=> 'required|numeric',
          'tlf_local'=> 'required|numeric',
          'foto' => 'required|image'
        ]);

    	$representante = new Representante;
    	$representante->fill($request->all());

    	if(input::hasFile('foto')){
        $file = Input::file('foto');
        $file->move(public_path().'/images/representantes/',$file->getClientOriginalName());
        $representante->foto = $file->getClientOriginalName();
      }

    	if($representante->save()){
        return redirect("admin/representantes")->with([
            'flash_message' => 'Representante agregado correctamente.',
            'flash_class' => 'alert-success'
            ]);
    	}else{
        return view("admin/representantes")->with([
        		'title' => "Agregar",
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
       $representante = representante::findOrFail($id);
       $estudiantes = $representante->estudiantes()->get();
       return view("representantes.view", ["representante" => $representante,'estudiantes'=>$estudiantes]);
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
    	$representante = representante::findOrFail($id);
      return view("representantes.create", ["title" => "Editar","representante" => $representante,"url"=> "admin/representantes/{$id}/","method" => 'PATCH']);
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
          'email' =>'required|email|unique:representantes,email,'.$id.',representante_id',
          'nombres' => 'required',
          'apellidos' => 'required',
          'cedula' => 'required|numeric|unique:representantes,cedula,'.$id.',representante_id',
          'tlf_personal'=> 'required|numeric',
          'tlf_local'=> 'required|numeric'
        ]);

    	$representante = Representante::findOrFail($id);
    	$representante->fill($request->all());

    	if(input::hasFile('foto')){
            $file = Input::file('foto');
            $file->move(public_path().'/images/representantes/',$file->getClientOriginalName());
            $representante->foto = $file->getClientOriginalName();
        }

    	if($representante->save()){
        return redirect("admin/representantes")->with([
            'flash_message' => 'Representante editado correctamente.',
            'flash_class' => 'alert-success'
            ]);
    	}else{
        return view("admin/representantes")->with([
    		'title' => 'Editar',
    		'representante' => $representante,
    		'url'=> "admin/representantes/{$id}/",
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
        //Representante::destroy($id);

        $representante = Representante::findOrFail($id);

        if(count($representante->estudiantes) === 0){
            if($representante->destroy($id)){
                return redirect("admin/representantes")->with([
                   'flash_message' => 'El representante se ha eliminado correctamente.',
                   'flash_class' => 'alert-success'
                ]);
            }else{
                return redirect("admin/representantes")->with([
                    'flash_message' => '¡Ha ocurrido un error!',
                    'flash_class' => 'alert-danger',
                    'flash_important' => true
                ]);
            }
        }else{
            return redirect("admin/representantes")->with([
                'flash_message' => '¡Este representante tiene estudiantes registrados!',
                'flash_class' => 'alert-danger',
                'flash_important' => true
            ]);

        }
    }
}
