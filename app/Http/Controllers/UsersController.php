<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
        //
    	$user = new User;
      return view("users.create", ["title" => "Agregar","user" => $user,"url" => "/users", "method" => "POST"]);
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
    	$user = new User;
    	$user->fill($request->all());
    	$user->password = bcrypt($request->input('password'));
    	$user->nivel = "A";
    	$user->estado = "A";
    	if($user->save()){
        return redirect("/users")->with([
            'flash_message' => 'Usuario agregado correctamente.',
            'flash_class' => 'alert-success'
            ]);
    	}else{
        return view("/users")->with([
        		'title' => "Agregar",
        		'user' => $user,
        		'url' => '/users',
        		'methos' => 'POST',
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
    	$user = user::findOrFail($id);
      return view("users.create", ["title" => "Editar","user" => $user,"url"=> "/users/{$id}/","method" => 'PATCH']);
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
    	$user = User::findOrFail($id);
    	$user->fill($request->all());
    	if($user->save()){
        return redirect("/users")->with([
            'flash_message' => 'Usuario editado correctamente.',
            'flash_class' => 'alert-success'
            ]);
    	}else{
        return view("/users")->with([
        		'title' => 'Editar',
        		'user' => $user,
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