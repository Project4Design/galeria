<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicons.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="shortcut icon" href="{{asset('img/logo.png')}}">
</head>

<body class="hold-transition login-page">
	<!-- Main content -->
	<section class="content">
	  <div class="error-page">
	    <h2 class="headline text-yellow"> 404</h2>

	    <div class="error-content">
	      <h3><i class="fa fa-warning text-yellow"></i> Oops! Pagina no encontrada.</h3>

	      <p>
	        No pudimos encontrar lo que estas buscando.
	        Podrias <a href="{{ route('admin_index') }}">regresar al inicio</a>.
	      </p>

	    </div>
	    <!-- /.error-content -->
	  </div>
	  <!-- /.error-page -->
	</section>
	<!-- /.content -->
</body>