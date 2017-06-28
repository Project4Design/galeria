@extends('layouts.front')
@section('title','About - '.config('app.name'))
@section('content')
  <div class="section_full">
  	<div class="section_two_three">
		  <h1>Acerca de...</h1>
		  <h2>Visión</h2>
		  <p>
		  	<strong>GALERIA D´ ABILIO</strong> es una entidad con decidida vocación de servicio privado abierto a todo público,  para integrar, presentar,
				promover y debatir el arte de la sociedad actual, desarrollar talentos y asumiendo el compromiso de generar cultura
				 a través de proyectos artísticos e investigaciones, con la intención de convertirse en una especial y excelente 
				 referencia por la calidad y la diversidad de sus actividades culturales y poniendo especial énfasis en el acento humanista 
				 y de compromiso social en nuestro país.   Espacio destinado a producir inquietudes y propiciar la creación artística, la 
				 reflexión y el pensamiento sobre el mundo en el que vivimos capaz, a su vez, de generar una amplia repercusión social y 
				 , no sólo por sus actividades, sino también por la propia concepción filosófica, accesible, cercana, viva, dinámica y 
				 participativa que se convierta en un centro de encuentro y un espacio integrador para las artes. Un sitio que se logró  
				 atraer la atención hacia el arte y la cultura contemporáneos de todas las personas y que contribuya a crear una sociedad 
				 más reflexiva. Es trabajar con los creadores para potenciar promocionar y divulgar las Artes Plásticas, así como la obra 
				 que atesora el  municipio <strong>Juan German Roscio</strong>, a través de las distintas instancias, cuyas acciones se desempeñan en la 
				 Institución y en diferentes centros expositivos y extensiones en las comunidades del territorio en las cuales se trabaja 
				 con vista a elevar el gusto estético de la población hacia las <strong>Artes Plásticas</strong>.
		  </p>
		</div>
		<div class="section_one_three" style="padding: 40px 0;width:320px">
		  <h1>&nbsp;</h1>
		  <h2>&nbsp;</h2>
			<img class="img-responsive" title="Mision" src="{{asset('images/vision.png') }}" alt="Mision" style="max-height:250px">
		</div>
	</div>

	<div class="section_full">
		<div class="section_one_three" style="padding: 40px 0;width:320px">
		  <h1>&nbsp;</h1>
			<img class="img-responsive" title="Mision" src="{{asset('images/mision.jpg') }}" alt="Vision">
		</div>
		<div class="section_two_three">
		  <h2>Misión</h2>
	    <p>Apoyar y promover las artes plásticas brindando las mejores obras, ofertas de enmarcados, accesorios artístico, con la asesoría profesional de un excelente equipo humano y con las tecnologías más vanguardistas.
	     Proporcionar a nivel nacional espacios de formación y fomento artístico de calidad para jóvenes y público en general, promoviendo el acceso y participación democrática, la libertad de creación y el pensamiento crítico.
			</p>
		</div>
	</div>

	<div class="section_full">
		<h2>Valores</h2>
		<p>
			Dinamismo, innovación, apertura, creatividad, fertilidad, excelencia, vocación formativa y crítica. Solidaridad y responsabilidad, cooperación, calidad de servicio, perfeccionamiento y mejora profesional permanentes. Orgullo, satisfacción, motivación, eficacia y eficiencia. sentirán que pertenecen a una organización moderna, avanzada y renovadora, sensible a distintas actitudes individuales y/o colectivas, que fomentará y estimulará su iniciativa y creatividad; se promoverá el trabajo en equipo, la cultura participativa, la auto exigencia y la toma de riesgos motivando la iniciativa personal como instrumento de integración social.
		</p>
	</div>
	<div class="section_one_four">
    <h4>Discreción e integridad</h4>
     <p>
     		Nuestras transacciones y servicios se prestan bajo las más estrictas normas de confidencialidad.
     </p>
  </div>
  <div class="section_one_four">
    <h4>Responsabilidad social</h4>
     <p>
     		Realizamos actividades que fortalecen el desarrollo del  arte, como manera de apoyar la formación de nuevos valores en la sociedad.
     </p>
  </div>
  <div class="section_one_four">
    <h4>Protección del medio ambiente</h4>
     <p>
     		Trabajamos con el firme objetivo de promover la utilización de materias primas debidamente reguladas  por organismos enfocados a preservar el medio ambiente.
     </p>
  </div>
  <div class="section_one_four">
    <h4>Trabajo en equipo</h4>
     <p>
     		Promovemos la participación e integración de todos nuestros empleados.
     </p>
  </div>
  <div class="section_full">
  	<center><img class="img-responsive" title="Artes" src="{{asset('images/artes.jpg') }}" alt="Vision" style="max-height: 250px"></center>
  </div>

  <div class="section_two_three">
    <h2>Objectivos</h2>
		<p style="font-size:120%">Ser competitivos según las exigencias del mercado, siempre ofrecer lo mejor.</p><br><br>
		<p style="font-size:120%">Generar empleo a nuestra comunidad artística.</p><br><br>
		<p style="font-size:120%">Contar con las herramientas necesarias para  ofrecer obras artísticas de calidad.</p><br><br>
  </div>
@endsection
