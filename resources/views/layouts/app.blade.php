<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title',config('app.name'))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- favicon / icons
    ============================================ -->
    <link rel="apple-touch-icon" href="{{ asset('img/apple-icon-180x180.png') }}">
		<link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('img/android-icon-192x192.png') }}">
    <link rel="shortcut icon" type="image/x-icon" sizes="32x32"  href="{{ asset('img/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="{{ asset('img/ms-icon-144x144.png') }}">
		<meta name="theme-color" content="#ffffff">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- Custom style -->
    <link rel="stylesheet" href="{{asset('css/Styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/select2/select2.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    	folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    
	  <style type="text/css">
	    .view-subtitle{
	      color: #d22a2a;
	      font-weight: 600;
	      font-size: 17px;
	    }

	    .perfil{
			  position: relative;
			  background: #fff;
			  border: 1px solid #f4f4f4;
			  padding: 20px;
			  margin: 10px 25px;
			}

			.separador{ 
			   border: 0.3px solid #dd4b39; 
			   border-radius: 200px /8px; 
			   height: 0px; 
			   text-align: center; 
			 }
	  </style>
  </head>

  <body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="{{route('admin_index')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img class="img-responsive" src="{{ asset('img/logo.png') }}" alt="Logo" style="height:30px;margin:10px 0 0 10px"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">
            <b style="font-size: 18px">
              <img src="{{ asset('img/logo.png') }}" alt="logo" height="25px">&nbsp;{{ config('app.name') }}
            </b>
          </span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            <li><a href="{{route('inscripciones.create')}}"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Inscripcion</a></li>
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">{{ Auth::user()->detalles->nombres }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header" style="s">
                    <p>{{ Auth::user()->email }}</p>
                    <p>{{Auth::user()->nivel()}}</p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a class="btn btn-flat btn-default" href="{{route('perfil')}}"><i class="fa fa-user"></i> Mi perfil</a>
                    </div>
                    <div class="pull-right">
                      <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-flat btn-default" type="submit"><i class="fa fa-sign-out" aria-hidden="true"></i> Salir</button>
                      </form>
                    </div>
                    <div class="pull-left">
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENU</li>

            <li>
              <a href="{{route('admin_index')}}">
              	<i class="fa fa-dashboard" aria-hidden="true"></i> <span>Escritorio</span>
              </a>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('admin/users') }}"><i class="fa fa-circle-o"></i>Ver usuarios</a></li>
                <li><a href="{{ url('admin/users/create') }}"><i class="fa fa-circle-o"></i>Agregar usuario</a></li>
              </ul>
            </li>

            <li>
              <a href="{{route('inscripciones.index')}}">
                <i class="fa fa-check-square-o" aria-hidden="true"></i> <span>Inscripciones</span>
              </a>
            </li>

             <li class="treeview">
              <a href="#">
                <i class="fa fa-user-circle"></i>
                <span>Profesores</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('profesores.index') }}"><i class="fa fa-circle-o"></i>Ver profesores</a></li>
                <li><a href="{{ route('profesores.create') }}"><i class="fa fa-circle-o"></i>Agregar profesor</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-university"></i>
                <span>Cursos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('admin/cursos') }}"><i class="fa fa-circle-o"></i>Ver cursos</a></li>
                <li><a href="{{ url('admin/cursos/create') }}"><i class="fa fa-circle-o"></i>Agregar curso</a></li>
              </ul>
            </li>
        
         <li class="treeview">
              <a href="#">
                <i class="fa fa-file-image-o"></i>
                <span>Cuadros</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('galeria.index') }}"><i class="fa fa-circle-o"></i>Ver cuadros</a></li>
                <li><a href="{{ route('galeria.create') }}"><i class="fa fa-circle-o"></i>Agregar cuadro</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-credit-card"></i>
                <span>Pagos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('admin/pagos') }}"><i class="fa fa-circle-o"></i>Ver pagos</a></li>
                <li><a href="{{ url('admin/pagos/create') }}"><i class="fa fa-circle-o"></i>Agregar pago</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-address-card-o"></i>
                <span>Representantes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('representantes.index') }}"><i class="fa fa-circle-o"></i>Ver representantes</a></li>
                <!--
                <li><a href="{{ route('representantes.create') }}"><i class="fa fa-circle-o"></i>Agregar representante</a></li>
                -->
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-address-book-o"></i>
                <span>Estudiantes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('estudiantes.index') }}"><i class="fa fa-circle-o"></i>Ver estudiantes</a></li>
                <li><a href="{{ route('estudiantes.create') }}"><i class="fa fa-circle-o"></i>Agregar estudiante</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-cogs"></i>
                <span>Configuracion</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('periodos.index') }}"><i class="fa fa-circle-o"></i>Periodos</a></li>
                <li><a href="{{ route('bitacora.index') }}"><i class="fa fa-circle-o"></i>Bitacora</a></li>
              </ul>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>


       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content-header">
          <h1 class="text-center">
            @yield('header')
          </h1>
          @yield('breadcrumb')
        </section>
        <!-- Main content -->
        <div class="content">
        	@yield('content')
        </div>
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <strong>Copyright &copy; GALERIA D´ ABILIO 2017 </strong>. - Desarrollado por Marily Ortegana y Frangelis Hernandez
      </footer>
    </div>

      
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	$('div.alert').not('.alert-important').delay(7000).slideUp(300);

        $('.data-table').DataTable({
          responsive: true,
          language: {
          	url:'{{asset("js/spanish.json")}}'
          }
        });
      })
    </script>

    @yield('script')
  </body>
</html>


