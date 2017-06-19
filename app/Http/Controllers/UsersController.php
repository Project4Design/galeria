<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Detalles;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
          'password' => 'required|min:6|max:15|confirmed',
          'password_confirmation' => 'required|min:6|max:15|same:password'
          ]);

        $det = new Detalles;
        $det->fill($request->all());

        if($det->save()){
          $user = new User;
          $user->fill($request->all());
          $user->password = bcrypt($request->input('password'));
          $user->nivel = '1';

        	if($det->users()->save($user)){
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
        'email' =>'required|email|unique:users',
        'cedula' => 'required|numeric|unique:detalles,cedula,'.$user->detalle_id.',detalle_id',
        'tlf_personal' => 'required|numeric',
        'tlf_local' => 'numeric'
        ]);

      $det = Detalles::find($user->detalle_id);
      $det->fill($request->all());
    	$user->fill($request->all());

    	if($det->save() && $user->save()){
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
        if(User::destroy($id)){
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
    	return view('perfil',['perfil'=>$perfil]);
    }
}
