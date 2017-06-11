@extends('layouts.app')
@section('title','Profesores - '.config('app.name'))
@section('header','Profesores')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li> Profesores </li>
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
					<h4>{{ $title }} Profesor</h4>

					<div class="form-group">
            <div class="imageUploadWidget">
              <div class="imageArea">
                <img id="img" src="{{ asset('/images') }}{{isset($profesor->foto) ? '/profesores/'.$profesor->foto : '/no-image.png' }}" alt="">
                <img class="spinner-image" src="{{ asset('images/spinner.gif') }}">
              </div>
              <div class="btnArea">
                <input id='file' name='foto' accept='image/jpeg,image/png' type='file'>
              </div>
            </div>
          </div>

          			<div class="form-group {{ $errors->has('cedula')?'has-error':'' }}">
						<label class="control-label" for="cedula">Cedula:</label>
						<input id="cedula" class="form-control" type="text" name="cedula" value="{{ old('cedula')?old('cedula'):$profesor->cedula }}" placeholder="Cedula">
					</div>

					<div class="form-group {{ $errors->has('nombre')?'has-error':'' }}">
						<label class="control-label" for="nombre">Nombre:</label>
						<input id="nombre" class="form-control" type="text" name="nombre" value="{{ old('nombre')?old('nombre'):$profesor->nombre }}" placeholder="Titulo">
					</div>
					
					<div class="form-group {{ $errors->has('apellido')?'has-error':'' }}">
						<label class="control-label" for="apellido">Apellido:</label>
						<input id="apellido" class="form-control" type="text" name="apellido" value="{{ old('apellido')?old('apellido'):$profesor->apellido }}" placeholder="Apellido">
					</div>

					<div class="form-group {{ $errors->has('direccion')?'has-error':'' }}">
						<label class="control-label" for="nombre">Direccion:</label>
						<input id="direccion" class="form-control" type="text" name="direccion" value="{{ old('direccion')?old('direccion'):$profesor->direccion }}" placeholder="Direccion">
					</div>

					<div class="form-group {{ $errors->has('profesion')?'has-error':'' }}">
						<label class="control-label" for="nombre">Profesion:</label>
						<input id="profesion" class="form-control" type="text" name="profesion" value="{{ old('profesion')?old('profesion'):$profesor->profesion }}" placeholder="Profesion">
					</div>

					<div class="form-group {{ $errors->has('descripcion_perfil')?'has-error':'' }}">
						<label class="control-label" for="descripcion_perfil">Descripcion de perfil:</label>
						<textarea id="descripcion_perfil" class="form-control" type="text" name="descripcion_perfil"  placeholder="Descripcion del perfil">{{ old('descripcion_perfil')?old('descripcion_perfil'):$profesor->descripcion_perfil }}</textarea>
					</div>

					


					@if(count($errors)>0)
						<div class="alert alert-danger">
			        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			        <strong class="text-center">Debe completar todos los campos requireridos</strong> 
			    	</div>
					@endif

					<div class="form-group text-right">
						<a class="btn btn-flat btn-default" href="{{route('galeria.index')}}"><i class="fa fa-reply"></i> Atras</a>
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