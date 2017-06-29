@extends('layouts.app')
@section('title','Cursos - '.config('app.name'))
@section('header','Cursos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li> Cursos </li>
	  <li class="active"> Ver </li>
	</ol>
@endsection
@section('content')
<!-- Formulario -->
		<section>
	    <a class="btn btn-flat btn-default" href="{{ url('panel/dashboard') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
	    <button class="btn btn-flat btn-warning" data-toggle="modal" data-target="#iModal"><i class="fa fa-check-square-o" aria-hidden="true"></i> Inscribirse</button>
		</section>

		<div class="row">
			@include('partials.flash')
		</div>

		<section class="perfil">
			<div class="row">
	    	<div class="col-md-12">
	    		<h2 class="page-header" style="margin-top:0!important">
            <i class="fa fa-university" aria-hidden="true"></i>
            {{$curso->titulo}}
          </h2>
	    	</div>
				<div class="col-md-3">
					<h4>Detalles del curso</h4>
					<p><b>Titulo:</b> {{$curso->titulo}}</p>
					<p><b>Descripcion: </b> {{ $curso->descripcion }} </p>
				</div>

        <div class="col-md-3 col-md-offset-1">
          <h4>Profesor</h4>
          <img class="img-responsive" src="{{asset('images/profesores/'.$curso->profesor->user->detalles->foto)}}" alt="">
          <p><b>Nombre: </b> {{$curso->profesor->user->detalles->nombres.' '.$curso->profesor->user->detalles->apellidos}}</p>
          <p><b>Profesion: </b> {{$curso->profesor->profesion}}</p>
          <p><b>Telefono: </b> {{$curso->profesor->user->detalles->tlf_personal}}</p>
        </div>
			</div>
		</section>
	</div>

	<div id="iModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="iModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="iModalLabel">{{$curso->titulo}}</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <form id="delProduct" class="col-md-8 col-md-offset-2" action="{{url('panel/cursos')}}" method="POST">
              <input type="hidden" name="curso" value="{{$curso->curso_id}}">
              {{ csrf_field() }}
              <h4 class="text-center">Inscripcion</h4><br>              

							<div class="form-group {{ $errors->has('periodo')?'has-error':'' }}">
								<label class="control-label" for="periodo">Periodo: *</label>
								<select id="periodo" name="periodo" class="form-control" required>
									<option value="">Seleccione...</option>
									@foreach($periodos as $d)
										<option value="{{$d->periodo_id}}" @if(old('periodo')) {{ old('periodo_id')==$d->periodo_id?'selected':''}} @endif >{{$d->periodo}}</option>
									@endforeach
								</select>
							</div>

              <center>
                <button class="btn btn-flat btn-warning" type="submit">Inscribirse</button>
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection