@extends('layouts.app')
@section('title','Pagos - '.config('app.name'))
@section('header','Pagos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('admin_index')}}"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li class="active"> Pagos </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<!-- Info boxes -->
  <div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{ count($pagos) }}</h3>
          <p>Pagos</p>
        </div>
        <div class="icon">
          <i class="fa fa fa-credit-card-alt"></i>
        </div>
      </div>
    </div>
  </div><!--row-->

	<div class="row">
  	<div class="col-md-12">
    	<div class="box box-danger">
	      <div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-credit-card-alt"></i> Pagos</h3>
	        <span class="pull-right">
						<a href="{{ route('pagos.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo pago</a>
					</span>
	      </div>
      	<div class="box-body">
					<table class="table data-table table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Periodo</th>
								<th class="text-center">Curso</th>
								<th class="text-center">Estudiante</th>
								<th class="text-center">Tipo</th>
								<th class="text-center">Monto</th>
								<th class="text-center">Fecha</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@php $i=1; @endphp
							@foreach($pagos as $p)
								<tr>
									<td>{{$i}}</td>
									<td>{{$p->inscripcion->periodo->periodo}}</td>
									<td>{{$p->inscripcion->curso->titulo}}</td>
									<td>{{$p->inscripcion->estudiante->user->detalles->nombres." ".$p->inscripcion->estudiante->user->detalles->apellidos}}</td>
									<td>{{$p->tipo}}</td>
									<td>{{number_format($p->monto,2,",",".")}}</td>
									<td>{{$p->fecha}}</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ url('admin/pagos/'.$p->pago_id) }}"><i class="fa fa-search"></i></a>
										<a  href="{{ url('admin/pagos/'.$p->pago_id.'/edit') }}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
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