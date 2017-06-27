<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Galeria;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Bitacora;

class GaleriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuadros = Galeria::all();
        return view('galerias.index',['cuadros' => $cuadros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $cuadro = new Galeria;
      return view("galerias.create", ["title" => "Agregar","cuadro" => $cuadro,"url" => "admin/galeria", "method" => "POST"]);
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
    		'image'=>'required|image',
    		'titulo' => 'required',
        'autor' => 'required',
        'anio' => 'required|numeric',
        'descripcion' => 'required'
    	]);

      $cuadro = new Galeria;
      $cuadro->fill($request->all());

      if(input::hasFile('image')){
        $file = Input::file('image');
        $file->move(public_path().'/images/cuadros/',$file->getClientOriginalName());
        $cuadro->foto = $file->getClientOriginalName();
      }

      if($cuadro->save()){
        //Registro en la bitacora
        $bitacora = New Bitacora;
        $bitacora->usuario = Auth::user()->email;
        $bitacora->modulo = 'Galeria';
        $bitacora->accion = 'Se registro el cuadro '.$cuadro->titulo;
        $bitacora->save();
        // fin bitacora
        
          return redirect("admin/galeria")->with([
              'flash_message' => 'Cuadro agregado correctamente.',
              'flash_class' => 'alert-success'
              ]);
      }else{
          return view("admin/galeria")->with([
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
        $cuadro = Galeria::findOrFail($id);

        return view('galerias.view',['cuadro' => $cuadro]);
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
    	$cuadro = Galeria::find($id);
      return view("galerias.create", ["title" => "Editar","cuadro" => $cuadro,"url" => "admin/galeria/{$id}/", "method" => "PATCH"]);
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
      $this->validate($request,[
        'image'=>'nullable|image',
        'titulo' => 'required',
        'autor' => 'required',
        'anio' => 'required|numeric',
        'descripcion' => 'required'
      ]);
        
    	$cuadro = Galeria::findOrFail($id);
    	$cuadro->fill($request->all());

    	if(input::hasFile('image')){
        unlink(public_path().'/images/cuadros/'.$cuadro->foto);//Borrar imagen de local storage "Public"
        $file = Input::file('image');
        $file->move(public_path().'/images/cuadros/',$file->getClientOriginalName());
        $cuadro->foto = $file->getClientOriginalName();
      }

    	if($cuadro->save()){
        //Registro en la bitacora
        $bitacora = New Bitacora;
        $bitacora->usuario = Auth::user()->email;
        $bitacora->modulo = 'Galeria';
        $bitacora->accion = 'Se modifico el cuadro '.$cuadro->titulo;
        $bitacora->save();
        // fin bitacora
        return redirect("admin/galeria")->with([
            'flash_message' => 'Cuadro editado correctamente.',
            'flash_class' => 'alert-success'
            ]);
    	}else{
        return view("admin/galeria")->with([
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
        $cuadro = Galeria::findOrFail($id);
        if($cuadro->delete()){
		        //Registro en la bitacora
		        $bitacora = New Bitacora;
		        $bitacora->usuario = Auth::user()->email;
		        $bitacora->modulo = 'Galeria';
		        $bitacora->accion = 'Se elimino el cuadro '.$cuadro->titulo;
		        $bitacora->save();
		        // fin bitacora
        		unlink(public_path().'/images/cuadros/'.$cuadro->foto);//Borrar imagen de local storage "Public"
            return redirect("admin/galeria")->with([
               'flash_message' => 'Cuadro se ha eliminado correctamente.',
               'flash_class' => 'alert-success'
            ]);
        }else{
            return redirect("admin/galeria")->with([
                'flash_message' => '¡Ha ocurrido un error!',
                'flash_class' => 'alert-danger'
            ]);
        }
    }
}
