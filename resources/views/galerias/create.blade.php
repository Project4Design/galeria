@extends('layouts.app')
@section('title','Galeria - '.config('app.name'))
@section('header','Galeria')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li> Galeria </li>
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
					<h4>{{ $title }} Cuadro</h4>

					<div class="form-group">
            <div class="imageUploadWidget {{ $errors->has('image')?'has-error':'' }}">
              <div class="imageArea">
                <img id="img" src="{{ asset('/images/cuadros/') }}{{isset($cuadro->foto) ? '/'.$cuadro->foto : '/no-image.png' }}" alt="">
                <img class="spinner-image" src="{{ asset('images/spinner.gif') }}">
              </div>
              <div class="btnArea">
                <input id='file' name='image' accept='image/jpeg,image/png' type='file'>
              </div>
            </div>
          </div>

					<div class="form-group {{ $errors->has('titulo')?'has-error':'' }}">
						<label class="control-label" for="titulo">Titulo:</label>
						<input id="titulo" class="form-control" type="text" name="titulo" value="{{ old('titulo')?old('titulo'):$cuadro->titulo }}" placeholder="Titulo">
					</div>

					<div class="form-group {{ $errors->has('descripcion')?'has-error':'' }}">
						<label class="control-label" for="descripcion">Descripcion:</label>
						<input id="descripcion" class="form-control" type="text" name="descripcion" value="{{ old('descripcion')?old('descripcion'):$cuadro->descripcion }}" placeholder="Descripcion">
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
	      if(file.size<3500000){
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