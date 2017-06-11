<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1" />
	<title>@yield('title',config('app.name'))</title>
	<link rel="stylesheet" type="text/css" media="all" href="{{asset('css/style.css')}}" />
	<link rel="stylesheet" href="{{asset('css/prettyPhoto.css')}}" type="text/css" media="screen" charset="utf-8"/>
	<link href='http://fonts.googleapis.com/css?family=Marmelad' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="{{asset('js/jquery.flexslider-min.js')}}"></script>
	<script src="{{asset('js/jquery.prettyPhoto.js')}}" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="{{asset('js/custom.quicksand.js')}}"></script>
</head>
<body>
	<div id="wrap">
  	<div id="header">
    	<div class="logo"><a href="{{route('front_index')}}">Galeria<span>D'Alibio</span></a></div>
	    <div class="menu">
	      <ul>
	        <li class="selected"><a href="{{route('front_index')}}">Inicio</a></li>
	        <li><a href="{{route('about')}}">Acerca de</a></li>
	        <li><a href="{{url('/cursos')}}">Cursos</a></li>
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
	    <div class="section_one_three sidebar">
	      <h2>Search</h2>
	      <div class="search_bar">
	      	<form>
	          <input type="text" class="sidebar_input" />
	          <input type="submit" value="search" class="sidebar_submit" />
	        </form>
	      </div>
	    	<h2>Buscar categorias</h2>
	      <ul>
	        <li><a href="#">Arte</a></li> 
	        <li><a href="#">Tiempos modernos</a></li>
	        <li><a href="#">Manualidades</a></li>
	        <li><a href="#">Novedades</a></li>
	      </ul>
	  <!--
	      <h2>Testimonials</h2>
	      <p>
	          Lorem ipsum dolor sit amet, consectetur <strong>adipisicin</strong>g elit, sed do eiusmod tempor incididunt <a href="#">consectetur</a> adipisicing elit, sed do eiusmod <strong>tempor incididunt</strong> ut labore et dolore magna aliqua. 
	      </p>
	      -->
	    </div>
	  </div>
   
  <div class="clear"></div> 
  <div class="footer">
    <div class="footer_content">
      <div class="footer_left">
        <ul class="footer_menu">
          <li><a href="{{route('front_index')}}">home</a></li>
          <li><a href="page.html">page</a></li>
          <li><a href="#">blog</a></li>
          <li><a href="{{route('contacto')}}">contacto</a></li> 
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
  </div>

	<!-- jQuery 2.1.4 -->
  <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
</body>
</html>
