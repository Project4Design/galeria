<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Profesores;

class ProfesoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesores = Profesores::all();
        
        return view('profesores.index',['profesores' => $profesores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profesor = new Profesores;
      return view("profesores.create", ["title" => "Agregar","profesor" => $profesor,"url" => "admin/profesores", "method" => "POST"]);
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
        
        $this->validate($request, [

            'nombre' =>'required',
            'apellido' => 'required',
            'cedula' => 'numeric|required|unique:profesores',
            'foto' => 'required', 
            'profesion' => 'required',

            ]);
        
        $profesor = new Profesores;
        $profesor->fill($request->all());

      if(input::hasFile('foto')){
        $file = Input::file('foto');
        $file->move(public_path().'/images/profesores/',$file->getClientOriginalName());
        $profesor->foto = $file->getClientOriginalName();
      }

      if($profesor->save()){
          return redirect("admin/profesores")->with([
              'flash_message' => 'Profesor agregado correctamente.',
              'flash_class' => 'alert-success'
              ]);
      }else{
          return view("admin/profesores")->with([
                'title' => 'Agregar',
                'profesor' => $profesor,
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
        dd(Profesores::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profesor = Profesores::findOrFail($id);
      return view("profesores.create", ["title" => "Edit","profesor" => $profesor,"url"=> "admin/profesores/{$id}/","method" => 'PATCH']);
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
        $profesor = Profesores::findOrFail($id);
        $profesor->fill($request->all());

        if(input::hasFile('foto')){
        $file = Input::file('foto');
        $file->move(public_path().'/images/profesores/',$file->getClientOriginalName());
        $profesor->foto = $file->getClientOriginalName();
      }

        if($profesor->save()){
        return redirect("admin/profesores")->with([
            'flash_message' => 'Profesor editado correctamente.',
            'flash_class' => 'alert-success'
            ]);
        }else{
        return view("admin/profesores")->with([
                'title' => 'Editar',
                'profesor' => $profesor,
                'url'=> '/users/{$id}/',
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
