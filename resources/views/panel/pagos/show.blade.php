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
	    <a class="btn btn-flat btn-default" href="{{ url('panel/pagos') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
		</section>

		<section class="perfil">
			<div class="row">
	    	<div class="col-md-12">
	    		<h2 class="page-header" style="margin-top:0!important">
            <i class="fa fa fa-credit-card-alt" aria-hidden="true"></i>
            <small class="pull-right">Registrado: {{ $pago->created_at }}</small>
            <span class="clearfix"></span>
          </h2>
	    	</div>
				<div class="col-md-4">
					<h4>Detalles del pago</h4>
					<p><b>Monto: </b> {{ number_format($pago->monto,2,",",".") }} </p>
					<p><b>Tipo: </b> {{ $pago->tipo }} </p>
					<p><b>Fecha: </b>{{$pago->fecha}}</p>
					@if ($pago->banco != '')
						<p><b>Banco: </b> {{ $pago->banco }} </p>
					    <p><b>Referencia: </b> {{ $pago->referencia }} </p>
					@endif
				</div>
				
			</div>
		</section>
@endsection