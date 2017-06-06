@extends('layouts.app')
@section('title','Cursos - '.config('app.name'))
@section('header','Cursos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li> Usuarios </li>
	  <li class="active"> Ver Usuarios </li>
	</ol>
@endsection
@section('content')
<!-- Formulario -->
		<section>
	    <a class="btn btn-flat btn-default" href="{{ url('/users') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
	    <a class="btn btn-flat btn-success" href="{{ url('/users/'.$user->id.'/edit') }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
	    <!--
	    <button class="btn btn-flat btn-danger" data-toggle="modal" data-target="#delModal"><i class="fa fa-times" aria-hidden="true"></i> Eliminar</button>
	    -->
		</section>

		<section class="perfil">
			<div class="row">
	    	<div class="col-md-12">
	    		<h2 class="page-header" style="margin-top:0!important">
            <i class="fa fa-user" aria-hidden="true"></i>
            {{ $user->nombre.'  '.$user->apellido }}
            <small class="pull-right">Registrado: {{ $user->created_at }}</small>
            <span class="clearfix"></span>
          </h2>
	    	</div>
				<div class="col-md-4">
					<h4>Detalles del Usuario</h4>
          <p><b>Cedula: </b> {{ $user->cedula }} </p>
					<p><b>Nombre: </b> {{ $user->nombre }} </p>
					<p><b>Apellido: </b> {{ $user->apellido }} </p>
          <p><b>Email: </b> {{ $user->email }} </p>
          <p><b>Telefono: </b> {{ $user->cedula }} </p>
				</div>
			
			</div>
		</section>
	</div>

	<div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="delModalLabel">Eliminar curso</h4>
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