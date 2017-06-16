@extends('layouts.app')
@section('title','Periodos - '.config('app.name'))
@section('header','Periodos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li> Periodos </li>
	  <li class="active"> {{$title}} </li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form class="" action="{{ url($url) }}" method="POST" enctype="multipart/form-data">
					{{ method_field( $method ) }}
					{{ csrf_field() }}
					<h4>{{ $title }} Periodo</h4>

         	<div class="form-group {{ $errors->has('periodo')?'has-error':'' }}">
						<label class="control-label" for="periodo">Periodo:</label>
						<input id="periodo" class="form-control" type="text" name="periodo" value="{{ old('periodo')?old('periodo'):$periodo->periodo }}" placeholder="Periodo">
					</div>

					<div class="form-group {{ $errors->has('status')?'has-error':'' }}">
						<label class="control-label" for="status">Status:</label>
						<select id="status" class="form-control" type="text" name="status">
							<option value="">Seleccione...</option>
							<option value="1" @if(old('status')) {{old('status')}} @else {{$periodo->status === 1?'selected':''}} @endif>Abierto</option>
							<option value="0" @if(old('status')) {{old('status')}} @else {{$periodo->status === 0?'selected':''}} @endif>Cerrado</option>
						</select>
					</div>

					@if(count($errors)>0)
						<div class="alert alert-danger">
			        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			        <strong class="text-center">Debe completar todos los campos requireridos</strong> 
			    	</div>
					@endif

					<div class="form-group text-right">
						<a class="btn btn-flat btn-default" href="{{route('periodos.index')}}"><i class="fa fa-reply"></i> Atras</a>
						<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
					</div>
				</form>
			</div>
		</div>
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			console.log("script cargado");
			$('#file').change(preview);	
		});
		
		function preview(){
	    //Id del input
	    var input = this.id;
	    //El archivo
	    var file  = this.files[0];
	    //Tippo de archivo
	    var type  = file.type;
	    //Contar errores
	    var error = 0;
	    //Imagen
	    var img   = $('#img');
	    //Imagen anterior
	    var prev  = img.attr("src");
	    //Imagen loading
	    var load = $(".spinner-image");
	    //Guardar imagen anterior
	    img.attr('prev',prev);
	    //Ocultar imagen
	    img.hide();
	    //Mostar cargando
	    load.show();
	    if(file){
	      if(file.size<2000000){
	        if(type == "image/jpeg" || type == "image/png" || type == "image/jpg"){
	          var reader = new FileReader();
	          reader.onload = function (e) {
	            img.attr('src', e.target.result);
	            load.hide();
	          img.show('slow');
	          }
	          reader.readAsDataURL(file);
	        }else{ $('#msj').html('Archivo no admitido.'); error++; }
	      }else{ $('#msj').html('La imagen supera el tamaño permitido: 2MB.'); error++; }
	    }

	    if(error>0){
	      img.parent().parent().addClass('has-error');
	      $('#'+input).val('');
	      $('.alert').removeClass('alert-success').addClass("alert-danger");
	      $('.alert').show().delay(7000).hide('slow');
	      load.hide();
	    }else{ img.parent().parent().removeClass('error'); }
	  }//Preview-----------------------------------------------------------------------------------
	</script>
@endsection