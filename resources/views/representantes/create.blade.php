@extends('layouts.app')
@section('title','Representantes - '.config('app.name'))
@section('header','Representantes')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li> Representantes </li>
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
					<h4>{{ $title }} Representante</h4>

					<div class="form-group">
            <div class="imageUploadWidget {{ $errors->has('foto')?'has-error':'' }}">
              <div class="imageArea">
                <img id="img" src="{{ asset('/images') }}{{isset($representante->foto) ? '/representantes/'.$representante->foto : '/no-image.png' }}" alt="">
                <img class="spinner-image" src="{{ asset('images/spinner.gif') }}">
              </div>
              <div class="btnArea">
                <input id='file' name='foto' accept='image/jpeg,image/png' type='file'>
              </div>
            </div>
          </div>

					<div class="form-group {{ $errors->has('nombres')?'has-error':'' }}">
						<label class="control-label" for="nombres">Nombres:</label>
						<input id="nombres" class="form-control" type="text" name="nombres" value="{{ old('nombres')?old('nombres'):$representante->nombres }}" placeholder="Nombre">
					</div>

					<div class="form-group {{ $errors->has('apellidos')?'has-error':'' }}">
						<label class="control-label" for="apellidos">Apellidos:</label>
						<input id="apellidos" class="form-control" type="text" name="apellidos" value="{{ old('apellidos')?old('apellidos'):$representante->apellidos }}" placeholder="Apellido">
					</div>
					
					<div class="form-group {{ $errors->has('email')?'has-error':'' }}">
						<label class="control-label" for="email">Email:</label>
						<input id="email" class="form-control" type="mail" name="email" value="{{ old('email')?old('email'):$representante->email }}" placeholder="Email">
					</div>

					<div class="form-group {{ $errors->has('cedula')?'has-error':'' }}">
						<label class="control-label" for="cedula">Cedula:</label>
						<input id="cedula" class="form-control" type="text" name="cedula" value="{{ old('cedula')?old('cedula'):$representante->cedula }}" placeholder="Cedula">
					</div>

					<div class="form-group {{ $errors->has('tlf_personal')?'has-error':'' }}">
						<label class="control-label" for="tlf_personal">Telefono personal:</label>
						<input id="tlf_personal" class="form-control" type="text" name="tlf_personal" value="{{ old('tlf_personal')?old('tlf_personal'):$representante->tlf_personal }}" placeholder="Telefono personal">
					</div>

					<div class="form-group {{ $errors->has('tlf_local')?'has-error':'' }}">
						<label class="control-label" for="tlf_local">Telefono local:</label>
						<input id="tlf_local" class="form-control" type="text" name="tlf_local" value="{{ old('tlf_local')?old('tlf_local'):$representante->tlf_local }}" placeholder="Telefono local">
					</div>

					<div class="form-group {{ $errors->has('residencia')?'has-error':'' }}">
						<label class="control-label" for="residencia">Residencia:</label>
						<input id="residencia" class="form-control" type="text" name="residencia" value="{{ old('residencia')?old('residencia'):$representante->residencia }}" placeholder="Residencia">
					</div>


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
						<a class="btn btn-flat btn-default" href="{{route('representantes.inddex')}}"><i class="fa fa-reply"></i> Atras</a>
						<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
					</div>
				</form>
			</div>
		</div>
@endsection
