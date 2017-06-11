@extends('layouts.front')

@section('content')
	

		<div class="divider"></div>
		<div class="section_two_three">
			@foreach($cuadro as $cuadros)
		<div class="section_one_three image-border">
		  <h2>{{$cuadros->titulo}}</h2>
		  	<img src="{{asset('images/cuadros/'.$cuadros->foto)}}" alt="{{asset('images/cuadros/'.$cuadros->foto)}}" title="{{asset('images/cuadros/'.$cuadros->foto)}}"/>
		 <p><strong>{{$cuadros->descripcion}}</strong></p>

		</div>
	@endforeach
    </div>
@endsection