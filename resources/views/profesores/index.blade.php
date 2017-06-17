@extends('layouts.app')
@section('title','Profesores - '.config('app.name'))
@section('header','Profesores')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li class="active"> Profesores </li>
	</ol>
@endsection
@section('content')
	
	<!-- Info boxes -->
  <div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ count($profesores) }}</h3>
          <p>Profesores</p>
        </div>
        <div class="icon">
          <i class="fa fa-user-circle"></i>
        </div>
      </div>
    </div>
  </div><!--row-->
  @include('partials.flash')

	<div class="row">
  	<div class="col-md-12">
    	<div class="box box-success">
	      <div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-user-circle"></i> Profesores</h3>
	        <span class="pull-right">
						<a href="{{ route('profesores.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo profesor</a>
					</span>
	      </div>
      	<div class="box-body">
					<table class="table data-table table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Cedula</th>
								<th class="text-center">Nombre</th>
								<th class="text-center">Apellido</th>
								<th class="text-center">Correo</th>
								<th class="text-center">Telefono</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@php $i=1; @endphp
							@foreach($profesores as $d)
								<tr>
									<td>{{$i}}</td>
									<td>{{$d->user->detalles->cedula}}</td>
									<td>{{$d->user->detalles->nombres}}</td>
									<td>{{$d->user->detalles->apellidos}}</td>
									<td>{{$d->user->email}}</td>
									<td>{{$d->created_at}}</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ url('admin/profesores/'.$d->id) }}"><i class="fa fa-search"></i></a>
										<a href="{{ url('admin/profesores/'.$d->id.'/edit') }}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
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