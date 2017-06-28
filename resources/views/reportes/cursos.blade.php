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
      <h1>TITULO : {{$curso->titulo}}</h1>
      <div id="project">
        <div><span>REGISTRADO</span> {{$curso->created_at}}</div>
        <div><span>TITULO</span>{{$curso->titulo}}</div>
        <div><span>DESCRIPCION</span> {{$curso->descripcion}} </div>
        <div><span>INSCRITOS</span> {{count($curso->estudiantesByPeriodo($periodo->periodo_id)).'/'.$curso->limit}}</div>
      </div>
    </header>
    <main>
      <table border="1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Cedula</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Telefono personal</th>
                    <th>Nota</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i=1; @endphp
                  @foreach($estudiantes as $d)
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{number_format($d->estudiante->user->detalles->cedula,0,",",".")}}</td>
                      <td>{{$d->estudiante->user->detalles->nombres}}</td>
                      <td>{{$d->estudiante->user->detalles->apellidos}}</td>
                      <td>{{$d->estudiante->user->email}}</td>
                      <td>{{$d->estudiante->user->detalles->tlf_personal}}</td>
                      <td>{{$d->nota->nota?$d->nota->nota:'-'}}</td>
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