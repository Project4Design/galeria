@extends('layouts.front')
@section('title','Contacto - '.config('app.name'))

@section('content')
	<div class="section_two_three">
		<h2>Ubicacion</h2>
		<div class="gmap">
      <iframe width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3930.296255796159!2d-67.36120008578256!3d9.909265492913445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2aa9f2478c1159%3A0x6e70764a25ca8b71!2sCalle+P%C3%A1ez%2C+San+Juan+de+Los+Morros%2C+Gu%C3%A1rico!5e0!3m2!1ses-419!2sve!4v1497224129198"></iframe>
    </div>
    <div class="entry">
      <h3>Informacion de Contacto</h3>
      <p><strong>Direccion:</strong> Calle Paez, casco central N 95 - A Diagonal al hospital Israel Ramirez balza, San Juan Edo. Guarico.</p>
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