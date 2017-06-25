<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Usuarios</title>
    <link rel="stylesheet" href="css/pdf.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="IMG/logo.png">
      </div>
      <h1>LISTADO DE USUARIOS</h1>
    </header>
    <main>
      <table border="1">
        <thead>
          <tr>
            <th>#</th>
            <th>NOMBRE</th>
            <th>APELLIDO</th>
            <th>EMAIL</th>
            <th>TELEFONO</th>
            <th>TIPO</th>
          </tr>
        </thead>
        <tbody>
        @php $i=1; @endphp
              @foreach($users as $d)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$d->detalles->nombres}}</td>
                  <td>{{$d->detalles->apellidos}}</td>
                  <td>{{$d->email}}</td>
                  <td>{{$d->detalles->tlf_personal}}</td>
                  <td>{{$d->nivel()}}</td>
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