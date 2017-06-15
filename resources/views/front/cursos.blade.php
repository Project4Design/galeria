@extends('layouts.front')
@section('title','Cursos - '.config('app.name'))
@section('content')
	@foreach($cursos as $d)
		<div class="section_one_three image-border">
		  <h2>{{$d->titulo}}</h2>
		  
		  <a href="{{url('cursos/'.$d->curso_id)}}" rel="prettyPhoto[gallery]" title="">
		  	<img src="{{asset('images/cursos/'.$d->foto)}}" alt="{{asset('images/cursos/'.$d->foto)}}" title="{{asset('images/cursos/'.$d->foto)}}"/>
		  </a>
		 <p>{{$d->descripcion}}</p>
		  <a id="open" href="{{url('cursos/'.$d->curso_id)}}" class="more">Ver mas</a>
		</div>
	@endforeach
	
@endsection