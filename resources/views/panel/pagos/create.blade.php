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
				<form class="" action="{{ url('panel/pagos') }}" method="POST" >
					{{ csrf_field() }}
					<h4>Registrar Pago</h4>
					@if(count($inscripciones)===0)
				    <div class="alert alert-danger alert-important">
				      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				      <strong class="text-center">No tienes cursos pendientes por pagar</strong> 
				  	</div>
				  @endif

					<div class="form-group {{ $errors->has('inscripcion_id')?'has-error':'' }}">
						<label class="control-label" for="inscripcion">Inscripcion: *</label>
						<select id="inscripcion" class="form-control" name="inscripcion" required>
							<option value="">Seleccione...</option>
							@foreach($inscripciones as $d)
								<option value="{{$d->inscripcion_id}}" @if(old('inscripcion')) {{old('inscripcion')==$d->inscripcion_id?'selected':''}} @endif>{{ $d->periodo->periodo.' | '.$d->curso->titulo}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group {{ $errors->has('tipo')?'has-error':'' }}">
						<label class="control-label" for="tipo_pago">Tipo de pago: *</label>
							<select id="tipo_pago" class="form-control" name="tipo" required>
								<option value="">Seleccione...</option>
								<option value="Deposito" {{old('tipo')=='Deposito'?'selected':''}} >Deposito</option>
								<option value="Transferencia" {{old('tipo')=='Transferencia'?'selected':''}}>Transferencia</option>
							</select>
					</div>

					<div class="form-group {{ $errors->has('banco')?'has-error':'' }}">
						<label class="control-label" for="banc">Banco:</label>
						<select  id="banco" class="form-control" name="banco" required>
							<option value="">Seleccione...</option>
							<option value="Banco Provincial" @if(old('banco')) {{old('banco')=='Banco Provincial'?'selected':''}} @endif>Banco Provincial</option>
							<option value="Banco Bicentenario" @if(old('banco')) {{old('banco')=='Banco Bicentenario'?'selected':''}} @endif>Banco Bicentenario</option>
							<option value="Banco Mercantil" @if(old('banco')) {{old('banco')=='Banco Mercantil'?'selected':''}} @endif>Banco Mercantil</option>
						</select>
					</div>

					<div class="form-group {{ $errors->has('referencia')?'has-error':'' }}">
						<label class="control-label" for="referencia">Referencia:</label>
						<input id="referencia" class="form-control" type="number" name="referencia" value="{{old('referencia')?old('referencia'):''}}" placeholder="Referencia" required>
					</div>
					
					<div class="form-group {{ $errors->has('monto')?'has-error':'' }}">
						<label class="control-label" for="monto">Monto Bs:</label>
						<input id="monto" class="form-control" type="text" name="monto"  value="{{old('monto')?old('monto'):''}}" placeholder="Bs" required>
					</div>

					<div class="form-group {{ $errors->has('fecha')?'has-error':'' }}">
						<label class="control-label" for="fecha">Fecha:</label>
						<input id="fecha" class="form-control fecha" type="text" name="fecha"  value="{{old('fecha')?old('fecha'):''}}" placeholder="Fecha" required>
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
						<a class="btn btn-flat btn-default" href="{{url('panel/pagos')}}"><i class="fa fa-reply"></i> Volver</a>
						<button class="btn btn-flat btn-primary" type="submit" {{$disabled}}><i class="fa fa-send"></i> Guardar</button>
					</div>
				</form>
			</div>
		</div>
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#inscripcion').select2();
			
			$('.fecha').datepicker({
				endDate: 'today',
				autoclose: true
			});
		});
	</script>
@endsection