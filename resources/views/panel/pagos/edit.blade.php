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
					{{method_field('PATCH')}}
					{{ csrf_field() }}
					<h4>Modificar Pago</h4>

					<div class="form-group {{ $errors->has('tipo')?'has-error':'' }}">
						<label class="control-label" for="tipo_pago">Tipo de pago:</label>
							<select id="tipo_pago" class="form-control" name="tipo">
								<option value="">Seleccione...</option>
								<option value="Deposito" @if(old('tipo')) {{old('tipo')=='Deposito'?'selected':''}} @else {{$pago->tipo=='Deposito'?'selected':''}} @endif>Deposito</option>
								<option value="Transferencia" @if(old('tipo')) {{old('tipo')=='Transferencia'?'selected':''}} @else {{$pago->tipo=='Transferencia'?'selected':''}} @endif>Transferencia</option>
							</select>
					</div>

					<section style="display:none" id="section_pago">
						<div class="form-group {{ $errors->has('banco')?'has-error':'' }}">
							<label class="control-label" for="banc">Banco.:</label>
							<select  id="banco" class="form-control" name="banco">
								<option value="">Seleccione...</option>
								<option value="Banco Provincial" @if(old('banco')) {{old('banco')=='Banco Provincial'?'selected':''}} @else $pago->banco=='Banco Provincial'?'selected':'' @endif>Banco Provincial</option>
								<option value="Banco Bicentenario" @if(old('banco')) {{old('banco')=='Banco Bicentenario'?'selected':''}} @else $pago->banco=='Banco Bicentenario'?'selected':'' @endif>Banco Bicentenario</option>
								<option value="Banco Mercantil" @if(old('banco')) {{old('banco')=='Banco Mercantil'?'selected':''}} @else $pago->banco=='Banco Mercantil'?'selected':'' @endif>Banco Mercantil</option>
							</select>
						</div>

						<div class="form-group {{ $errors->has('referencia')?'has-error':'' }}">
							<label class="control-label" for="referencia">Referencia:</label>
							<input id="referencia" class="form-control" type="number" name="referencia" value="{{old('referencia')?old('referencia'):$pago->referencia}}" placeholder="Referencia">
						</div>
					</section>
					
					<div class="form-group {{ $errors->has('monto')?'has-error':'' }}">
						<label class="control-label" for="monto">Monto Bs:</label>
						<input id="monto" class="form-control" type="text" name="monto"  value="{{old('monto')?old('monto'):$pago->monto}}" placeholder="Bs">
					</div>

					<div class="form-group {{ $errors->has('fecha')?'has-error':'' }}">
						<label class="control-label" for="fecha">Fecha:</label>
						<input id="fecha" class="form-control fecha" type="text" name="fecha"  value="{{old('fecha')?old('fecha'):$pago->fecha}}" placeholder="Fecha">
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