@extends('layouts.app')
@section('title','Estudiante - '.config('app.name'))
@section('header','Estudiantes')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('admin_index')}}"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li> Estudiantes </li>
	  <li class="active">Ver </li>
	</ol>
@endsection
@section('content')
<!-- Formulario -->
		<section>
	    <a class="btn btn-flat btn-default" href="{{ route('estudiantes.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
	    <a class="btn btn-flat btn-success" href="{{ url('admin/estudiantes/'.$estudiante->estudiante_id.'/edit') }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
	    <!--
	    <button class="btn btn-flat btn-danger" data-toggle="modal" data-target="#delModal"><i class="fa fa-times" aria-hidden="true"></i> Eliminar</button>
	    -->
		</section>

		<section>
			<div class="row">
				<div class="col-md-12">&nbsp;</div>
				<div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-danger">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{asset('images/estudiantes/'.$estudiante->user->detalles->foto)}}" alt="Foto de perfil">
              <h3 class="profile-username text-center">{{$estudiante->user->detalles->nombres." ".$estudiante->user->detalles->apellidos}}</h3>

              <p class="text-muted text-center">{{$estudiante->nacimiento}} ({{$estudiante->edad()}} años)</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Cedula</b> <span class="pull-right">{{ $estudiante->user->detalles->cedula }}</span>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <span class="pull-right">{{ $estudiante->user->email }}</span>
                </li>
                <li class="list-group-item">
                  <b>Sexo</b> <span class="pull-right">{{($estudiante->sexo=='M')?'Masculino':'Femenino'}}</span>
                </li>
                <li class="list-group-item">
                  <b>Telefono personal</b> <span class="pull-right">{{$estudiante->user->detalles->tlf_personal}}</span>
                </li>
                <li class="list-group-item">
                  <b>Telefono local</b> <span class="pull-right">{{$estudiante->user->detalles->tlf_local?$estudiante->user->detalles->tlf_local:'N/A'}}</span>
                </li>
                <li class="list-group-item">
                  <b>Direccion</b> <span class="pull-right">{{$estudiante->residencia}}</span>
                </li>
                <li class="list-group-item">
                  <b>Alergico</b> <span class="pull-right">{{$estudiante->alergico?'Si':'No'}}</span>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          @if(isset($estudiante->representante->user))
          <!-- /.box -->
          <div class="box box-primary">
            <div class="box-body box-profile">
            	<h2 class="text-center">Representante</h2>
              <img class="profile-user-img img-responsive img-circle" src="{{asset('images/representantes/'.$estudiante->representante->user->detalles->foto)}}" alt="Foto de perfil">
              <h3 class="profile-username text-center">{{$estudiante->representante->user->detalles->nombres." ".$estudiante->representante->user->detalles->apellidos}}</h3>
              <p class="text-center text-muted">	<a href="{{ url('admin/representantes/'.$estudiante->representante->representante_id) }}">Ver detalles</a> </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Cedula</b> <span class="pull-right">{{ number_format($estudiante->representante->user->detalles->cedula,2,",",".") }}</span>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <span class="pull-right">{{ $estudiante->representante->user->email }}</span>
                </li>
                <li class="list-group-item">
                  <b>Telefono personal</b> <span class="pull-right">{{$estudiante->representante->user->detalles->tlf_personal}}</span>
                </li>
                <li class="list-group-item">
                  <b>Telefono local</b> <span class="pull-right">{{$estudiante->representante->user->detalles->tlf_local?$estudiante->representante->user->detalles->tlf_local:'N/A'}}</span>
                </li>
                <li class="list-group-item">
                  <b>Direccion</b> <span class="pull-right">{{$estudiante->representante->residencia}}</span>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        	@endif
        </div>

        <div class="col-md-9">
		    	<div class="box box-success">
			      <div class="box-header with-border">
			        <h3 class="box-title"><i class="fa fa-university"></i> Cursos inscritos</h3>
			      </div>
		      	<div class="box-body">
							<table class="table data-table table-bordered table-hover table-cond}ensed">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Titulo</th>
										<th class="text-center">Precio</th>
										<th class="text-center">Profesor</th>
										<th class="text-center">Accion</th>
									</tr>
								</thead>
								<tbody class="text-center">
									@php $i=1; @endphp
									@foreach($cursos as $d)	
										<tr>
											<td>{{$i}}</td>
											<td>{{$d->curso->titulo}}</td>
											<td class="text-right">{{number_format($d->curso->precio,2,",",".")}}</td>
											<td>{{$d->curso->profesor->user->detalles->nombres." ".$d->curso->profesor->user->detalles->apellidos}}</td>
											<td>
												<a class="btn btn-primary btn-flat btn-sm" href="{{ url('admin/cursos/'.$d->curso_id) }}"><i class="fa fa-search"></i></a>
											</td>
										</tr>
										@php $i++; @endphp
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
       <!-- Aqui va el cuadrod e relacion -->
			</div>
		</section>
	</div>

	<div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="delModalLabel">Eliminar estudiante</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <form id="delProduct" class="col-md-8 col-md-offset-2" action="#" method="POST">
              <input type="hidden" name="_method" value="DELETE">
              {{ csrf_field() }}
              <h4 class="text-center">Esta seguro de eliminar este curso?</h4><br>

              <div class="form-group">
                <div class="progress" style="display:none">
                  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                  </div>
                </div>
                <div class="alert" style="display:none" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;<span id="msj"></span></div>
              </div>
              <center>
                <button class="btn btn-flat btn-danger" type="submit">Save</button>
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection