@extends('layouts.app')
@section('title','Pagos - '.config('app.name'))
@section('header','Pagos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li> Pago </li>
	  <li class="active"> Ver </li>
	</ol>
@endsection
@section('content')
<!-- Formulario -->
		<section>
	    <a class="btn btn-flat btn-default" href="{{ url('admin/pagos') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
	    @if($pago->status===2)
	    <a class="btn btn-flat btn-success" href="{{ url('admin/pagos/'.$pago->pago_id.'/edit') }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
	    <button class="btn btn-flat btn-primary" data-toggle="modal" data-target="#estModal" data-text="Aprobar" data-status="1"><i class="fa fa-check" aria-hidden="true"></i> Aprobar</button>
	    <button class="btn btn-flat btn-danger" data-toggle="modal" data-target="#estModal" data-text="Rechazar" data-status="0"><i class="fa fa-times" aria-hidden="true"></i> Rechazar</button>
	    @endif
		</section>
			
		<div class="row">
			@include('partials.flash')
		</div>

		<section class="perfil">
			<div class="row">
	    	<div class="col-md-12">
	    		<h2 class="page-header" style="margin-top:0!important">
            <i class="fa fa fa-credit-card-alt" aria-hidden="true"></i>
            {{-- {{ $curso->titulo }} --}}
            <small class="pull-right">Registrado: {{ $pago->created_at }}</small>
            <span class="clearfix"></span>
          </h2>
	    	</div>
				<div class="col-md-4">
					<h4>Detalles del pago</h4>
					<p><b>Estado: </b> {!! $pago->status() !!} </p>
					<p><b>Monto: </b> {{ number_format($pago->monto,2,",",".") }} </p>
					<p><b>Tipo: </b> {{ $pago->tipo }} </p>
					<p><b>Fecha: </b>{{$pago->fecha}}</p>
					@if ($pago->banco != '')
						<p><b>Banco: </b> {{ $pago->banco }} </p>
					    <p><b>Referencia: </b> {{ $pago->referencia }} </p>
					@endif
				</div>
				<div class="col-md-4">
					<h4>Detalles del curso <small><a href="{{url('admin/cursos/'.$pago->inscripcion->curso_id)}}">(Ver curso)</a></small></h4>
					<p><b>Periodo: </b> {{ $pago->inscripcion->periodo->periodo }} </p>
					<p><b>Curso: </b> {{ $pago->inscripcion->curso->titulo }} </p>
				</div>
				<div class="col-md-4">
					<h4>Detalles del estudiante <small><a href="{{url('admin/estudiantes/'.$pago->inscripcion->estudiante_id)}}">(Ver estudiante)</a></small></h4>
					<p><b>Nombre: </b> {{$pago->inscripcion->estudiante->user->detalles->nombres." ".$pago->inscripcion->estudiante->user->detalles->apellidos}}</p>
					<p><b>Cedula: </b> {{ number_format($pago->inscripcion->estudiante->user->detalles->cedula,0,",",".") }} </p>
					<p><b>Telefono: </b> {{ $pago->inscripcion->estudiante->user->detalles->tlf_personal }} </p>
				</div>
				
			</div>
		</section>

		<div id="estModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="estModalLabel">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	          <h4 class="modal-title" id="estModalLabel"></h4>
	        </div>
	        <div class="modal-body">
	          <div class="row">
	            <form id="delProduct" class="col-md-8 col-md-offset-2" action="{{url('admin/pagos/'.$pago->pago_id.'/estado')}}" method="POST">
	              <input type="hidden" name="_method" value="PATCH">
	              <input id="status" type="hidden" name="status" value="2">
	              {{ csrf_field() }}
	              <h4 class="text-center">Esta seguro de <b><span id="text"></span></b> este pago?</h4><br>

	              <center>
	                <button class="btn btn-flat btn-danger" type="submit">Enviar</button>
	                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cancelar</button>
	              </center>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
@endsection
@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#estModal').on('show.bs.modal', function (event) {
			  var button = $(event.relatedTarget);
			  var text = button.data('text');
			  var status = button.data('status');
			  var modal = $(this);
			  modal.find('.modal-body #status').val(status);
			  modal.find('.modal-title').text(text);
			  modal.find('.modal-body #text').text(text);
			})
		});
	</script>
@endsection