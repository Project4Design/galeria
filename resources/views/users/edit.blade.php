@extends('layouts.app')
@section('title','Usuarios - '.config('app.name'))
@section('header','Usuarios')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li> Usuarios </li>
	  <li class="active">Editar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form class="" action="{{ url('admin/users/'.$user->id) }}" method="POST" enctype="multipart/form-data">
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
					<h4>Editar Usuario</h4>
					<div class="form-group {{ $errors->has('nombres')?'has-error':'' }}">
						<label class="control-label" for="nombres">nombre: *</label>
						<input id="nombres" class="form-control" type="text" name="nombres" value="{{ old('nombres')?old('nombres'):$user->detalles->nombres }}" placeholder="Nombres">
					</div>

					<div class="form-group {{ $errors->has('apellidos')?'has-error':'' }}">
						<label class="control-label" for="apellidos">Apellido: *</label>
						<input id="apellidos" class="form-control" type="text" name="apellidos" value="{{ old('apellidos')?old('apellidos'):$user->detalles->apellidos }}" placeholder="Apellidos">
					</div>
					
					<div class="form-group {{ $errors->has('email')?'has-error':'' }}">
						<label class="control-label" for="email">Email: *</label>
						<input id="email" class="form-control" type="mail" name="email" value="{{ old('email')?old('email'):$user->email }}" placeholder="Email">
					</div>

					<div class="form-group {{ $errors->has('cedula')?'has-error':'' }}">
						<label class="control-label" for="cedula">Cedula: *</label>
						<input id="cedula" class="form-control" type="text" name="cedula" value="{{ old('cedula')?old('cedula'):$user->detalles->cedula }}" placeholder="Cedula">
					</div>

					<div class="form-group {{ $errors->has('tlf_personal')?'has-error':'' }}">
						<label class="control-label" for="tlf_personal">Telefono personal: *</label>
						<input id="tlf_personal" class="form-control" type="text" name="tlf_personal" value="{{ old('tlf_personal')?old('tlf_personal'):$user->detalles->tlf_personal }}" placeholder="Telefono personal">
					</div>

					<div class="form-group {{ $errors->has('tlf_local')?'has-error':'' }}">
						<label class="control-label" for="tlf_local">Telefono local: </label>
						<input id="tlf_local" class="form-control" type="text" name="tlf_local" value="{{ old('tlf_local')?old('tlf_local'):$user->detalles->tlf_local }}" placeholder="tlf_local">
					</div>

				  <div class="form-group">
				  	<div class="checkbox">
					    <label>
					      <input type="checkbox" id="pp" name="checkbox" value="Yes"> Cambiar contraseña?
					    </label>
				    </div>
				  </div>

					<fieldset id="pass" style="display:none" disabled>
						<legend>Cambiar constraseña</legend>
						<div class="form-group {{ $errors->has('password')?'has-error':'' }}">
							<label class="control-label" for="password">Contraseña:</label>
							<input id="password" class="form-control" type="password" name="password" value="{{ old('password')?old('password'):'' }}">
						</div>

						<div class="form-group {{ $errors->has('password_confirmation')?'has-error':'' }}">
							<label class="control-label" for="password_confirmation">Verificar:</label>
							<input id="password_confirmation" class="form-control" type="password" name="password_confirmation" value="{{ old('password_confirmation')?old('password_confirmation'):'' }}">
						</div>
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
						<a class="btn btn-flat btn-default" href="{{url('admin/users')}}"><i class="fa fa-reply"></i> Atras</a>
						<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
					</div>
				</form>
			</div>
		</div>
@endsection


@section('script')
 	<script type="text/javascript">
 	$(document).ready(function(){
 			$("#pp").click(function(event) {
	 		var bool = this.checked;
	 		if(bool === true){
	 			$("#pass").show('fast');
	 			$('#pass').prop('disabled',false);
	 			$("#password,#password_confirmation").prop('required',true);
	 		}else{
	 			$("#pass").hide('fast');
	 			$('#pass').prop('disabled',true);
	 			$("#password,#password_confirmation").prop('required',false);
	 		}
	 	});

		$("#send").click(function(event) {
			event.preventDefault();
			var form  = $('#editar');
			var pass1 = $("#pass_new").val();
			var pass2 = $("#pass_rep").val();
			var message = $("#message");
			if(pass1 === pass2){
				form.submit();
			}else{
				$("#pass_new").css('border','solid 1px red');
				$("#pass_rep").css('border','solid 1px red');
				message.fadeIn('slow/400/fast');
				message.fadeOut(3000);				
			}
	 	});
 	});
 	</script>
@stop
