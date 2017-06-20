@extends('layouts.app')
@section('title','Bitacora - '.config('app.name'))
@section('header','Bitacora')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li class="active"> Bitacora </li>
	</ol>
@endsection
@section('content')
	<!-- Info boxes -->
  <div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ count($bitacora) }}</h3>
          <p>Bitacora</p>
        </div>
        <div class="icon">
          <i class="fa fa-book"></i>
        </div>
      </div>
    </div>
  </div><!--row-->

	<div class="row">
  	<div class="col-md-12">
    	<div class="box box-success">
	      <div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-book"></i> Bitacora</h3>
	        <span class="pull-right">
					</span>
	      </div>
      	<div class="box-body">
					<table class="table data-table table-bordered table-hover table-cond}ensed">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Usuario</th>
								<th class="text-center">Modulo</th>
								<th class="text-center">Accion</th>
								<th class="text-center">Registrado</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@php $i=1; @endphp
							@foreach($bitacora as $d)	
								<tr>
									<td>{{$i}}</td>
									<td>{{$d->usuario}}</td>
									<td>{{$d->modulo}}</td>
									<td>{{$d->accion}}</td>
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