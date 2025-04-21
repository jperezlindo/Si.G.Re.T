<!DOCTYPE html>   
<html>
  <head>
    <title></title>
    <style type="text/css">
      table { border-collapse: separate;
              border-spacing:  3px;}
        td {border: 2px hidden}
        h2{color: rgb(#33OOCC);}
        footer .pagenum:before {
          content: counter(page);
      }
      footer { position: fixed; bottom: 0px; left: 0px; right: 0px; height: 20px; }
    </style>
  </head>

  <body>
    <footer>
        <div align="center" class="pagenum-container">
          <pre>Fecha: {{$fecha->format('d-m-Y H:i:s')}}         Usuario: {{Auth::user()->user}}        Pag <span class="pagenum"></span></pre>
        </div>
    </footer>
     
    <table width="100%" border="0" align="center">
      <tr>
        <th>
          <img width="200px" src="{{ asset (Storage::url ($emp->logo)) }}" height="150px" width="150px" class="img-thumbnail">
        </th>                                           
        <th align="right">
          <h2><b>{{ $emp->name}}</b></h2>
          <p>Telefono: {{$emp->tel}}</p>
          <p>CUIT: {{$emp->cuit}}</p>
          <p>Dirección: {{$emp->direccion}}</p>
          <p>Email: {{$emp->email}}</p>
        </th>
      </tr>        
    </table>
    <hr>
    <div align="center">
      <p><b>INFORME DE MOVIMIENTO</b></p>
    </div>
    
    <div align="center">
      <h3>Datos del Usuario</h3>
    </div>
    <table border="border-collapse" width="100%" align="lefth">
      <thead>
         <tr>
            <td class="text-center"><b>Usuario</b></td>
            <td class="text-center"><b>Apellido</b></td>
            <td class="text-center"><b>Nombre</b></td>
            <td class="text-center"><b>Fecha y Hora</b></td>
            <td class="text-center"><b>Accion</b></td>
         </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $user->user }}</td>
          <td>{{ $user->apellido }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $auditoria->fecha_hora}}</td>
          <td>{{ $auditoria->accion }}</td>
        </tr>
      </tbody>
    </table>
    <p align="center">__________________________________________________________________________________________
      </p>
    <table border="border-collapse" width="100%" cellpadding="2">
      <thead>
      	<tr>
          <th aling="center">Campo</th>
          <th aling="center">Datos Actuales</th>
          <th aling="center">Datos Historicos</th>
         </tr>
      </thead>
      <tbody>
        @foreach ($datos as $dato)
        <tr>
          <td aling="center">{{$dato[0]}}</td>
          @if ($dato[1] == $dato[2])
            <td aling="center">{{$dato[1]}}</td>
          @else
            <td aling="center"><b> <u><i>{{$dato[1]}}</i></u>    </b></td>
          @endif
          <td aling="center">{{$dato[2]}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>   
  </body>
</html>