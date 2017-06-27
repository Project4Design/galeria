
@extends('layouts.app')

@section('content')
  <div class="box box-primary">
  	<div class="box-header with-border">
  		<h3 class="box-title">Busqueda por fecha</h3>
  	</div>
  	<form action="{{route('pdf.pagos')}}" method="POST">
			{{ csrf_field() }}
      @include('partials.flash')
      <div class="row">
        <div class="col-md-4 col-md-offset-2">
          <div class="form-group">
            <label class="control-label">Desde:</label>
            <input type="text" name="desde" class="form-control fecha">
          </div>
        </div>
          <div class="form-group">
            <div class="col-md-4">
              <label class="control-label">Hasta:</label>
              <input type="text" class="form-control fecha" name="hasta">
            </div>
          </div>
      </div>
      <div class="row">
        <div class="col-md-1 col-md-offset-5">
          <div class="form-group">
            <input type="submit" name="buscar" class="btn btn-flat btn-success" value="Buscar">
          </div>
        </div>
        <div class="col-md-">
          <div class="form-group">
            <input type="reset" name="buscar" class="btn btn-flat btn-default" value="Limpiar">
          </div>
        </div>
      </div>
  	</form>
  </div>


@endsection


@section('script')
<script>
 $(document).ready(function(){
      //$('#inscripcion').select2();
      $('.fecha').datepicker();
  });
</script>

@endsection