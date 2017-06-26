<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Pagos</title>
    <link rel="stylesheet" href="css/pdf.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="IMG/logo.png">
      </div>
      <h1>Pagos Desde : {{$desde}} , Hasta {{$hasta}}</h1>
    </header>
    <main>
      <table border="1">
        <thead>
          <tr>
                <th>#</th>
                <th>Inscripcion</th>
                <th>Tipo</th>
                <th>Monto</th>
                <th>Fecha</th>
              </tr>
        </thead>
        <tbody>
      @php $i=1; @endphp
              @foreach($pagos as $p)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$p->inscripcion->curso->titulo}}</td>
                  <td>{{$p->tipo}}</td>
                  <td>{{$p->monto}}</td>
                  <td>{{$p->fecha}}</td>
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