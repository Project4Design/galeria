@extends('layouts.app')

@section('breadcount')
  <li class="active">404</li>
@endsection

@section('content')
    

<!-- Main content -->
<section class="content">
  <div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>

    <div class="error-content">
      <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

      <p>
        We could not find the page you were looking for.
        You may <a href="{{ route('admin_index') }}">return to Home</a>.
      </p>

    </div>
    <!-- /.error-content -->
  </div>
  <!-- /.error-page -->
<!-- /.content -->
@endsection