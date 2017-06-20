@extends('layouts.front')
@section('title','Galeria - '.config('app.name'))
@section('content')
	<div class="divider"></div>
		@foreach($cuadro as $cuadros)
		<div class="container-galeria">
	 		<div class="section_one_three">
		  	<div class="galeria-img">
		  		<img src="{{asset('images/cuadros/'.$cuadros->foto)}}" alt="{{asset('images/cuadros/'.$cuadros->titulo)}}" title="{{asset('images/cuadros/'.$cuadros->titulo)}}"/>
		  	</div>
		  	<h1>{{$cuadros->titulo}}</h1>
		 		<p>{{$cuadros->descripcion}}</p>
      </div>
		</div>
		@endforeach
  </div>
@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$("body").on("contextmenu", ".galeria-img,.galeria-img img", function(e) {
		  return false;
		});
		$('body').on('dragstart', ".galeria-img,.galeria-img img", function(e){
			//e.preventDefault();
			return false;
		});
	});
</script>
	
@endsection