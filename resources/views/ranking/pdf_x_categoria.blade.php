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
      <p><b>INFORME DE RANKING POR CATEGORIA</b></p>
    </div>
    <p align="center">__________________________________________________________________________________________
    </p>
    <table border="border-collapse" width="100%" align="lefth">
      <thead>
         <tr>
            <td align="center"><b>Posición</b></td>
            <td align="left"><b>Usuario</b></td>
            <td align="center"><b>Puntos</b></td>
            <td align="center"><b>Promedio</b></td>
            <td align="center"><b>Torneos Jugados</b></td>
         </tr>
      </thead>
      <tbody>
        @foreach ($posiciones as $key => $posicion)
          <tr>
            <td align="center">{{ $key + 1}} </td>
            <td>{{ $posicion->user_empresa->user->user}} </td>
            <td align="right">{{ $posicion->puntos }} </td>
            <td align="right">{{ $posicion->promedio }} </td>
            <td align="center">{{ $posicion->torneos_jugados}}
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>