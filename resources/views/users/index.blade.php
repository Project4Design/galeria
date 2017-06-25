@extends('layouts.app')
@section('title','Usuarios - '.config('app.name'))
@section('header','Usuarios')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('admin_index')}}"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li class="active"> Usuarios </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<!-- Info boxes -->
  <div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{ count($users) }}</h3>
          <p>Usuarios</p>
        </div>
        <div class="icon">
          <i class="fa fa-user"></i>
        </div>
      </div>
    </div>
  </div><!--row-->

	<div class="row">
  	<div class="col-md-12">
    	<div class="box box-danger">
	      <div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-users"></i> Usuarios</h3>
	        <span class="pull-right">
	        			<a href="{{ route('pdf.usuarios') }}" class="btn btn-flat btn-danger"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
	        				&nbsp;&nbsp;
						<a href="{{ route('users.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo usuario</a>
					</span>
	      </div>
      	<div class="box-body">
					<table class="table data-table table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Nombres</th>
								<th class="text-center">Apellidos</th>
								<th class="text-center">Email</th>
								<th class="text-center">Telefono</th>
								<th class="text-center">Nivel</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@php $i=1; @endphp
							@foreach($users as $d)
								<tr>
									<td>{{$i}}</td>
									<td>{{$d->detalles->nombres}}</td>
									<td>{{$d->detalles->apellidos}}</td>
									<td>{{$d->email}}</td>
									<td>{{$d->detalles->tlf_personal}}</td>
									<td>{{$d->nivel()}}</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ url('admin/users/'.$d->id) }}"><i class="fa fa-search"></i></a>
										<a  href="{{ url('admin/users/'.$d->id.'/edit') }}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
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