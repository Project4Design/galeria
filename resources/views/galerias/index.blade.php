@extends('layouts.app')
@section('title','Galeria - '.config('app.name'))
@section('header','Cuadros')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li class="active"> Cuadros </li>
	</ol>
@endsection
@section('content')
	
	<!-- Info boxes -->
  <div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ count($cuadros) }}</h3>
          <p>Cuadros</p>
        </div>
        <div class="icon">
          <i class="fa fa-file-image-o"></i>
        </div>
      </div>
    </div>
  </div><!--row-->
  @include('partials.flash')

	<div class="row">
  	<div class="col-md-12">
    	<div class="box box-success">
	      <div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-file-image-o"></i> Cuadros</h3>
	        <span class="pull-right">
						<a href="{{ route('galeria.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo cuadro</a>
					</span>
	      </div>
      	<div class="box-body">
					<table class="table data-table table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Titulo</th>
								<th class="text-center">Autor</th>
								<th class="text-center">Año</th>
								<th class="text-center">Cuadro</th>
								<th class="text-center">Registrado</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@php $i=1; @endphp
							@foreach($cuadros as $d)	
								<tr>
									<td>{{$i}}</td>
									<td>{{$d->titulo}}</td>
									<td>{{$d->autor}}</td>
									<td>{{$d->anio}}</td>
									<td>
										<img src="{{asset('images/cuadros/'.$d->foto)}}" alt="{{ $d->nombre }}" height="60px" width="60px" class="img-responsive img-thumbnail">
									</td>
									<td>{{$d->created_at}}</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ url('admin/galeria/'.$d->id) }}"><i class="fa fa-search"></i></a>
										<a href="{{ url('admin/galeria/'.$d->id.'/edit') }}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
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