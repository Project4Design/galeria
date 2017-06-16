@extends('layouts.app')
@section('title','Periodos - '.config('app.name'))
@section('header','Periodos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li class="active"> Periodos </li>
	</ol>
@endsection
@section('content')
	
	<!-- Info boxes -->
  <div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ count($periodos) }}</h3>
          <p>Periodos</p>
        </div>
        <div class="icon">
          <i class="fa fa-calendar"></i>
        </div>
      </div>
    </div>
  </div><!--row-->
  @include('partials.flash')

	<div class="row">
  	<div class="col-md-12">
    	<div class="box box-success">
	      <div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-calendar"></i> Periodos</h3>
	        <span class="pull-right">
						<a href="{{ route('periodos.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo periodo</a>
					</span>
	      </div>
      	<div class="box-body">
					<table class="table data-table table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Periodo</th>
								<th class="text-center">Estado</th>
								<th class="text-center">Inscripciones</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@php $i=1; @endphp
							@foreach($periodos as $d)	
								<tr>
									<td>{{$i}}</td>
									<td>{{$d->periodo}}</td>
									<td>{{$d->status?'Abierto':'Cerrado'}}</td>
									<td>0</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ url('admin/periodos/'.$d->periodo_id) }}"><i class="fa fa-search"></i></a>
										<a href="{{ url('admin/periodos/'.$d->periodo_id.'/edit') }}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
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