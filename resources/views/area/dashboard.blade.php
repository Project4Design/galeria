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
    <!--
      <div class="col-md-2 col-md-offset-1 col-sm-6 col-xs-12">
        <div class="small-box bg-red">
          <div class="inner">
            <h3>0</h3>
            <p>Usuarios</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="{{ route('users.index') }}" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      -->
    </div><!--row-->
  @include('partials.flash')
	  <div class="row">
	    <div class="col-md-12">
	      <div class="box box-success">
		      <div class="box-header with-border">
		        <h3 class="box-title"><i class="fa fa-university"></i> Cursos a cargo</h3>
		        <span class="pull-right">
						</span>
		      </div>
	      	<div class="box-body">
						<table class="table data-table table-bordered table-hover table-condensed">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Periodo</th>
									<th class="text-center">Titulo</th>
									<th class="text-center">Inscritos</th>
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
										<td>{{count($d->curso->estudiantesByPeriodo($d->periodo_id)).'/'.$d->curso->limit}}</td>
										<td>
											<a class="btn btn-primary btn-flat btn-sm" href="{{ url('area/cursos/'.$d->curso_id.'/'.$d->periodo_id) }}"><i class="fa fa-search"></i></a>
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

	</section><!-- /.content -->
@endsection