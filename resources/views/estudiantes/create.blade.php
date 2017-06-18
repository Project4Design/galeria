@extends('layouts.app')
@section('title','Estudiantes - '.config('app.name'))
@section('header','Estudiantes')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li> Estudiantes </li>
	  <li class="active">Agregar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form class="" action="{{ url('admin/estudiantes') }}" method="POST" enctype="multipart/form-data">
					{{ method_field('POST') }}
					{{ csrf_field() }}
					<h4>Agregar estudiante</h4>

					<div class="form-group">
            <div class="imageUploadWidget {{ $errors->has('foto')?'has-error':'' }}">
              <div class="imageArea">
                <img id="img" src="{{ asset('/images/no-image.png') }}" alt="">
                <img id="sping" class="spinner-image" src="{{ asset('images/spinner.gif') }}">
              </div>
              <div class="btnArea">
                <input id='file' name='foto' accept='image/jpeg,image/png' type='file'>
              </div>
            </div>
          </div>

					<div class="form-group {{ $errors->has('nombres')?'has-error':'' }}">
						<label class="control-label" for="nombres">Nombres:</label>
						<input id="nombres" class="form-control" type="text" name="nombres" value="{{ old('nombres')?old('nombres'):''}}" placeholder="Nombres">
					</div>
					
					<div class="form-group {{ $errors->has('apellidos')?'has-error':'' }}">
						<label class="control-label" for="apellidos">Apellidos:</label>
						<input id="apellidos" class="form-control" type="text" name="apellidos" value="{{ old('apellidos')?old('apellidos'):''}}" placeholder="Apellidos">
					</div>

					<div class="form-group {{ $errors->has('cedula')?'has-error':'' }}">
						<label class="control-label" for="cedula">Cedula:</label>
						<input id="cedula" class="form-control" type="text" name="cedula" value="{{ old('cedula')?old('cedula'):''}}" placeholder="Apellidos">
					</div>

					<div class="form-group {{ $errors->has('sexo')?'has-error':'' }}">
						<label class="control-label" for="sexo">Sexo:</label>
						<select name="sexo" id="sexo" class="form-control">
							<option value="">Seleccione...</option>
							<option value="M" @if(old('sexo')) {{ old('sexo')==='M'?'selected':''}} @endif >Masculino</option>
							<option value="F" @if(old('sexo')) {{ old('sexo')==='F'?'selected':''}} @endif >Femenino</option>
						</select>
					</div>

					<div class="form-group {{ $errors->has('residencia')?'has-error':'' }}">
						<label class="control-label" for="residencia">Residencia:</label>
						<input id="residencia" class="form-control" type="text" name="residencia" value="{{ old('residencia')?old('residencia'):'' }}" placeholder="Residencia">
					</div>

					<div class="form-group {{ $errors->has('email')?'has-error':'' }}">
						<label class="control-label" for="email">Email:</label>
						<input id="email" class="form-control" type="text" name="email" value="{{ old('email')?old('email'):'' }}" placeholder="Email">
					</div>
					
					<div class="form-group {{ $errors->has('alergico')?'has-error':'' }}">
						<label class="control-label" for="alergico">Alergico:</label>
						<select name="alergico" id="alergico" class="form-control">
							<option value="">Seleccione...</option>
							<option value="1" @if(old('alergico')) {{ old('alergico')==1?'selected':''}} @endif >Si</option>
							<option value="0" @if(old('alergico')=="0") {{ old('alergico')==0?'selected':''}} @endif >No</option>
						</select>
					</div>

					<div class="form-group {{ $errors->has('tlf_personal')?'has-error':'' }}">
						<label class="control-label" for="tlf_personal">Tlf. Personal:</label>
						<input id="tlf_personal" class="form-control" type="text" name="tlf_personal" value="{{ old('tlf_personal')?old('tlf_personal'):'' }}" placeholder="Telefono personal">
					</div>

					<div class="form-group {{ $errors->has('tlf_local')?'has-error':'' }}">
						<label class="control-label" for="tlf_local">Tlf. Local:</label>
						<input id="tlf_local" class="form-control" type="text" name="tlf_local" value="{{ old('tlf_local')?old('tlf_local'):'' }}" placeholder="Telefono Local">
					</div>
					
					<div class="form-group {{ $errors->has('nacimiento')?'has-error':'' }}">
						<label class="control-label" for="nacimiento">Nacimiento:</label>
						<input id="nacimiento" class="form-control datepicker" type="text" name="nacimiento" value="{{ old('nacimiento')?old('nacimiento'):'' }}" placeholder="Nacimiento" autocomplete="off" readonly>
					</div>

					<fieldset id="representante" disabled style="display:none">
						<!--============================|| AGREGAR REPRESENTATES ||========================================-->
						<legend>Agregar representante</legend>
						<p class="text-danger">El estudiante es menor de edad. Debe registrar un representante</p>
						<div class="form-group">
	            <div class="imageUploadWidget {{ $errors->has('representante_foto')?'has-error':'' }}">
	              <div class="imageArea">
	                <img id="r_img" src="{{ asset('/images/no-image.png') }}" alt="">
	                <img id="r_spin" class="spinner-image" src="{{ asset('images/spinner.gif') }}">
	              </div>
	              <div class="btnArea">
	                <input id="r_file" name="representante_foto" accept="image/jpeg,image/png" type="file">
	              </div>
	            </div>
	          </div>

						<div class="form-group {{ $errors->has('representante_nombres')?'has-error':'' }}">
							<label class="control-label" for="representante_nombres">Nombres:</label>
							<input id="representante_nombres" class="form-control" type="text" name="representante_nombres" value="{{ old('representante_nombres')?old('representante_nombres'):'' }}" placeholder="Nombres">
						</div>

						<div class="form-group {{ $errors->has('representante_apellidos')?'has-error':'' }}">
							<label class="control-label" for="representante_apellidos">Apellidos:</label>
							<input id="representante_apellidos" class="form-control" type="text" name="representante_apellidos" value="{{ old('representante_apellidos')?old('representante_apellidos'):'' }}" placeholder="Apellido">
						</div>
						
						<div class="form-group {{ $errors->has('representante_email')?'has-error':'' }}">
							<label class="control-label" for="representante_email">Email:</label>
							<input id="representante_email" class="form-control" type="mail" name="representante_email" value="{{ old('representante_email')?old('representante_email'):'' }}" placeholder="Email">
						</div>

						<div class="form-group {{ $errors->has('representante_cedula')?'has-error':'' }}">
							<label class="control-label" for="representante_cedula">Cedula:</label>
							<input id="representante_cedula" class="form-control" type="text" name="representante_cedula" value="{{ old('representante_cedula')?old('representante_cedula'):'' }}" placeholder="Cedula">
						</div>

						<div class="form-group {{ $errors->has('representante_tlf_personal')?'has-error':'' }}">
							<label class="control-label" for="representante_tlf_personal">Telefono personal:</label>
							<input id="representante_tlf_personal" class="form-control" type="text" name="representante_tlf_personal" value="{{ old('representante_tlf_personal')?old('representante_tlf_personal'):'' }}" placeholder="Telefono personal">
						</div>

						<div class="form-group {{ $errors->has('representante_tlf_local')?'has-error':'' }}">
							<label class="control-label" for="representante_tlf_local">Telefono local:</label>
							<input id="representante_tlf_local" class="form-control" type="text" name="representante_tlf_local" value="{{ old('representante_tlf_local')?old('representante_tlf_local'):'' }}" placeholder="Telefono local">
						</div>

						<div class="form-group {{ $errors->has('representante_residencia')?'has-error':'' }}">
							<label class="control-label" for="representante_residencia">Residencia:</label>
							<input id="representante_residencia" class="form-control" type="text" name="representante_residencia" value="{{ old('representante_residencia')?old('representante_residencia'):'' }}" placeholder="Residencia">
						</div>
						<!--================================================================================-->
					</fieldset>

					@if (count($errors) > 0)
          <div class="alert alert-danger">
	          <ul>
	            @foreach($errors->all() as $error)
	               <li>{{$error}}</li>
	             @endforeach
	           </ul>  
          </div>
        	@endif

					<div class="form-group text-right">
						<a class="btn btn-flat btn-default" href="{{route('estudiantes.index')}}"><i class="fa fa-reply"></i> Atras</a>
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
			$('#r_file').change(preview2);

      $('.datepicker').datepicker({
        autoclose: true,
        endDate: "today",
  			startView: "years", 
        enableOnReadonly: false,
    		format: 'dd-mm-yyyy',
    		enableOnReadonly: true
    	}).on('changeDate', function(date){
    			var dob = $(this).datepicker('getDate');
    			CalcAge(dob);
    		});
    	setTimeout(function(){
    		var dob = $('.datepicker').datepicker('getDate');
    		if(dob) CalcAge(dob);
    	},1000);
    	
		});

		function CalcAge(birthDate) {
	    var today = new Date();
	    var age = today.getFullYear() - birthDate.getFullYear();
	    var m = today.getMonth() - birthDate.getMonth();
	    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
	      age--;
	    }
	    var enable = (age<18);
			if(enable){
				$('#representante').show().prop('disabled',!enable);
			}else{
				$('#representante').hide().prop('disabled',enable);
			}
		}
		
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
	    var load = $("#spin");
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

	  function preview2(){
	    //Id del input
	    var input = this.id;
	    //El archivo
	    var file  = this.files[0];
	    //Tippo de archivo
	    var type  = file.type;
	    //Contar errores
	    var error = 0;
	    //Imagen
	    var img   = $('#r_img');
	    //Imagen anterior
	    var prev  = img.attr("src");
	    //Imagen loading
	    var load = $("#r_spin");
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