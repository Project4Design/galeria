@extends('layouts.app')
@section('title','Cursos - '.config('app.name'))
@section('header','Cursos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li> Cursos </li>
	  <li class="active"> Ver </li>
	</ol>
@endsection
@section('content')
<!-- Formulario -->
		<section>
	    <a class="btn btn-flat btn-default" href="{{ url('panel/dashboard') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
		</section>

		<section class="perfil">
			<div class="row">
	    	<div class="col-md-12">
	    		<h2 class="page-header" style="margin-top:0!important">
            <i class="fa fa-university" aria-hidden="true"></i>
            {{ $inscripcion->curso->titulo }} | Periodo : {{$inscripcion->periodo->periodo}}
            <small class="pull-right">Inscrito: {{ $inscripcion->created_at }}</small>
            <span class="clearfix"></span>
          </h2>
	    	</div>
				<div class="col-md-4">
					<h4>Detalles del curso</h4>
					<p><b>Titulo:</b> {{$inscripcion->curso->titulo}}</p>
					<p><b>Descripcion: </b> {{ $inscripcion->curso->descripcion }} </p>
					<p><b>NOTA: {!! $inscripcion->nota->nota?'<span style="color:#B30101;font-size:150%;">'.$inscripcion->nota->nota.'</span>':'-' !!}</b> </p>
				</div>

        <div class="col-md-4 col-md-offset-1">
          <h4>Profesor</h4>
          <p><b>Nombre:</b> {{$inscripcion->curso->profesor->user->detalles->nombres.' '.$inscripcion->curso->profesor->user->detalles->apellidos}}</p>
          <p><b>Profesion: </b> {{$inscripcion->curso->profesor->profesion}}</p>
          <p><b>Telefono: </b> {{$inscripcion->curso->profesor->user->detalles->tlf_personal}}</p>
        </div>
			</div>
		</section>
@endsection