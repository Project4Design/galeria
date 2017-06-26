@extends('layouts.app')

@section('title','Perfil - '.config('app.name'))
@section('header','Perfil')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{ url('panel/dashboard') }}"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li class="active"> Perfil </li>
	</ol>
@endsection
@section('content')

<div class="content">
	<section>
		<a class="btn btn-flat btn-default" href="{{ url('panel/dashboard') }}"><i class="fa fa-reply"></i> Volver</a>
	</section>
	<section class="perfil">
		<div class="row">
			<div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-user" aria-hidden="true"></i>
          {{$perfil->detalles->nombres." ".$perfil->detalles->apellidos}}
        </h2>

			  <form action="{{route('update_perfil')}}" method="POST" id="editar">
				  {{method_field('PATCH')}}
				  {{csrf_field()}}
					@include('partials.flash')
				  <div class="form-group col-md-4 col-md-offset-4">
				    <label for="nombres">Nombres: *</label>
				    <input type="text" class="form-control" name="nombres"  value="{{$perfil->detalles->nombres}}" required>
				  </div>
				  <div class="form-group col-md-4 col-md-offset-4">
				    <label for="apellidos">Apellidos: *</label>
				    <input type="text" class="form-control" name="apellidos" value="{{$perfil->detalles->apellidos}}" required>
				  </div>
				  <div class="form-group col-md-4 col-md-offset-4">
				    <label for="cedula">Cedula: *</label>
				    <input type="text" class="form-control" name="cedula" value="{{$perfil->detalles->cedula}}" required>
				  </div>
				  <div class="form-group col-md-4 col-md-offset-4">
				    <label for="email">Email: *</label>
				    <input type="email" class="form-control" name="email" value="{{$perfil->email}}" required>
				  </div>
				  <div class="form-group col-md-4 col-md-offset-4">
				    <label for="tlf_personal">Telefono personal: *</label>
				    <input type="tlf_personal" class="form-control" name="tlf_personal" value="{{$perfil->detalles->tlf_personal}}" required>
				  </div>
				  <div class="form-group col-md-4 col-md-offset-4">
				    <label for="tlf_local">Telefono local: </label>
				    <input type="tlf_local" class="form-control" name="tlf_local" value="{{$perfil->detalles->tlf_local}}" required>
				  </div>
				  <div class="col-md-4 col-md-offset-4">
				  	<div class="checkbox">
					    <label>
					      <input type="checkbox" id="pp" name="checkbox" value="Yes"> Cambiar contraseña?
					    </label>
				    </div>
				  </div>
				  
				  <section id="pass" style="display:none">
					  <div class="form-group col-md-4 col-md-offset-4">
					  	<label>Contraseña nueva</label>
					  	<input type="password" class="form-control" name="password" id="pass_new">
					  </div>
					  <div class=" form-group col-md-4 col-md-offset-4">
					  	<label>Verificar</label>
					  	<input type="password" class="form-control" name="password_confirmation" id="pass_rep">

						 	<div class="alert alert-danger" style="display:none;" id="message">
					      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					      <strong class="text-center">Las contraseñas deben ser iguales</strong> 
  				    </div>
					  </div>
				  </section>

					@if (count($errors) > 0)
					<div class="col-md-12">
					<div class="col-md-4 col-md-offset-4">
          <div class="alert alert-danger">
	          <ul>
	            @foreach($errors->all() as $error)
	               <li>{{$error}}</li>
	             @endforeach
	           </ul>  
          </div>
          </div>
          </div>
        	@endif

				  <div class="col-md-4 col-md-offset-4">
				     <button type="submit" id="send" class="btn btn-flat btn-success">Actualizar</button>
				  </div>
			  </form>
            </div>
		</div>
	</section>
</div>
@stop

@section('script')
 	<script type="text/javascript">
 	$(document).ready(function(){
 			$("#pp").click(function(event) {
	 		var bool = this.checked;
	 		if(bool === true){
	 			$("#pass").show('fast');
	 			$("#pass_new,pass_rep").prop('required',true);
	 		}else{
	 			$("#pass").hide('fast');
	 			$("#pass_new,pass_rep").prop('required',false).val('');
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