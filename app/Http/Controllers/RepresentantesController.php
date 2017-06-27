<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Representante;
use App\User;
use App\Detalles;

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
      return view("representantes.create", ["representante" => $representante]);
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
        'email' =>'required|email|unique:users',
        'nombres' => 'required',
        'apellidos' => 'required',
        'cedula' => 'required|numeric|unique:detalles',
        'tlf_personal'=> 'required|numeric',
        'tlf_local'=> 'nullable|numeric',
        'residencia' => 'required',
        'foto' => 'required|image'
      ]);

    		$det = new Detalles;
        $det->fill($request->all());

        if(input::hasFile('foto')){
          $file = Input::file('foto');
          $file->move(public_path().'/images/representantes/',$file->getClientOriginalName());
          $det->foto = $file->getClientOriginalName();
        }

        if($det->save()){
          $user = new User;
          $user->fill($request->all());
          $user->password = bcrypt($request->input('password'));
          $user->nivel = '3';

          if($det->users()->save($user)){
            $representante = new Representante;
            $representante->fill($request->all());

            if($user->representante()->save($representante)){
                return redirect("admin/representantes")->with([
                    'flash_message' => 'Profesor agregado correctamente.',
                    'flash_class' => 'alert-success'
                    ]);
            }else{
                return redirect("admin/representantes")->with([
                    'flash_message' => 'Ha ocurrido un error.',
                    'flash_class' => 'alert-danger',
                    'flash_important' => true
                    ]);
            }
          }
        }else{
          return redirect("admin/representantes")->with([
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
    	$representante = representante::findOrFail($id);
      return view("representantes.edit", ["representante" => $representante]);
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
    	$representante = Representante::findOrFail($id);
        
      $this->validate($request, [
        'email' =>'required|email|unique:users,email,'.$representante->user->id.',id',
        'nombres' => 'required',
        'apellidos' => 'required',
        'cedula' => 'required|numeric|unique:detalles,cedula,'.$representante->user->detalle_id.',detalle_id',
        'tlf_personal'=> 'required|numeric',
        'tlf_local'=> 'nullable|numeric',
        'residencia' => 'required',
        'foto' => 'nullable|image'
      ]);

      $det = Detalles::find($representante->user->detalle_id);
      $det->fill($request->all());

    	if(input::hasFile('foto')){
        $file = Input::file('foto');
        $file->move(public_path().'/images/representantes/',$file->getClientOriginalName());
        $det->foto = $file->getClientOriginalName();
      }

    	if($det->save()){
        $user = User::find($representante->user_id);
        $user->fill($request->all());
    		$representante->fill($request->all());

    		if($det->users()->save($user) && $user->representante()->save($representante)){
	        return redirect("admin/representantes")->with([
	            'flash_message' => 'Representante editado correctamente.',
	            'flash_class' => 'alert-success'
	          ]);
    		}else{
    			return view("admin/representantes")->with([
            'flash_message' => 'Ha ocurrido un error.',
            'flash_class' => 'alert-danger',
            'flash_important' => true
          ]);
    		}
    	}else{
        return view("admin/representantes")->with([
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
