<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Galeria;
use Illuminate\Support\Facades\Input;

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
        $cuadro = new Galeria;
        $cuadro->fill($request->all());

      if(input::hasFile('image')){
        $file = Input::file('image');
        $file->move(public_path().'/images/cuadros/',$file->getClientOriginalName());
        $cuadro->foto = $file->getClientOriginalName();
      }

      if($cuadro->save()){
          return redirect("admin/galeria")->with([
              'flash_message' => 'Cuadro agregado correctamente.',
              'flash_class' => 'alert-success'
              ]);
      }else{
          return view("admin/galeria")->with([
                'title' => 'Agregar',
                'cuadro' => $cuadro,
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
        //
    	$cuadro = Galeria::findOrFail($id);
    	$cuadro->fill($request->all());

    	if(input::hasFile('image')){
        $file = Input::file('image');
        $file->move(public_path().'/images/cuadros/',$file->getClientOriginalName());
        $cuadro->foto = $file->getClientOriginalName();
      }

    	if($cuadro->save()){
        return redirect("admin/galeria")->with([
            'flash_message' => 'Cuadro editado correctamente.',
            'flash_class' => 'alert-success'
            ]);
    	}else{
        return view("admin/galeria")->with([
        		'title' => 'Editar',
        		'cuadro' => $cuadro,
        		'url'=> "/galeria/{$id}/edit",
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
         $cuadro = new Galeria;
            if ($cuadro->destroy($id)) {
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
