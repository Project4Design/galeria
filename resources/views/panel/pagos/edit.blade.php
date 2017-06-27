@extends('layouts.app')
@section('title','Pagos - '.config('app.name'))
@section('header','Pagos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li> Pagos </li>
	  <li class="active">Agregar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form class="" action="{{ url('panel/pagos/'.$pago->pago_id) }}" method="POST">
					{{method_field('PUT')}}
					{{ csrf_field() }}
					<h4>Modificar Pago</h4>

					<div class="form-group {{ $errors->has('inscripcion_id')?'has-error':'' }}">
						<label class="control-label" for="nombres">Inscripcion:</label>
						<select  class="form-control" name="inscripcion_id">
							<option value="">Seleccione...</option>
							@foreach($inscripciones as $i)
								<option value="{{$i->inscripcion_id}}" @if($i->inscripcion_id == $pago->inscripcion_id) selected @endif>{{$i->curso->titulo.'    ||     '.$i->estudiante->user->detalles->nombres}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group {{ $errors->has('tipo')?'has-error':'' }}">
						<label class="control-label" for="apellidos">Tipo de pago:</label>
							<select id="tipo_pago" class="form-control" name="tipo">
								<option value="">Seleccione...</option>
								<option value="Deposito" @if($pago->tipo == "Deposito") selected @endif>Deposito</option>
								<option value="Transferencia" @if($pago->tipo == "Transferencia") selected @endif>Transferencia</option>
								<option value="Efectivo" @if($pago->tipo == "Efectivo") selected @endif>Efectivo</option>
							</select>
					</div>
				<section style="display:none" id="section_pago">
					<div class="form-group {{ $errors->has('banco')?'has-error':'' }}">
						<label class="control-label" for="banc">Banco.:</label>
						<select  id="banco" class="form-control" name="banco">
							<option value="">Seleccione...</option>
							<option value="Banco Provincial" @if($pago->banco == "Banco Provincial") selected @endif>Banco Provincial</option>
							<option value="Banco Bicentenario" @if($pago->banco == "Banco Bicentenario") selected @endif>Banco Bicentenario</option>
							<option value="Banco Mercantil" @if($pago->banco == "Banco Mercantil") selected @endif>Banco Mercantil</option>
						</select>
					</div>

					<div class="form-group {{ $errors->has('referencia')?'has-error':'' }}">
						<label class="control-label" for="referencia">Referencia:</label>
						<input id="referencia" class="form-control" type="number" name="referencia"  placeholder="Referencia" value="{{$pago->referencia}}">
					</div>
				</section>
					
					
					<div class="form-group {{ $errors->has('monto')?'has-error':'' }}">
						<label class="control-label" for="monto">Monto BsF.:</label>
						<input id="monto" class="form-control" type="text" name="monto"  placeholder="BsF." value="{{$pago->monto}}">
					</div>

					<div class="form-group {{ $errors->has('fecha')?'has-error':'' }}">
						<label class="control-label" for="fecha">Fecha:</label>
						<input id="fecha" class="form-control fecha" type="text" name="fecha"  placeholder="Fecha" value="{{$pago->fecha}}">
					</div>

					@if (count($errors) > 0)
          <div class="alert alert-danger alert-important">
	          <ul>
	            @foreach($errors->all() as $error)
	               <li>{{$error}}</li>
	             @endforeach
	           </ul>  
          </div>
        	@endif

					<div class="form-group text-right">
						<a class="btn btn-flat btn-default" href="{{route('pagos.index')}}"><i class="fa fa-reply"></i> Volver</a>
						<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
					</div>
				</form>
			</div>
		</div>
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			//$('#inscripcion').select2();
			$('.fecha').datepicker();

			//funcion para campo de tipo_pago
			var select = $('#tipo_pago');
			select.change(function(){
				if (select.val() == 'Transferencia' || select.val() == 'Deposito' ) {
	               $("#section_pago").fadeIn(1000);
	               $('#banco,#referencia').attr('required',true);

				}else{
					$("#section_pago").fadeOut('slow/400/fast');
					$('#banco,#referencia').val('');
					$('#banco,#referencia').attr('required',false);
					
				}
	       });
		});
	</script>
@endsection