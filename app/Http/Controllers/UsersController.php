<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Detalles;
use App\Bitacora;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$users = User::all();
    	return view('users/index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view("users.create");
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
          'password' => 'required|min:6|confirmed',
          'password_confirmation' => 'required|min:6|same:password'
          ]);

        $det = new Detalles;
        $det->fill($request->all());

        if($det->save()){
          $user = new User;
          $user->fill($request->all());
          $user->password = bcrypt($request->input('password'));
          $user->nivel = '1';

        	if($det->users()->save($user)){
                //Registro en la bitaora
                $bitacora = New Bitacora;
                $bitacora->usuario = Auth::user()->email;
                $bitacora->modulo = 'Usuarios';
                $bitacora->accion = 'Registro de usuario '.$user->email;
                $bitacora->save();
                // fin bitacora
                
            return redirect("admin/users")->with([
                'flash_message' => 'Usuario agregado correctamente.',
                'flash_class' => 'alert-success'
                ]);
        	}else{
            return redirect("admin/users")->with([
                'flash_message' => 'Ha ocurrido un error.',
                'flash_class' => 'alert-danger',
                'flash_important' => true
                ]);
        	}
        }else{
            return redirect("admin/users")->with([
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
      $user = user::findOrFail($id);
      return view("users.show", ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = user::findOrFail($id);
      return view("users.edit", ["user" => $user]);
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

      $user = User::findOrFail($id);

      $this->validate($request, [
        'nombres' => 'required',
        'apellidos' => 'required',
        'email' =>'required|email|unique:users,email,'.$user->email.',email',
        'cedula' => 'required|numeric|unique:detalles,cedula,'.$user->detalle_id.',detalle_id',
        'tlf_personal' => 'required|numeric',
        'tlf_local' => 'numeric'
        ]);

      $det = Detalles::find($user->detalle_id);
      $det->fill($request->all());
    	$user->fill($request->all());

    	if($det->save() && $user->save()){
             //Registro en la bitaora
                $bitacora = New Bitacora;
                $bitacora->usuario = Auth::user()->email;
                $bitacora->modulo = 'Usuarios';
                $bitacora->accion = 'Modifico el usuario '.$user->email;
                $bitacora->save();
                // fin bitacora
        return redirect("admin/users")->with([
            'flash_message' => 'Usuario editado correctamente.',
            'flash_class' => 'alert-success'
            ]);
    	}else{
        return redirect("admin/users")->with([
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

        $user = User::findOrFail($id);

             //Registro en la bitaora
                $bitacora = New Bitacora;
                $bitacora->usuario = Auth::user()->email;
                $bitacora->modulo = 'Usuarios';
                $bitacora->accion = 'Se elemino el usuario '.$user->email;
                $bitacora->save();
                // fin bitacora
        if($user->delete()){
        return redirect("admin/users")->with([
            'flash_message' => 'Usuario eliminado correctamente.',
            'flash_class' => 'alert-success'
            ]);
      }else{
        return redirect("admin/users")->with([
            'flash_message' => 'Ha ocurrido un error.',
            'flash_class' => 'alert-danger',
            'flash_important' => true
          ]);
      }
    }

    public function perfil(){
    	$perfil = User::findOrFail(Auth::user()->id);
    	switch (Auth::user()->nivel) {
    		case 1:
    			return view('perfil',['perfil'=>$perfil]);
  			break;
  			case 2:
  				return view('area/perfil',['perfil'=>$perfil]);
  			break;
  			case 4:
  				return view('panel/perfil',['perfil'=>$perfil]);
  			break;
    	}
    }

    public function update_perfil(Request $request)
    {
    	$user = User::find(Auth::user()->id);

      $this->validate($request, [
        'nombres' => 'required',
        'apellidos' => 'required',
        'email' =>'required|email|unique:users,email,'.$user->id.',id',
        'cedula' => 'required|numeric|unique:detalles,cedula,'.$user->detalle_id.',detalle_id',
        'tlf_personal' => 'required|numeric'
        ]);

      $det = Detalles::find($user->detalle_id);
      $det->fill($request->all());

    	$user->fill($request->all());

      if($request->input('checkbox') === "Yes"){
      	$this->validate($request,[
          'password' => 'required|min:6|max:15|confirmed',
          'password_confirmation' => 'required|min:6|max:15|same:password'
    		]);
  		$user->password = bcrypt($request->input('password'));
      }

      switch (Auth::user()->nivel) {
      	case 1: $url = 'admin/perfil'; break;
      	case 2: $url = 'area/perfil'; break;
      	case 4: $url = 'panel/perfil'; break;
      }

    	if($det->save() && $user->save()){
        return redirect($url)->with([
            'flash_message' => 'Cambios guardados correctamente.',
            'flash_class' => 'alert-success'
            ]);
    	}else{
        return redirect($url)->with([
            'flash_message' => 'Ha ocurrido un error.',
            'flash_class' => 'alert-danger',
            'flash_important' => true
          ]);
    	}
    }
}
