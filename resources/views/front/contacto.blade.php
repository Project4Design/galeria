@extends('layouts.front')

@section('content')
	<div class="section_two_three">
		<h2>Ubicacion</h2>
		<div class="gmap">
      <iframe width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1965.1371025257292!2d-67.3582650668423!3d9.911105422713426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2645bebb94a62095!2sParque+Juan+German+Roscio!5e0!3m2!1ses!2sve!4v1494794672141"></iframe>
    </div>
    <div class="entry">
      <h3>Informacion de Contacto</h3>
      <p><strong>Telefono:</strong> 0246-4354324</p>
      <p><strong>Email:</strong> galeriadabilio@gmail.com</p><br>
      <p>¡Ponte en contacto con nosotros! Envianos un mensaje y te responderemos lo antes posible</p>
    </div>
                
    <div class="form_content">
    	<h2>Deja tu Mensaje</h2> 
    	<form id="form1" method="post" action="#">
    		<div class="form_top">
    			<div class="form_row_half">
    				<input type="text" class="form_input" name="name" placeholder="Nombre"/>
          </div>
          <div class="form_row_half">
          	<input type="text" class="form_input" name="email" placeholder="Email"/>
          </div>
          <div class="form_row">
          	<textarea class="form_textarea" name="comment" placeholder=Mensaje....></textarea>
          </div>
        </div>
       	<div class="form_bottom">
       		<input type="submit" class="form_submit" value="Submit" />
       	</div>
      </form>
    </div>
  </div>
@endsection