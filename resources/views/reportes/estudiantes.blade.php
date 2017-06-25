<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Estudiantes</title>
    <link rel="stylesheet" href="css/pdf.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="IMG/logo.png">
      </div>
      <h1>LISTADO DE ESTUDIANTES</h1>
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
              </tr>
        </thead>
        <tbody>
        @php $i=1; @endphp
              @foreach($estudiantes as $d)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{number_format($d->user->detalles->cedula,0,",",".")}}</td>
                  <td>{{$d->user->detalles->nombres}}</td>
                  <td>{{$d->user->detalles->apellidos}}</td>
                  <td>{{$d->user->email}}</td>
                  <td>{{$d->user->detalles->tlf_personal}}</td>
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