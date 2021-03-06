@extends('layouts.app')
@section('title','Representantes - '.config('app.name'))
@section('header','Representantes')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('admin_index')}}"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li class="active"> Representantes </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<!-- Info boxes -->
  <div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{ count($representantes) }}</h3>
          <p>Representantes</p>
        </div>
        <div class="icon">
          <i class="fa fa-address-card-o"></i>
        </div>
      </div>
    </div>
  </div><!--row-->

	<div class="row">
  	<div class="col-md-12">
    	<div class="box box-danger">
	      <div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-address-card-o"></i> Representantes</h3>
	        <span class="pull-right">
	        <!--
						<a href="{{ route('representantes.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo representante</a>
					-->
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
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@php $i=1; @endphp
							@foreach($representantes as $d)
								<tr>
									<td>{{$i}}</td>
									<td>{{number_format($d->user->detalles->cedula,0,",","0")}}</td>
									<td>{{$d->user->detalles->nombres}}</td>
									<td>{{$d->user->detalles->apellidos}}</td>
									<td>{{$d->user->email}}</td>
									<td>{{$d->user->detalles->tlf_personal}}</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ url('admin/representantes/'.$d->representante_id) }}"><i class="fa fa-search"></i></a>
										<a  href="{{ url('admin/representantes/'.$d->representante_id.'/edit') }}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
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