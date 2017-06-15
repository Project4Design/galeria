@extends('layouts.front')
@section('title',$curso->titulo.' - '.config('app.name'))
@section('content')
<div class="section_full">
  <h1 style="text-align:center">{{$curso->titulo}}</h1>
  <div class="curso-img-container">
  	<img src="{{asset('images/cursos/'.$curso->foto)}}" alt="{{asset('images/cursos/'.$curso->foto)}}" title="{{asset('images/cursos/'.$curso->foto)}}"/>
  </div>
  <br><br><br><br>
</div>
<div class="section_full" style="border-top:2px solid #ccc">
	<div class="section_one_three profile">
		<h2>Profesor</h2>
		<div class="profile_picture_container">
			<img class="profile_picture" src="{{asset('images/profesores/'.$curso->profesor->foto)}}">
		</div>
		<h3>{{$curso->profesor->nombre." ".$curso->profesor->apellido}}</h3>
		<p class="profesion">{{$curso->profesor->profesion}}</p>
		<ul class="profile_detalles">
			<li><b>Correo:</b> <span class="pull-right">{{ $curso->profesor->email }}</span></li>
			<li><b>Telefono: </b><span class="pull-right">{{ $curso->profesor->telefono }}</span></li>
			<li><b>Correo: </b><span class="pull-right">{{ $curso->profesor->email }}</span></li>
		</ul>
	</div>
	<div class="section_two_three">
		<h2 style="text-align:center">Descripci&oacute;n</h2>
		<p>{{$curso->descripcion}}</p>
	</div>
</div>
	
@endsection