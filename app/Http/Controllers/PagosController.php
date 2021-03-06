<?php

namespace App\Http\Controllers;

use App\Pago;
use App\Bitacora;
use App\Inscripcion;
use App\Estudiante;
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
      switch (Auth::user()->nivel){
      	case 1:
		      $pagos = Pago::all();
		      return view('pagos.index',['pagos'=>$pagos]);
    		break;
      	case 4:
		      $pagos = new Pago;
		      $estudiante = Estudiante::where('user_id',Auth::user()->id)->get()->first();
		      $pagos = $pagos->byEstudiante($estudiante->estudiante_id);
		      return view('panel.pagos.index',['pagos'=>$pagos]);
    		break;
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($inscripcion = NULL)
    {
    	$pagos = new Pago;
    	switch (Auth::user()->nivel){
    		case 1:
		      $pagados = Pago::select('inscripcion_id')->pluck('inscripcion_id')->toArray();
		      //Todas las inscripciones
		      $inscripciones = Inscripcion::all()->whereNotIn('inscripcion_id',$pagados);
		      //$inscripcion = Si viene de haber inscrito un estudiante a un curso
		      return view("pagos.create", ['inscripciones' => $inscripciones,'inscripcion'=>$inscripcion]);
  			break;
  			case 4:
  				$estudiante = Estudiante::where('user_id',Auth::user()->id)->get()->first();
		      $pagados = Pago::select('inscripcion_id')->where('status','1')->pluck('inscripcion_id')->toArray();
		      $inscripciones = Inscripcion::all()->where('estudiante_id',$estudiante->estudiante_id)->whereNotIn('inscripcion_id',$pagados);
		      $disabled = count($inscripciones)>0?'':'disabled';
		      return view("panel.pagos.create", ['inscripciones' => $inscripciones,'disabled'=>$disabled]);
				break;
    	}
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
        'inscripcion' => 'required',
        'fecha'       => 'required',
        'monto'       => 'required|numeric',
        'tipo'        => 'required',
        'banco'       => 'required_if:tipo,Transferencia|required_if:tipo,Deposito',
        'referencia'  => 'required_if:tipo,Transferencia|required_if:tipo,Deposito'
      ]);

    	$pago = new Pago;
    	$pago->inscripcion_id = $request->inscripcion;
    	$pago->fill($request->all());

    	if($pago->save()){
        //Registro en la bitacora
        $bitacora = New Bitacora;
        $bitacora->usuario = Auth::user()->email;
        $bitacora->modulo = 'Pagos';
        $bitacora->accion = 'Registro de pago monto '.$pago->monto;
        $bitacora->save();
        // fin bitacora
        $redirect = Auth::user()->nivel === 1?'admin/pagos':'panel/pagos';

        return redirect($redirect)->with([
            'flash_message' => 'Pago agregado correctamente.',
            'flash_class' => 'alert-success'
            ]);
    	}else{
        return redirect($redirect)->with([
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
      switch (Auth::user()->nivel) {
      	case 1:
		      $pago = Pago::findOrFail($id);
		      return view("pagos.show", ["pago" => $pago]);
    		break;
      	case 4:
		      $pago = Pago::findOrFail($id);
		      $status = "";
		      return view("panel.pagos.show", ["pago" => $pago,'status'=>$status]);
    		break;
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      switch (Auth::user()->nivel) {
      	case 1:
    			$pago = Pago::findOrFail($id);
		      $inscripciones = Inscripcion::all();
		      return view("pagos.modificar", ['pago' => $pago,'inscripciones' => $inscripciones]);
    		break;
      	case 4:
  				$estudiante = Estudiante::where('user_id',Auth::user()->id)->get()->first();
  				$pago = new Pago;
  				$pago = $pago->byEstudiante($estudiante->estudiante_id)->first();
		      return view("panel.pagos.edit", ['pago'=>$pago]);
      	break;
      }
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
    	switch (Auth::user()->nivel){
    		case 1:
    			$this->validate($request, [
		        'inscripcion' => 'required',
		        'fecha'       => 'required',
		        'monto'       => 'required|numeric',
		        'tipo'        => 'required',
		        'banco'       => 'required_if:tipo,Transferencia|required_if:tipo,Deposito',
		        'referencia'  => 'required_if:tipo,Transferencia|required_if:tipo,Deposito'
		      ]);
		      
		    	$pago = Pago::findOrFail($id);
		    	$pago->fill($request->all());
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
		            'flash_message' => 'Ha ocurrido un error.',
		            'flash_class' => 'alert-danger',
		            'flash_important' => true
		            ]);
		    	}
  			break;
  			case 4:
    			$this->validate($request, [
		        'fecha'       => 'required',
		        'monto'       => 'required|numeric',
		        'tipo'        => 'required',
		        'banco'       => 'required_if:tipo,Transferencia|required_if:tipo,Deposito',
		        'referencia'  => 'required_if:tipo,Transferencia|required_if:tipo,Deposito'
		      ]);
		      
		    	$pago = Pago::findOrFail($id);
		    	$pago->fill($request->all());
		    	if($pago->save()){
		        //Registro en la bitacora
		        $bitacora = New Bitacora;
		        $bitacora->usuario = Auth::user()->email;
		        $bitacora->modulo = 'Pagos';
		        $bitacora->accion = 'Se edito un pago de monto '.$pago->monto.' tipo: '.$pago->tipo;
		        $bitacora->save();
		        // fin bitacora
		        return redirect("panel/pagos")->with([
		            'flash_message' => 'Pago editado correctamente.',
		            'flash_class' => 'alert-success'
		            ]);
		    	}else{
		        return view("panel/pagos")->with([
		            'flash_message' => 'Ha ocurrido un error.',
		            'flash_class' => 'alert-danger',
		            'flash_important' => true
		            ]);
		    	}
  			break;
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
      //Pago::destroy($id);

    }

    public function busqueda()
    {
      return view('pagos.busqueda');
    }

    public function estado(Request $request,$id){
    	$pago = Pago::findOrFail($id);
    	$pago->fill($request->all());

    	if($pago->save()){
    		return redirect('admin/pagos')->with([
    				'flash_class' => 'alert-success',
    				'flash_message' => 'Estado cambiado correctamente.'
    			]);
    	}else{
    		return redirect('admin/pagos')->with([
    				'flash_class'     => 'alert-success',
    				'flash_message'   => 'Estado cambiado correctamente.',
    				'flash_important' => true
    			]);
    	}
    }
}
