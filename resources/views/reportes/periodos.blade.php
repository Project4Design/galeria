<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Periodo {{$periodo->periodo}}</title>
    <link rel="stylesheet" href="css/pdf.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="IMG/logo.png">
      </div>
      <h1>PERIODO : {{$periodo->periodo}}</h1>
      <div id="project">
        <div><span>REGISTRADO</span> {{$periodo->created_at}}</div>
        <div><span>ESTADO</span>{!! $periodo->status===1?'Abierto':'Cerrado' !!}</div>
        <div><span>CURSOS</span> {{count($cursos)}} Cursos</div>
        <div><span>ESTUDIANTES</span> {{count($estudiantes)}} Estudiantes</div>
      </div>
    </header>
    <main>
      <table border="1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Titulo</th>
                    <th>Inscritos</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i=1; @endphp
                  @foreach($cursos as $d)
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$d->curso->titulo}}</td>
                      <td>{{$d->curso->inscritos().'/'.$d->curso->limit}}</td>
                    </tr>
                    @php $i++; @endphp
                  @endforeach
                </tbody>
              </table>
     <div id="notices">
        <div>IMPORTANTE:</div>
        <div class="notice">Esta informaacion debe manejarse con cuidado.</div>
      </div>
    </main>
    <footer>
      Copyright © GALERIA D´ ABILIO 2017 . - Desarrollado por Marily Ortegana y Frangelis Hernandez
    </footer>
  </body>
</html>