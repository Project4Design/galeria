<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicons.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="shortcut icon" href="{{asset('img/logo.png')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-datepicker3.min.css')}}">
  </head>

<body class="hold-transition login-page">
    <div class="login-logo">
    	<br>
    	<center><img class="img-responsive" src="{{ asset('img/logo.png') }}" alt="Logo" style="height:135px"></center>
    </div><!-- /.login-logo -->
    <div class="row">
    	<div class="col-md-6 col-md-offset-3" style="background-color:#fff;border:1px solid #ccc;">
	      <form class="col-md-10 col-md-offset-1" action="{{ route('eststore') }}" method="POST" enctype="multipart/form-data">
					{{ method_field('POST') }}
					{{ csrf_field() }}
					<h4>Registro</h4>

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
						<label class="control-label" for="nombres">Nombres: *</label>
						<input id="nombres" class="form-control" type="text" name="nombres" value="{{ old('nombres')?old('nombres'):''}}" placeholder="Nombres" required>
					</div>
					
					<div class="form-group {{ $errors->has('apellidos')?'has-error':'' }}">
						<label class="control-label" for="apellidos">Apellidos: *</label>
						<input id="apellidos" class="form-control" type="text" name="apellidos" value="{{ old('apellidos')?old('apellidos'):''}}" placeholder="Apellidos" required>
					</div>

					<div class="form-group {{ $errors->has('cedula')?'has-error':'' }}">
						<label class="control-label" for="cedula">Cedula: *</label>
						<input id="cedula" class="form-control" type="text" name="cedula" value="{{ old('cedula')?old('cedula'):''}}" placeholder="Cedula" required>
					</div>

					<div class="form-group {{ $errors->has('sexo')?'has-error':'' }}">
						<label class="control-label" for="sexo">Sexo: *</label>
						<select name="sexo" id="sexo" class="form-control" required>
							<option value="">Seleccione...</option>
							<option value="M" @if(old('sexo')) {{ old('sexo')==='M'?'selected':''}} @endif >Masculino</option>
							<option value="F" @if(old('sexo')) {{ old('sexo')==='F'?'selected':''}} @endif >Femenino</option>
						</select>
					</div>

					<div class="form-group {{ $errors->has('residencia')?'has-error':'' }}">
						<label class="control-label" for="residencia">Residencia: *</label>
						<input id="residencia" class="form-control" type="text" name="residencia" value="{{ old('residencia')?old('residencia'):'' }}" placeholder="Residencia" required>
					</div>

					<div class="form-group {{ $errors->has('email')?'has-error':'' }}">
						<label class="control-label" for="email">Email: *</label>
						<input id="email" class="form-control" type="text" name="email" value="{{ old('email')?old('email'):'' }}" placeholder="Email" required>
					</div>
					
					<div class="form-group {{ $errors->has('alergico')?'has-error':'' }}">
						<label class="control-label" for="alergico">Alergico: *</label>
						<select name="alergico" id="alergico" class="form-control" required>
							<option value="">Seleccione...</option>
							<option value="1" @if(old('alergico')) {{ old('alergico')==1?'selected':''}} @endif >Si</option>
							<option value="0" @if(old('alergico')=="0") {{ old('alergico')==0?'selected':''}} @endif >No</option>
						</select>
					</div>
					
					<fieldset id="c-alergia" style="display:none">
						<div class="form-group {{ $errors->has('alergia')?'has-error':'' }}">
							<label class="control-label" for="alergia">Alergia: </label>
							<input id="alergia" class="form-control" type="text" name="alergia" value="{{ old('alergia')?old('alergia'):'' }}" placeholder="Especifique" required>
						</div>
					</fieldset>

					<div class="form-group {{ $errors->has('tlf_personal')?'has-error':'' }}">
						<label class="control-label" for="tlf_personal">Tlf. Personal: *</label>
						<input id="tlf_personal" class="form-control" type="text" name="tlf_personal" value="{{ old('tlf_personal')?old('tlf_personal'):'' }}" placeholder="Telefono personal" required>
					</div>

					<div class="form-group {{ $errors->has('tlf_local')?'has-error':'' }}">
						<label class="control-label" for="tlf_local">Tlf. Local:</label>
						<input id="tlf_local" class="form-control" type="text" name="tlf_local" value="{{ old('tlf_local')?old('tlf_local'):'' }}" placeholder="Telefono Local">
					</div>

					<div class="form-group {{ $errors->has('password')?'has-error':'' }}">
						<label class="control-label" for="password">Constraseña: *</label>
						<input id="password" class="form-control" type="password" name="password">
					</div>

					<div class="form-group {{ $errors->has('password_confirmation')?'has-error':'' }}">
						<label class="control-label" for="password_confirmation">Confirmacion: *</label>
						<input id="password_confirmation" class="form-control" type="password" name="password_confirmation">
					</div>
					
					<div class="form-group {{ $errors->has('nacimiento')?'has-error':'' }}">
						<label class="control-label" for="nacimiento">Nacimiento: *</label>
						<input id="nacimiento" class="form-control datepicker" type="text" name="nacimiento" value="{{ old('nacimiento')?old('nacimiento'):'' }}" placeholder="Nacimiento" autocomplete="off" readonly required>
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
							<label class="control-label" for="representante_nombres">Nombres: *</label>
							<input id="representante_nombres" class="form-control" type="text" name="representante_nombres" value="{{ old('representante_nombres')?old('representante_nombres'):'' }}" placeholder="Nombres" required>
						</div>

						<div class="form-group {{ $errors->has('representante_apellidos')?'has-error':'' }}">
							<label class="control-label" for="representante_apellidos">Apellidos: *</label>
							<input id="representante_apellidos" class="form-control" type="text" name="representante_apellidos" value="{{ old('representante_apellidos')?old('representante_apellidos'):'' }}" placeholder="Apellido" required>
						</div>
						
						<div class="form-group {{ $errors->has('representante_email')?'has-error':'' }}">
							<label class="control-label" for="representante_email">Email: *</label>
							<input id="representante_email" class="form-control" type="mail" name="representante_email" value="{{ old('representante_email')?old('representante_email'):'' }}" placeholder="Email" required>
						</div>

						<div class="form-group {{ $errors->has('representante_cedula')?'has-error':'' }}">
							<label class="control-label" for="representante_cedula">Cedula: *</label>
							<input id="representante_cedula" class="form-control" type="text" name="representante_cedula" value="{{ old('representante_cedula')?old('representante_cedula'):'' }}" placeholder="Cedula" required>
						</div>

						<div class="form-group {{ $errors->has('representante_tlf_personal')?'has-error':'' }}">
							<label class="control-label" for="representante_tlf_personal">Telefono personal: *</label>
							<input id="representante_tlf_personal" class="form-control" type="text" name="representante_tlf_personal" value="{{ old('representante_tlf_personal')?old('representante_tlf_personal'):'' }}" placeholder="Telefono personal" required>
						</div>

						<div class="form-group {{ $errors->has('representante_tlf_local')?'has-error':'' }}">
							<label class="control-label" for="representante_tlf_local">Telefono local:</label>
							<input id="representante_tlf_local" class="form-control" type="text" name="representante_tlf_local" value="{{ old('representante_tlf_local')?old('representante_tlf_local'):'' }}" placeholder="Telefono local">
						</div>

						<div class="form-group {{ $errors->has('representante_residencia')?'has-error':'' }}">
							<label class="control-label" for="representante_residencia">Residencia: *</label>
							<input id="representante_residencia" class="form-control" type="text" name="representante_residencia" value="{{ old('representante_residencia')?old('representante_residencia'):'' }}" placeholder="Residencia" required>
						</div>
						<!--================================================================================-->
					</fieldset>

					@if (count($errors) > 0)
          <div class="alert alert-danger alert-important">
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
    </div><!-- /.row -->
    <footer class="main-footer" style="margin: 20px 0 0 0;width:100%;">
      <strong>Copyright &copy; GALERIA D´ ABILIO 2017 </strong>. - Desarrollado por Marily Ortegana y Frangelis Hernandez
    </footer>


    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>

    <script type="text/javascript">
		$(document).ready(function(){
			$('#file').change(preview);
			$('#r_file').change(preview2);

			$('#alergico').change(function(){
				if($(this).val()==1){
					$('#c-alergia').show();
					$('#alergia').prop('required',true);
				}else{
					$('#c-alergia').hide();
					$('#alergia').prop('required',false);
				}
			});

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
			if(enable===true){
				$('#representante').show().prop({'disabled':false,'required':true});
			}else{
				$('#representante').hide().prop({'disabled':true,'required':false});
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

</body>
</html>