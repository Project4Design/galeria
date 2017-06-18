<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Estudiante;
use App\Representante;
use App\Detalles;
use App\User;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
      $estudiantes = Estudiante::all();
    	return view('estudiantes.index',['estudiantes'=>$estudiantes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $estudiante = new Estudiante;
      return view("estudiantes.create", ["estudiante" => $estudiante]);
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
    		'foto' => 'required|image',
    		'nombres' => 'required',
    		'apellidos' => 'required',
    		'cedula' => 'required|numeric|unique:detalles',
    		'sexo' => 'required',
    		'nacimiento' => 'required',
    		'residencia' => 'required',
    		'email' =>'required|email|unique:users',
    		'alergico' => 'required|numeric',
    		'tlf_personal' => 'required|numeric',
    		'tlf_local' => 'numeric'
    	]);

    	//Calculamos si el estudiante es menor de edad
      $hoy = date('d-m-Y'); $xhoy = explode('-',$hoy);
      $dob = $request->input('nacimiento'); $xdob = explode('-',$dob);
      $edad = $xhoy[2] - $xdob[2]; $mes  = $xhoy[1] - $xdob[1];
	    if ($mes < 0 || ($mes === 0 && $xhoy[0] < $xdob[0])) {
	    	$edad--;
	    }

	    if($edad<18){
	    	$this->validate($request,[
	    		'representante_foto' => 'required|image',
	    		'representante_nombres' => 'required',
	    		'representante_apellidos' => 'required',
	    		'representante_cedula' => 'required|numeric|unique:detalles,cedula',
	    		'representante_residencia' => 'required',
	    		'representante_email' =>'required|email|unique:users,email',
	    		'representante_tlf_personal' => 'required|numeric',
	    		'representante_tlf_local' => 'numeric'
	    		]);

	    	$rep = new Detalles;
	    	$rep->nombres = $request->input('representante_nombres');
	    	$rep->apellidos = $request->input('representante_apellidos');
	    	$rep->cedula = $request->input('representante_cedula');
	    	$rep->tlf_personal = $request->input('representante_tlf_personal');
	    	$rep->tlf_local = $request->input('representante_tlf_local');
	    	//Foto
	    	$file = Input::file('representante_foto');
        $file->move(public_path().'/images/representantes/',$file->getClientOriginalName());
        $rep->foto = $file->getClientOriginalName();

        if($rep->save()){
        	$r_user = new User;
        	$r_user->email = $request->input('representante_email');
	        $r_user->password = bcrypt($request->input('123456'));
	        $r_user->nivel = '3';
		      $representante = new Representante;
		      $representante->residencia = $request->input('representante_residencia');

		      $rep->users()->save($r_user);
		      $rep_id = $r_user->representante()->save($representante);
		      $rep_id = $rep_id->representante_id;
        }
	    }

    	$det = new Detalles;
      $det->fill($request->all());

      if(input::hasFile('foto')){
        $file = Input::file('foto');
        $file->move(public_path().'/images/estudiantes/',$file->getClientOriginalName());
        $det->foto = $file->getClientOriginalName();
      }

      if($det->save()){
        $user = new User;
        $user->fill($request->all());
        $user->password = bcrypt($request->input('123456'));
        $user->nivel = '4';
	      $estudiante = new Estudiante;
	      $estudiante->fill($request->all());

	      if($edad<18){ $estudiante->representante_id = $rep_id; }

        if($det->users()->save($user)){

        	if($user->estudiante()->save($estudiante)){
	        	return redirect("admin/estudiantes")->with([
	              'flash_message' => 'Estudiante agregado correctamente.',
	              'flash_class' => 'alert-success'
	            ]);
	        }else{
	        	return view("admin/estudiantes")->with([
              'flash_message' => 'Ha ocurrido un error.',
              'flash_class' => 'alert-danger',
              'flash_important' => true
       	  	]);
	        }
	      }else{
          return view("admin/estudiantes")->with([
              'flash_message' => 'Ha ocurrido un error.',
              'flash_class' => 'alert-danger',
              'flash_important' => true
       	  	]);
	      }
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
      $estudiante = Estudiante::findOrFail($id);
      $cursos = array();

      return view('estudiantes.view',['estudiante'=>$estudiante,'cursos'=>$cursos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estudiante = Estudiante::findOrFail($id);
      return view("estudiantes.edit", ["estudiante" => $estudiante]);
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
        $estudiante = Estudiante::findOrFail($id);

        $this->validate($request, [
	    		'foto' => 'image',
	    		'nombres' => 'required',
	    		'apellidos' => 'required',
	    		'cedula' => 'required|numeric|unique:detalles,cedula,'.$estudiante->user->detalle_id.',detalle_id',
	    		'sexo' => 'required',
	    		'nacimiento' => 'required',
	    		'residencia' => 'required',
	    		'email' =>'required|email|unique:users,email,'.$estudiante->user_id.',id',
	    		'alergico' => 'required',
	    		'tlf_personal' => 'required|numeric',
	    		'tlf_local' => 'numeric'
        ]);

        $det = Detalles::find($estudiante->user->detalle_id);
        $det->fill($request->all());

        if(input::hasFile('foto')){
          $file = Input::file('foto');
          $file->move(public_path().'/images/estudiantes/',$file->getClientOriginalName());
          $det->foto = $file->getClientOriginalName();
        }

        if($det->save()){
          $user = User::find($estudiante->user_id);
          $user->fill($request->all());
          $estudiante->fill($request->all());

          if($det->users()->save($user) && $user->estudiante()->save($estudiante)){
                return redirect("admin/estudiantes")->with([
                    'flash_message' => 'Profesor editado correctamente.',
                    'flash_class' => 'alert-success'
                    ]);
          }else{
              return redirect("admin/estudiantes")->with([
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
        //
    }
}
