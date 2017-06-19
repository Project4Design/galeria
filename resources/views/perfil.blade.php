@extends('layouts.app')

@section('title','Proflie - '.config('app.name'))
@section('header','Profile')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{ route('admin_index') }}"><i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard</a></li>
	  <li class="active"> Profile </li>
	</ol>
@endsection
@section('content')

<div class="content">
	<section>
		<a class="btn btn-flat btn-default" href="{{ route('admin_index') }}"><i class="fa fa-reply"></i> Volver</a>
	</section>
	<section class="perfil">
		<div class="row">
			<div class="col-md-12">
	          <h2 class="page-header" style="margin-top:0!important">
	            <i class="fa fa-user" aria-hidden="true"></i>
	            {{$perfil->detalles->nombres}}
	          </h2>
			  <form action="{{url('perfil/'.$perfil->id.'/edit')}}" method="POST" id="editar">
					  {{csrf_field()}}
					  {{method_field('PUT')}}
					@include('partials.flash')
				  <div class="form-group col-md-4 col-md-offset-4">
						 <div class="alert alert-danger" style="display:none;" id="message">
						      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						      <strong class="text-center">Passwords must be the same</strong> 
  				    d</div>
				    <label for="name">Name</label>
				    <input type="text" class="form-control" name="name"  value="{{$perfil->detalles->nombres}}" required>
				  </div>
				  <div class="form-group col-md-4 col-md-offset-4">
				    <label for="email">Email</label>
				    <input type="email" class="form-control" name="email" value="{{$perfil->email}}" required >
				  </div>
				  <div class="col-md-4 col-md-offset-4">
				  	<div class="checkbox">
					    <label>
					      <input type="checkbox" id="pp" name="checkbox" value="Yes"> Cambiar contraseña?
					    </label>
				    </div>
				  </div>
				  <section id="pass" style="display:none">
					  <div class="form-group col-md-4 col-md-offset-5">
					  	<label>Password new</label>
					  	<input type="password" class="form-control" name="password_new" id="pass_new">
					  </div>
					  <div class=" form-group col-md-4 col-md-offset-5">
					  	<label>Password repeat</label>
					  	<input type="password" class="form-control" name="password_rep" id="pass_rep">
					  </div>
				  </section>

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
	 			$("#pass").show('slow/400/fast');
	 			$("#pass_new,pass_rep").prop('required',true);
	 		}else{

	 			$("#pass").hide('slow/400/fast');
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