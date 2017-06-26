<?php

namespace App\Http\Controllers;

use App\Pago;
use App\Bitacora;
use App\Inscripcion;
use Illuminate\Support\Facades\Auth;
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
      return view('pagos.index',['pagos'=>$pagos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$pagos = new Pago;

        $pagados = Pago::select('inscripcion_id')->pluck('inscripcion_id')->toArray();
        $inscripciones = Inscripcion::all()->whereNotIn('inscripcion_id',$pagados);
      return view("pagos.create", ['inscripciones' => $inscripciones]);
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
          'inscripcion_id' => 'required',
          'fecha' => 'required',
          'monto' => 'required|numeric',
          'tipo' => 'required',
        ]);

    	$pago = new Pago;
    	$pago->fill($request->all());

        if ($request->input('banco') != '' && $request->input('referencia') != '' ) {
            $pago->banco = $request->input('banco');
            $pago->referencia = $request->input('referencia');
        }

    	if($pago->save()){
            //Registro en la bitacora
                $bitacora = New Bitacora;
                $bitacora->usuario = Auth::user()->email;
                $bitacora->modulo = 'Pagos';
                $bitacora->accion = 'Registro de pago monto '.$pago->monto;
                $bitacora->save();
                // fin bitacora
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
    public function show($id)
    {
      $pago = Pago::findOrFail($id);
      
      return view("pagos.show", ["pago" => $pago]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$pago = Pago::findOrFail($id);
        $inscripciones = Inscripcion::all();
      return view("pagos.modificar", ['pago' => $pago,'inscripciones' => $inscripciones]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
      //
    	$pago = Pago::findOrFail($id);
    	$pago->fill($request->all());
        if ($request->input('banco') != '' && $request->input('referencia') != '' ) {
            $pago->banco = $request->input('banco');
            $pago->referencia = $request->input('referencia');
        }

    	if($pago->save()){
            //Registro en la bitacora
                $bitacora = New Bitacora;
                $bitacora->usuario = Auth::user()->email;
                $bitacora->modulo = 'Pagos';
                $bitacora->accion = 'Se edito un pago de monto '.$pago->monto.' tipo: '.$pago->tipo;
                $bitacora->save();
                // fin bitacora
        return redirect("admin/pagos")->with([
            'flash_message' => 'Pago editado correctamente.',
            'flash_class' => 'alert-success'
            ]);
    	}else{
        return view("admin/pagos")->with([
        		'title' => 'Editar',
        		'pago' => $pago,
        		'url'=> "admin/pagos/{$pago}/",
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
