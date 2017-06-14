@extends('layouts.app')
@section('title','Cursos - '.config('app.name'))
@section('header','Cursos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li class="active"> Cursos </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<!-- Info boxes -->
  <div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ count($cursos) }}</h3>
          <p>Cursos</p>
        </div>
        <div class="icon">
          <i class="fa fa-university"></i>
        </div>
      </div>
    </div>
  </div><!--row-->

	<div class="row">
  	<div class="col-md-12">
    	<div class="box box-success">
	      <div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-university"></i> Cursos</h3>
	        <span class="pull-right">
						<a href="{{ route('cursos.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo curso</a>
					</span>
	      </div>
      	<div class="box-body">
					<table class="table data-table table-bordered table-hover table-cond}ensed">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Titulo</th>
								<th class="text-center">Precio</th>
								<th class="text-center">Profesor</th>
								<th class="text-center">Registrado</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@php $i=1; @endphp
							@foreach($cursos as $d)	
								<tr>
									<td>{{$i}}</td>
									<td>{{$d->titulo}}</td>
									<td class="text-right">{{number_format($d->precio,2,",",".")}}</td>
									<td>{{$d->profesor->nombre." ".$d->profesor->apellido}}</td>
									<td>{{$d->created_at}}</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ url('admin/cursos/'.$d->curso_id) }}"><i class="fa fa-search"></i></a>
										<a href="{{ url('admin/cursos/'.$d->curso_id.'/edit') }}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
									</td>
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