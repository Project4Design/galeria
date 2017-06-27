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
	    <a class="btn btn-flat btn-default" href="{{ url('area/dashboard') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
	    <button class="btn btn-flat btn-warning" data-toggle="modal" data-target="#notaModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Asignar Notas</button>
		</section>

		<section>
			<div class="row">
				@include('partials.flash')
			</div>
		</section>

		<section class="perfil">
			<div class="row">
	    	<div class="col-md-12">
	    		<h2 class="page-header" style="margin-top:0!important">
            <i class="fa fa-university" aria-hidden="true"></i>
            {{ $curso->titulo }}
            <small class="pull-right">Registrado: {{ $curso->created_at }}</small>
            <span class="clearfix"></span>
          </h2>
	    	</div>
				<div class="col-md-4">
					<h4>Detalles del curso</h4>
					<p><b>Titulo: </b> {{ $curso->titulo }} </p>
					<p><b>Descripcion: </b> {{ $curso->descripcion }} </p>
					<p><b>Inscritos: </b> {{count($curso->estudiantesByPeriodo($periodo->periodo_id)).'/'.$curso->limit}} </p>
				</div>
				<div class="col-md-3">
					<h4>Imagen del curso</h4>
					<img class="img-responsive" src="{{ asset('/images/cursos/'.$curso->foto) }}">
				</div>
				<div class="col-md-3">
					<h4>Periodo: <b>{{$periodo->periodo}}</b></h4>
				</div>
			</div>
		</section>

		<section>
			<div class="row">
				<div class="col-md-12">
		    	<div class="box box-danger">
			      <div class="box-header with-border">
			        <h3 class="box-title"><i class="fa fa-address-book-o"></i> Estudiantes</h3>
			        <span class="pull-right">
							</span>
			      </div>
		      	<div class="box-body">
							<table class="table data-table table-bordered table-hover table-condensed">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Cedula</th>
										<th class="text-center">Nombres</th>
										<th class="text-center">Apellidos</th>
										<th class="text-center">Email</th>
										<th class="text-center">Telefono personal</th>
										<th class="text-center">Nota</th>
									</tr>
								</thead>
								<tbody class="text-center">
									@php $i=1; @endphp
									@foreach($estudiantes as $d)
										<tr>
											<td>{{$i}}</td>
											<td>{{number_format($d->estudiante->user->detalles->cedula,0,",",".")}}</td>
											<td>{{$d->estudiante->user->detalles->nombres}}</td>
											<td>{{$d->estudiante->user->detalles->apellidos}}</td>
											<td>{{$d->estudiante->user->email}}</td>
											<td>{{$d->estudiante->user->detalles->tlf_personal}}</td>
											<td>{{$d->nota->nota?$d->nota->nota:'-'}}</td>
										</tr>
										@php $i++; @endphp
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>

		<div id="notaModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="notaModalLabel">
	    <div class="modal-dialog modal-lg" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	          <h4 class="modal-title" id="notaModalLabel">Asignar notas</h4>
	        </div>
	        <div class="modal-body">
	          <div class="row">
	            <form class="col-md-10 col-md-offset-1" action="{{url('area/cursos/'.$curso->curso_id.'/'.$periodo->periodo_id)}}" method="POST">
	              <input type="hidden" name="_method" value="PATCH">
	              {{ csrf_field() }}
	              <h4 class="text-center">Asignacion de notas</h4><br>
	              <table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">Cedula</th>
											<th class="text-center">Nombres</th>
											<th class="text-center">Apellidos</th>
											<th class="text-center" width="15%">Nota</th>
										</tr>
									</thead>
									<tbody class="text-center">
										@php $i=1; @endphp
										@foreach($estudiantes as $d)
											<tr>
												<td>{{$i}}</td>
												<td>{{number_format($d->estudiante->user->detalles->cedula,0,",",".")}}</td>
												<td>{{$d->estudiante->user->detalles->nombres}}</td>
												<td>{{$d->estudiante->user->detalles->apellidos}}</td>
												<td>
													<input class="form-control" type="number" name="nota_{{$i}}" value="{{$d->nota->nota?$d->nota->nota:''}}" min="1" max="100">
													<input type="hidden" name="id_{{$i}}" value="{{$d->inscripcion_id}}">
												</td>
											</tr>
											@php $i++; @endphp
										@endforeach
									</tbody>
								</table>
	              <div class="form-group">
	                <div class="progress" style="display:none">
	                  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
	                  </div>
	                </div>
	                <div class="alert" style="display:none" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;<span id="msj"></span></div>
	              </div>

	              <center>
	                <button class="btn btn-flat btn-danger" type="submit">Asignar</button>
	                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cancelar</button>
	              </center>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
@endsection