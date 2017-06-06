@extends('layouts.app')
@section('title','Inicio - '.config('app.name'))
@section('header','Inicio')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Escritorio</a></li>
	  <li class="active"> Inicio </li>
	</ol>
@endsection
@section('content')

	<section class="content">
		<!-- Info boxes -->
    <div class="row">
      <div class="col-md-2 col-md-offset-1 col-sm-6 col-xs-12">
        <div class="small-box bg-blue">
          <div class="inner">
            <h3>Usuarios</h3>
            <p></p>
          </div>
          <div class="icon">
            <i class="fa fa-car"></i>
          </div>
          <a href="{{ url('admin/cars') }}" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
			
      <div class="col-md-2 col-sm-6 col-xs-12">
        <div class="small-box bg-blue">
          <div class="inner">
            <h3>#</h3>
            <p>Van Insurances</p>
          </div>
          <div class="icon">
            <i class="fa fa-bus"></i>
          </div>
          <a href="{{ url('admin/vans') }}" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <div class="col-md-2 col-sm-6 col-xs-12">
        <div class="small-box bg-blue">
          <div class="inner">
            <h3>#</h3>
            <p>Home Insurances</p>
          </div>
          <div class="icon">
            <i class="fa fa-home"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <div class="col-md-2 col-sm-6 col-xs-12">
        <div class="small-box bg-blue">
          <div class="inner">
            <h3>#</h3>
            <p>Business Insurance</p>
          </div>
          <div class="icon">
            <i class="fa fa-building"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <div class="col-md-2 col-sm-6 col-xs-12">
        <div class="small-box bg-blue">
          <div class="inner">
            <h3>#</h3>
            <p>Accident Insurance</p>
          </div>
          <div class="icon">
            <i class="fa fa-wheelchair"></i>
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
	      <div class="box box-danger">
	        <div class="box-header with-border">
	          <h3 class="box-title">Last quotes registered</h3>
	          <div class="box-tools pull-right">
	            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	          </div>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body">
          	<table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Type</th>
                  <th>Registered</th>
                  <th>Proposer</th>
                  <th>Phone</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>

            </table>
	        </div><!-- /.box-body -->
	      </div><!-- /.box -->
	    </div><!-- /.col -->
	  </div><!-- /.row -->

	</section><!-- /.content -->
@endsection