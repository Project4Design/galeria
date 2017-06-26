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
            {{ $curso->titulo }}
            <small class="pull-right">Registrado: {{ $curso->created_at }}</small>
            <span class="clearfix"></span>
          </h2>
	    	</div>
				<div class="col-md-4">
					<h4>Detalles del curso</h4>
					<p><b>Precio: </b> {{ number_format($curso->precio,2,",",".") }} </p>
					<p><b>Descripcion: </b> {{ $curso->descripcion }} </p>
				</div>
				<div class="col-md-3">
					<h4>Imagen del curso</h4>
					<img class="img-responsive" src="{{ asset('/images/cursos/'.$curso->foto) }}">
				</div>

        <div class="col-md-4 col-md-offset-1">
          <h4>Profesor</h4>
          <p><b>Nombre:</b> {{$curso->profesor->user->detalles->nombres.' '.$curso->profesor->user->detalles->apellidos}}</p>
          <p><b>Profesion: </b> {{$curso->profesor->profesion}}</p>
          <p><b>Foto: </b> <img style="max-height: 150px" class="img-responsive" src="{{ asset('/images/profesores/'.$curso->profesor->user->detalles->foto) }}"></p>
        </div>
			</div>
		</section>

		
@endsection