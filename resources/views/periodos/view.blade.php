@extends('layouts.app')
@section('title','Periodos - '.config('app.name'))
@section('header','Periodos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('admin_index')}}"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li> Periodos </li>
	  <li class="active">Ver </li>
	</ol>
@endsection
@section('content')
<!-- Formulario -->
		<section>
	    <a class="btn btn-flat btn-default" href="{{ route('periodos.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
	    <a class="btn btn-flat btn-success" href="{{ url('admin/periodos/'.$periodo->periodo_id.'/edit') }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
	    <button class="btn btn-flat btn-danger" data-toggle="modal" data-target="#delModal"><i class="fa fa-times" aria-hidden="true"></i> Eliminar</button>
      @if($periodo->status===1)
      <button class="btn btn-flat btn-primary" data-toggle="modal" data-target="#periodoModal"><i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar periodo</button>
      @endif
		</section>

		<section>
			<div class="row">
				<div class="col-md-12">&nbsp;</div>
				<div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-danger">
            <div class="box-body box-profile">
              <p class="text-muted text-center">Periodo</p>
              <h3 class="profile-username text-center">{{$periodo->periodo}}</h3>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item text-muted">
                  <b>Registrado</b> <span class="pull-right">{{ $periodo->created_at }}</span>
                </li>
                <li class="list-group-item">
                  <b>Estado</b> <span class="pull-right">{!! $periodo->status===1?'<span class="label label-success">Abierto</span>':'<span class="label label-danger">Cerrado</span>' !!}</span>
                </li>
                <li class="list-group-item">
                  <b>Cursos</b> <span class="pull-right">{{count($cursos)}}</span>
                </li>
                <li class="list-group-item">
                  <b>Estudiantes</b> <span class="pull-right">{{count($estudiantes)}}</span>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-9">
        	<div class="box box-success">
			      <div class="box-header with-border">
			        <h3 class="box-title"><i class="fa fa-university"></i> Cursos en este periodo</h3>
			      </div>
		      	<div class="box-body">
							<table class="table data-table table-bordered table-hover table-condensed">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Titulo</th>
										<th class="text-center">Precio</th>
										<th class="text-center">Accion</th>
									</tr>
								</thead>
								<tbody class="text-center">
									@php $i=1; @endphp
									@foreach($cursos as $d)	
										<tr>
											<td>{{$i}}</td>
											<td>{{$d->titulo}}</td>
											<td>{{$d->created_at}}</td>
											<td>
												<a class="btn btn-primary btn-flat btn-sm" href="{{ url('admin/cursos/'.$d->id) }}"><i class="fa fa-search"></i></a>
											</td>
										</tr>
										@php $i++; @endphp
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
        </div>

        <div class="col-md-9 col-md-offset-3">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-address-book-o"></i> Estudiantes inscritos</h3>
            </div>
            <div class="box-body">
              <table class="table data-table table-bordered table-hover table-condensed">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Cedula</th>
                    <th class="text-center">Nombres</th>
                    <th class="text-center">Apellidos</th>
                    <th class="text-center">Accion</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  @php $i=1; @endphp
                  @foreach($estudiantes as $d) 
                    <tr>
                      <td>{{$d->cedula}}</td>
                      <td>{{$d->nombres}}</td>
                      <td>{{$d->apellidos}}</td>
                      <td>
                        <a class="btn btn-primary btn-flat btn-sm" href="{{ url('admin/estudiantes/'.$d->estudiante_id) }}"><i class="fa fa-search"></i></a>
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
		</section>
	</div>

	<div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="delModalLabel">Eliminar periodo</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <form id="delProduct" class="col-md-8 col-md-offset-2" action="{{url('admin/periodos/'.$periodo->periodo_id)}}" method="POST">
              <input type="hidden" name="_method" value="DELETE">
              {{ csrf_field() }}
              <h4 class="text-center">Esta seguro de eliminar este periodo?</h4><br>

              <div class="form-group">
                <div class="progress" style="display:none">
                  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                  </div>
                </div>
                <div class="alert" style="display:none" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;<span id="msj"></span></div>
              </div>
              <center>
                <button class="btn btn-flat btn-danger" type="submit">Eliminar</button>
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cerrar</button>
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection