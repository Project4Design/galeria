<?php

namespace App\Http\Controllers;

use App\Pago;
use Illuminate\Http\Request;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
      $pagos = Pago::all();
      return view('pago.index',['pagos'=>$pagos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$pagos = new Pago;
      return view("pagos.create", ["title" => "Agregar","pago" => $pago,"url" => "admin/pagos", "method" => "POST"]);
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
          'inscripcion_id' => 'required',
          'metodo' =>'required',
          'fecha' => 'required',
          'banco' => 'required',
          'referencia' => 'required|numeric',
          'monto' => 'required|numeric',
        ]);

    	$pago = new Pago;
    	$pago->fill($request->all());

    	if($representante->save()){
        return redirect("admin/pagos")->with([
            'flash_message' => 'Pago agregado correctamente.',
            'flash_class' => 'alert-success'
            ]);
    	}else{
        return view("admin/pagos")->with([
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
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
      $pago = Pago::findOrFail($id);
      return view("pagos.view", ["pago" => $pago]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
    	$pago = Pago::findOrFail($id);
      return view("pagos.create", ["title" => "Editar","pago" => $pago,"url"=> "admin/pagos/{$id}/","method" => 'PATCH']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
      //
    	$pago = Pago::findOrFail($id);
    	$pago->fill($request->all());

    	if($pago->save()){
        return redirect("admin/pagos")->with([
            'flash_message' => 'Pago editado correctamente.',
            'flash_class' => 'alert-success'
            ]);
    	}else{
        return view("admin/pagos")->with([
        		'title' => 'Editar',
        		'pago' => $pago,
        		'url'=> "admin/pagos/{$id}/",
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
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
      Pago::destroy($id);
    }
}
