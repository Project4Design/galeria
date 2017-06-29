@extends('layouts.front')
@section('content')
	<div class="section_full">
		<h1 class="welcome" style="text-align:center">¡BIENVIENIDOS!</h1>
		<center><img src="{{ asset('img/logo.png') }}" height="150px"></center>
	</div>

	<div class="section_full no_padding">
		<h2 class="subtitulos">Nuestros cursos</h2>
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
	</div>
	
	<div class="section_full no_padding">
		<h2 class="subtitulos">Nuestro profesores</h2>
		@foreach($profesores as $d)
			<div class="section_two_three">
				<div class="post">
					<div class="post_left">
		        <a href="#" class="post_image">
		        	<img src="{{ asset('images/profesores/'.$d->user->detalles->foto) }}" alt="" title="" />
		        </a>
		        <!--
		        <div class="post_date"><span>08</span><span>mar</span></div>
		        <div class="post_comments"><a href="#">03</a></div>
		        -->
		      </div>
		      <div class="post_right">
		      	<h3>{{$d->user->detalles->nombres.' '.$d->user->detalles->apellidos}}</h3>
		        <p>
		          {{$d->descripcion_perfil}}
		        </p>
		      </div>
		    </div>
		  </div>
		@endforeach
	</div>
@endsection