@extends('layouts.app')
@section('title','Inicio - '.config('app.name'))
@section('header','Inicio')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li class="active"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</li>
	</ol>
@endsection
@section('content')

	<section class="content">
		<!-- Info boxes -->
    <div class="row">
    </div><!--row-->
  @include('partials.flash')
	  <div class="row">
	    <div class="col-md-12">
	      <div class="box box-success">
		      <div class="box-header with-border">
		        <h3 class="box-title"><i class="fa fa-university"></i> Cursos inscritos</h3>
		      </div>
	      	<div class="box-body">
						<table class="table data-table table-bordered table-hover table-condensed">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">periodo</th>
									<th class="text-center">Titulo</th>
									<th class="text-center">Inscrito</th>
									<th class="text-center">Nota</th>
									<th class="text-center">Accion</th>
								</tr>
							</thead>
							<tbody class="text-center">
								@php $i=1; @endphp
								@foreach($cursos as $d)	
									<tr>
										<td>{{$i}}</td>
										<td>{{$d->periodo->periodo}}</td>
										<td>{{$d->curso->titulo}}</td>
										<td>{{$d->created_at}}</td>
										<td>{{$d->nota->nota?$d->nota->nota:'-'}}</td>
										<td>
											<a class="btn btn-primary btn-flat btn-sm" href="{{ url('panel/ver/'.$d->inscripcion_id) }}"><i class="fa fa-search"></i></a>
										</td>
									</tr>
									@php $i++; @endphp
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
	    </div><!-- /.col -->
	  </div><!-- /.row -->
	  <div class="row">
	  	<div class="col-md-12">
	  		<h3 class="text-center">Cursos disponibles</h3>
	  		@foreach($disponibles AS $d)
	  			<div class="col-md-3" style="background-color:#fff;padding:10px;margin:5px;border:1px solid #ccc;">
	  				<img class="img-responsive" src="{{asset('images/cursos/'.$d->foto)}}">
	  				<p><b>{{$d->titulo}}</b></p>
	  				<p>Bs. {{number_format($d->precio,0,",",".")}}</p>
	  				<a href="{{url('/panel/cursos/'.$d->curso_id)}}">Ver detalles</a>
	  			</div>
	  		@endforeach
	  	</div>
	  </div>
	</section><!-- /.content -->
@endsection