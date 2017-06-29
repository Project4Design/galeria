@extends('layouts.app')
@section('title','Inscripciones - '.config('app.name'))
@section('header','Inscripciones')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li> Incripciones </li>
	  <li class="active"> Inscripcion </li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			@include('partials.flash')
			<div class="col-md-6 col-md-offset-3">
				<form class="" action="{{ url('admin/inscripciones') }}" method="POST" enctype="multipart/form-data">
					{{ method_field('POST') }}
					{{ csrf_field() }}
					<h4>Nueva inscripcion</h4>

					<div class="form-group {{ $errors->has('periodo')?'has-error':'' }}">
						<label class="control-label" for="periodo">Periodo: *</label>
						<select id="periodo" name="periodo" class="form-control">
							<option value="">Seleccione...</option>
							@foreach($periodos as $d)
								<option value="{{$d->periodo_id}}" {{ old('periodo_id')==$d->periodo_id?'selected':''}}>{{$d->periodo}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group {{ $errors->has('curso_id')?'has-error':'' }}">
						<label class="control-label" for="curso">Curso: *</label>
						<select id="curso" name="curso" class="form-control">
							<option value="">Seleccione...</option>
							@foreach($cursos as $d)
								<option value="{{$d->curso_id}}" {{ old('curso')==$d->curso_id?'selected':''}}>{{$d->titulo}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group {{ $errors->has('estudiante')?'has-error':'' }}">
						<label class="control-label" for="estudiante">Estudiante: *</label>
						<select id="estudiante" name="estudiante" class="form-control">
							<option value="">Seleccione...</option>
							@foreach($estudiantes as $d)
								<option value="{{$d->estudiante_id}}" @if($estudiante) {{$estudiante==$d->estudiante_id?'selected':''}} @else {{old('estudiante')==$d->estudiante_id?'selected':''}} @endif >{{$d->user->detalles->nombres." ".$d->user->detalles->apellidos." | ".$d->user->detalles->cedula }}</option>
							@endforeach
						</select>
					</div>

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
						<a class="btn btn-flat btn-default" href="{{route('inscripciones.index')}}"><i class="fa fa-reply"></i> Volver</a>
						<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
					</div>
				</form>
			</div>
		</div>
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#periodo,#curso,#estudiante').select2();
		});
	</script>
@endsection