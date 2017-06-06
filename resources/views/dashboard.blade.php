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
      <div class="col-md-2 col-md-offset-1 col-sm-6 col-xs-12">
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{count($users)}}</h3>
            <p>Usuarios</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="{{ url('admin/users') }}" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
			
      <div class="col-md-2 col-sm-6 col-xs-12">
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{count($cursos)}}</h3>
            <p>Cursos</p>
          </div>
          <div class="icon">
            <i class="fa fa-university"></i>
          </div>
          <a href="{{ url('admin/cursos') }}" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>



      <div class="col-md-2 col-sm-6 col-xs-12">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>0</h3>
            <p>Pagos</p>
          </div>
          <div class="icon">
            <i class="fa fa-credit-card"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <div class="col-md-2 col-sm-6 col-xs-12">
        <div class="small-box bg-blue">
          <div class="inner">
            <h3>0</h3>
            <p>Profesores</p>
          </div>
          <div class="icon">
            <i class="fa fa-address-card"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <div class="col-md-2 col-sm-6 col-xs-12">
        <div class="small-box bg-purple">
          <div class="inner">
            <h3>0</h3>
            <p>Estudiantes</p>
          </div>
          <div class="icon">
            <i class="fa fa-address-book-o"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
    </div><!--row-->
  @include('partials.flash')
	  <div class="row">
	    <div class="col-md-12">
	      <div class="box box-success">
		      <div class="box-header with-border">
		        <h3 class="box-title"><i class="fa fa-university"></i> Crusos</h3>
		        <span class="pull-right">
							<a href="{{ route('cursos.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo curso</a>
						</span>
		      </div>
	      	<div class="box-body">
						<table class="table data-table table-bordered table-hover table-condensed">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Titulo</th>
									<th class="text-center">Precio</th>
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
	    </div><!-- /.col -->
	  </div><!-- /.row -->

	</section><!-- /.content -->
@endsection