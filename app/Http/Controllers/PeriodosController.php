<?php

namespace App\Http\Controllers;

use App\Periodo;
use App\Inscripcion;
use Illuminate\Http\Request;

class PeriodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $periodos = Periodo::All();
      return view('periodos.index',['periodos'=>$periodos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $periodo = new Periodo;

      return view("periodos.create", ["title" => "Agregar","periodo" => $periodo,"url" => "admin/periodos", "method" => "POST"]);
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
        'periodo' => 'required',
        'status' => 'required'
      ]);

      $periodo = new Periodo;
      $periodo->fill($request->all());

      if($periodo->save()){
          return redirect("admin/periodos")->with([
              'flash_message' => 'Periodo agregado correctamente.',
              'flash_class' => 'alert-success'
              ]);
      }else{
          return view("admin/periodos")->with([
              'title' => 'Agregar',
              'periodo' => $periodo,
              'url'=> 'admin/periodos',
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
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $periodo = Periodo::findOrFail($id);
      $cursos = $periodo->cursosPeriodo();
      $estudiantes = $periodo->estudiantesPeriodo();
      return view('periodos.view',['periodo'=>$periodo,'cursos'=>$cursos,'estudiantes'=>$estudiantes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function edit($periodo)
    {
      $p = Periodo::findOrFail($periodo);
      return view("periodos.create", ["title" => "Editar","periodo" => $p,"url"=> "admin/periodos/{$periodo}/","method" => 'PATCH']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $periodo)
    {
      $this->validate($request,[
        'periodo' => 'required',
        'status' => 'required'
      ]);
      
        $periodo = Periodo::findOrFail($periodo);
        $periodo->fill($request->all());

        if($periodo->save()){
          return redirect("admin/periodos")->with([
            'flash_message' => 'Periodo editado correctamente.',
            'flash_class' => 'alert-success'
            ]);
        }else{
          return view("admin/periodos")->with([
            'flash_message' => 'Ha ocurrido un error.',
            'flash_class' => 'alert-danger',
            'flash_important' => true
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periodo = Periodo::findOrFail($id);

        if($periodo->destroy($id)){
            return redirect("admin/periodos")->with([
               'flash_message' => 'El periodo se ha eliminado correctamente.',
               'flash_class' => 'alert-success'
            ]);
        }else{
            return redirect("admin/periodos/{$id}")->with([
                'flash_message' => '¡Ha ocurrido un error!',
                'flash_class' => 'alert-danger'
            ]);
        }
    }

    public function cerrar($id)
    {
      $periodo = Periodo::findOrFail($id);
      $periodo->status = 0;

      if($periodo->save()){
        return redirect("admin/periodos")->with([
          'flash_message' => 'El periodo ha sido cerrado.',
          'flash_class' => 'alert-success'
          ]);
      }else{
        return view("admin/periodos")->with([
          'flash_message' => 'Ha ocurrido un error.',
          'flash_class' => 'alert-danger',
          'flash_important' => true
          ]);
      }
    }
}