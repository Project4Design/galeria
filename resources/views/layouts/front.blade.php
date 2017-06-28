<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1" />
  <link rel="shortcut icon" href="{{asset('img/logo.png')}}">
	<title>@yield('title',config('app.name'))</title>
	<link rel="stylesheet" type="text/css" media="all" href="{{asset('css/style.css')}}" />
	<link rel="stylesheet" href="{{asset('css/prettyPhoto.css')}}" type="text/css" media="screen" charset="utf-8"/>
	<link href='http://fonts.googleapis.com/css?family=Marmelad' rel='stylesheet' type='text/css'/>
</head>
<body>
	<div id="wrap">
  	<div id="header">
    	<div class="logo">
    		<a href="{{route('front_index')}}">Galeria<span>D'Abilio</span></a>
    	</div>
	    <div class="menu">
	      <ul>
	        <li class="selected"><a href="{{route('front_index')}}">Inicio</a></li>
	        <li><a href="{{url('/login')}}">Login</a></li>
	        <li><a href="{{route('about')}}">Acerca de</a></li>
	        <li><a href="{{route('cursos.cursos')}}">Cursos</a></li>
	        <li><a href="{{route('galeria')}}">Galeria</a></li>
	        <li><a href="{{route('contacto')}}">Contacto</a></li>
	      </ul>
	    </div> 
  	</div><!-- End of Header-->
  
	  <div class="slider">
	    <div class="flexslider">
	      <ul class="slides">
	        <li><a href="page.html"><img src="{{asset('images/slide-galeria.png')}}" height="400px" width="950px" alt="" title="" border="0"/></a></li>
	        <li><a href="page.html"><img src="{{asset('images/slide-galeria2.jpg')}}" height="400px" width="950px" alt="" title="" border="0"/></a></li>
	        <li><a href="page.html"><img src="{{asset('images/slide-galeria3.jpg')}}" height="400px" width="950px" alt="" title="" border="0"/></a></li>
	      </ul>
	    </div>
	  </div>

	  <div class="main_content">
	   	@yield('content')
	  </div>
   
  <div class="clear"></div> 
  <div class="footer">
    <div class="footer_content">
      <div class="footer_left">
        <ul class="footer_menu">
          <li><a href="{{route('front_index')}}">Inicio</a></li>
	        <li><a href="{{route('about')}}">Acerca de</a></li>
	        <li><a href="{{route('cursos.cursos')}}">Cursos</a></li>
	        <li><a href="{{route('galeria')}}">Galeria</a></li>
	        <li><a href="{{route('contacto')}}">Contacto</a></li> 
        </ul>
      </div>
          
      <div class="footer_right">
        <ul class="social_icons">
          <li><a href="#"><img src="images/icons/icon_facebook.png" alt="" title="" /></a></li>
          <li><a href="#"><img src="images/icons/icon_twitter.png" alt="" title="" /></a></li>
          <li><a onClick="jQuery('html, body').animate( { scrollTop: 0 }, 'slow' );"  href="javascript:void(0);" id="top"><img src="images/icons/icon_top.png" alt="" title="" /></a></li>
        </ul>
      </div>
    	<div class="clear"></div>
    </div>
    <div style="text-align: center">
    	<strong>Copyright &copy; GALERIA D´ ABILIO 2017 </strong>. - Desarrollado por Marily Ortegana y Frangelis Hernandez
    </div>
  </div>

	<!-- jQuery 2.1.4 -->
  <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/jquery.flexslider-min.js')}}"></script>
	<script src="{{asset('js/jquery.prettyPhoto.js')}}" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="{{asset('js/custom.quicksand.js')}}"></script>
  @yield('scripts')
</body>
</html>
