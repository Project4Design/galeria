@extends('layouts.front')

@section('content')
	@foreach($cursos as $d)
		<div class="section_one_three image-border">
		  <h2>{{$d->titulo}}</h2>
		  
		  <a href="{{url('cursos/'.$d->curso_id)}}" rel="prettyPhoto[gallery]" title="">
		  	<img src="{{asset('images/cursos/'.$d->foto)}}" alt="{{asset('images/cursos/'.$d->foto)}}" title="{{asset('images/cursos/'.$d->foto)}}"/>
		  </a>
		 <p>{{$d->descripcion}}</p>
		  <a id="open" href="{{url('cursos/'.$d->curso_id)}}" class="more">read more</a>
		</div>
	@endforeach

		<div class="divider"></div>
		<div class="section_two_three">
			<h2>Latest Blog Entries</h2>
			<div class="post">
				<div class="post_left">
          <a href="#" class="post_image"><img src="images/post-thumb1.jpg" alt="" title="" /></a>
          <div class="post_date"><span>08</span><span>mar</span></div>
          <div class="post_comments"><a href="#">03</a></div>
        </div>
        <div class="post_right">
        	<h3><a href="blog-single.html">Adisnim adipisicing elit, sed do eiusmod</a></h3>
          <p>
              Lorem ipsum dolor sit amet, consectetur <strong>adipisicin</strong>gelit, sed do eiusmod tempor incididunt <a href="#">consectetur</a> adipisicing elit, sed do eiusmod <strong>tempor incididunt</strong> ut labore et dolore magna aliqua. 
          </p>
          <a href="#" class="more">read more</a>
        </div>
      </div>
    </div>

    @include('partials.front_sidebar')
@endsection