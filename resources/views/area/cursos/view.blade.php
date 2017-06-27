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
					<p><b>Descripcion: </b> {{ $curso->descripcion }} </p>
				</div>
				<div class="col-md-3">
					<h4>Imagen del curso</h4>
					<img class="img-responsive" src="{{ asset('/images/cursos/'.$curso->foto) }}">
				</div>
				<div class="col-md-3">
					<h4>Periodo: <b>{{$periodo}}</b></h4>
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

		<div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delModalLabel">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	          <h4 class="modal-title" id="delModalLabel">Eliminar curso</h4>
	        </div>
	        <div class="modal-body">
	          <div class="row">
	            <form id="delProduct" class="col-md-8 col-md-offset-2" action="{{url('admin/cursos/'.$curso->curso_id)}}" method="POST">
	              <input type="hidden" name="_method" value="DELETE">
	              {{ csrf_field() }}
	              <h4 class="text-center">Esta seguro de eliminar este curso?</h4><br>

	              <div class="form-group">
	                <div class="progress" style="display:none">
	                  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
	                  </div>
	                </div>
	                <div class="alert" style="display:none" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;<span id="msj"></span></div>
	              </div>
	              <center>
	                <button class="btn btn-flat btn-danger" type="submit">Eliminar</button>
	                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cancelar</button>
	              </center>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
@endsection