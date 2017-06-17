<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Profesores;
use App\Detalles;
use App\User;

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
      return view("profesores.create", ["profesor" => $profesor]);
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
          'nombres' => 'required',
          'apellidos' => 'required',
          'email' =>'required|email|unique:users',
          'cedula' => 'required|numeric|unique:detalles',
          'tlf_personal' => 'required|numeric',
          'tlf_local' => 'numeric',
          'direccion' => 'required',
          'profesion' => 'required',
          'descripcion_perfil' => 'required',
          'password' => 'required|min:6|max:15|confirmed',
          'password_confirmation' => 'required|min:6|max:15|same:password',
          'foto' => 'required|image'
          ]);

        $det = new Detalles;
        $det->fill($request->all());

        if(input::hasFile('foto')){
          $file = Input::file('foto');
          $file->move(public_path().'/images/profesores/',$file->getClientOriginalName());
          $det->foto = $file->getClientOriginalName();
        }

        if($det->save()){
          $user = new User;
          $user->fill($request->all());
          $user->password = bcrypt($request->input('password'));
          $user->nivel = '2';

          if($det->users()->save($user)){
            $profesor = new Profesores;
            $profesor->fill($request->all());

            if($user->profesor()->save($profesor)){
                return redirect("admin/profesores")->with([
                    'flash_message' => 'Profesor agregado correctamente.',
                    'flash_class' => 'alert-success'
                    ]);
            }else{
                return redirect("admin/profesores")->with([
                    'flash_message' => 'Ha ocurrido un error.',
                    'flash_class' => 'alert-danger',
                    'flash_important' => true
                    ]);
            }
          }
        }else{
          return redirect("admin/profesores")->with([
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
      $profesor = Profesores::findOrFail($id);
      $cursos = $profesor->cursos()->get();

      return view('profesores.view',['profesor'=>$profesor,'cursos'=>$cursos]);
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
      return view("profesores.edit", ["profesor" => $profesor]);
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

        $this->validate($request, [
          'nombres' => 'required',
          'apellidos' => 'required',
          'email' =>'required|email|unique:users',
          'cedula' => 'required|numeric|unique:detalles',
          'tlf_personal' => 'required|numeric',
          'tlf_local' => 'numeric',
          'direccion' => 'required',
          'profesion' => 'required',
          'descripcion_perfil' => 'required',
          'foto' => 'required|image'
          ]);

        $det = Detalles::find($profesor->user->detalle_id);
        $det->fill($request->all());

        if(input::hasFile('foto')){
          $file = Input::file('foto');
          $file->move(public_path().'/images/profesores/',$file->getClientOriginalName());
          $det->foto = $file->getClientOriginalName();
        }

        if($det->save()){
          $user = User::find($profesor->user_id);
          $user->fill($request->all());
          $profesor->fill($request->all());

          if($det->users()->save($user) && $user->profesor()->save($profesor)){
                return redirect("admin/profesores")->with([
                    'flash_message' => 'Profesor editado correctamente.',
                    'flash_class' => 'alert-success'
                    ]);
          }else{
              return redirect("admin/profesores")->with([
                  'flash_message' => 'Ha ocurrido un error.',
                  'flash_class' => 'alert-danger',
                  'flash_important' => true
                  ]);
          }
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
        $profesores = Profesores::findOrFail($id);
        $cursos = $profesores->cursos()->count();
        //dd($cursos);
        if($cursos > 0)
        {
            $with = [
            'flash_message' => 'Este profesor tiene cursos asociados , no se puede eliminar!',
            'flash_class' => 'alert-danger'];
        }else{

            if($profesores->destroy($id))
            {
                $with = [
                'flash_message' => 'Se Elimino correctamente!',
                'flash_class' => 'alert-danger'];
            }else{
                $with = [
                'flash_message' => 'Ocurrio un error inesperado!',
                'flash_class' => 'alert-danger'];
            }
            
        }
        return redirect()->route('profesores.index')->with($with);
    }
}
