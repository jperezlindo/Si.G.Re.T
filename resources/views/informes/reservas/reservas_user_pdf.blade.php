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
      <p><b>INFORME DE CANTIDAD DE RESERVAS POR USUARIO</b></p>
    </div>
    
    <p align="center">__________________________________________________________________________________________
    </p>
    <div align="left">
      <p>
        Desde: <b>{{$desde->format('d-m-Y')}}</b>, Hasta: <b>{{$hasta->format('d-m-Y')}}</b><br>
        Ordenado por: <b>Cantidad</b>
      </p>
    </div>
    <table border="border-collapse" width="100%" align="lefth">
      <thead>
         <tr>
            <td align="center"><b>Nro.</b></td>
            <td align="left"><b>Usuario</b></td>
            <td align="left"><b>Apellido</b></td>
            <td align="left"><b>Nombre</b></td>
            <td align="center"><b>Cantidad</b></td>
         </tr>
      </thead>
      <tbody>
        @php $i=1; @endphp
        @foreach ($reservas as $reserva)
          <tr>
            <td align="center">{{ $i++ }} </td>
            <td>{{ $reserva['user']->get(0)->user }} </td>
            <td>{{ $reserva['user']->get(0)->apellido }} </td>
            <td>{{ $reserva['user']->get(0)->name }} </td>
            <td align="center">{{ $reserva['cant']}} </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>