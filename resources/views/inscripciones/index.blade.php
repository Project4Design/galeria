@extends('layouts.app')
@section('title','Inscripciones - '.config('app.name'))
@section('header','Inscripciones')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li class="active"> Inscripciones </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<!-- Info boxes -->
  <div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ count($inscripciones) }}</h3>
          <p>Inscripciones</p>
        </div>
        <div class="icon">
          <i class="fa fa-check-square-o"></i>
        </div>
      </div>
    </div>
  </div><!--row-->

	<div class="row">
  	<div class="col-md-12">
    	<div class="box box-success">
	      <div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-check-square-o"></i> Inscripciones</h3>
	        <span class="pull-right">
						<a href="{{ route('inscripciones.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nueva inscripcion</a>
					</span>
	      </div>
      	<div class="box-body">
					<table class="table data-table table-bordered table-hover table-cond}ensed">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Periodo</th>
								<th class="text-center">Curso</th>
								<th class="text-center">Estudiante</th>
								<th class="text-center">Fecha</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@php $i=1; @endphp
							@foreach($inscripciones as $d)
								<tr>
									<td>{{$i}}</td>
									<td><a href="{{ url('admin/periodos/'.$d->periodo->periodo_id) }}">{{$d->periodo->periodo}}</td>
									<td><a href="{{ url('admin/cursos/'.$d->curso->curso_id) }}">{{$d->curso->titulo}}</td>
									<td><a href="{{ url('admin/estudiantes/'.$d->estudiante->estudiante_id) }}">{{$d->estudiante->user->detalles->nombres." ".$d->estudiante->user->detalles->apellidos}}</a></td>
									<td>{{$d->created_at}}</td>
								</tr>
								@php $i++; @endphp
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection