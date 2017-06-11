@extends('layouts.app')
@section('title','Usuarios - '.config('app.name'))
@section('header','Usuarios')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li> Usuarios </li>
	  <li class="active">{{$title}}</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form class="" action="{{ url($url) }}" method="POST" enctype="multipart/form-data">
					{{ method_field( $method ) }}
					{{ csrf_field() }}
					<h4>{{ $title }} Usuario</h4>

					<div class="form-group {{ $errors->has('nombre')?'has-error':'' }}">
						<label class="control-label" for="nombre">nombre:</label>
						<input id="nombre" class="form-control" type="text" name="nombre" value="{{ old('nombre')?old('nombre'):$user->nombre }}" placeholder="Nombre">
					</div>

					<div class="form-group {{ $errors->has('apellido')?'has-error':'' }}">
						<label class="control-label" for="apellido">Apellido:</label>
						<input id="apellido" class="form-control" type="text" name="apellido" value="{{ old('apellido')?old('apellido'):$user->apellido }}" placeholder="Apellido">
					</div>
					
					<div class="form-group {{ $errors->has('email')?'has-error':'' }}">
						<label class="control-label" for="email">Email:</label>
						<input id="email" class="form-control" type="mail" name="email" value="{{ old('email')?old('email'):$user->email }}" placeholder="Email">
					</div>

					<div class="form-group {{ $errors->has('cedula')?'has-error':'' }}">
						<label class="control-label" for="cedula">Cedula:</label>
						<input id="cedula" class="form-control" type="text" name="cedula" value="{{ old('cedula')?old('cedula'):$user->cedula }}" placeholder="Cedula">
					</div>

					<div class="form-group {{ $errors->has('telefono')?'has-error':'' }}">
						<label class="control-label" for="telefono">Telefono:</label>
						<input id="telefono" class="form-control" type="text" name="telefono" value="{{ old('telefono')?old('telefono'):$user->telefono }}" placeholder="Telefono">
					</div>
					
				@if($method!="PATCH")
					<div class="form-group {{ $errors->has('password')?'has-error':'' }}">
						<label class="control-label" for="password">Contraseña:</label>
						<input id="password" class="form-control" type="password" name="password" value="{{ old('password')?old('password'):$user->password }}">
					</div>

					<div class="form-group {{ $errors->has('password_confirmation')?'has-error':'' }}">
						<label class="control-label" for="password_confirmation">Verificar:</label>
						<input id="password_confirmation" class="form-control" type="password" name="password_confirmation" value="{{ old('password_confirmation')?old('password_confirmation'):$user->password_confirmation }}">
					</div>
				@endif


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
						<a class="btn btn-flat btn-default" href="{{url('admin/users')}}"><i class="fa fa-reply"></i> Atras</a>
						<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
					</div>
				</form>
			</div>
		</div>
@endsection
