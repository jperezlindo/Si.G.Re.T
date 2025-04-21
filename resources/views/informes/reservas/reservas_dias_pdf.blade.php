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
      <h3><b>INFORME DE CANTIDAD DE RESERVAS POR DIAS</b></h3>
    </div>    
    <p align="center">__________________________________________________________________________________________
    </p>
    <div align="left">
      <p>
        Desde: <b>{{$desde->format('d-m-Y')}}</b>, Hasta: <b>{{$hasta->format('d-m-Y')}}</b><br>
        Ordenado por: <b>Canchas</b>
      </p>
    </div>
    <table border="border-collapse" width="100%" align="lefth">
      <thead>
         <tr>
            <td align="left"><b>Cancha</b></td>
            <td align="center"><b>Domingo</b></td>
            <td align="center"><b>Lunes</b></td>
            <td align="center"><b>Martes</b></td>
            <td align="center"><b>Miercoles</b></td>
            <td align="center"><b>Jueves</b></td>
            <td align="center"><b>Viernes</b></td>
            <td align="center"><b>Sabado</b></td>
         </tr>
      </thead>
      <tbody>
        @foreach ($canchas as $ca)
        <tr>
          <td align="left"><b>{{ $ca['name']}}</b></td>
          <td align="center">{{ $ca['dia'][0]}}</td>
          <td align="center">{{ $ca['dia'][1]}}</td>
          <td align="center">{{ $ca['dia'][2]}}</td>
          <td align="center">{{ $ca['dia'][3]}}</td>
          <td align="center">{{ $ca['dia'][4]}}</td>
          <td align="center">{{ $ca['dia'][5]}}</td>
          <td align="center">{{ $ca['dia'][6]}}</td>
        </tr>
        @endforeach
        <tr>
          <td align="right"><b>TOTAL</b></td>
          <td align="center"><b>{{$dias[0]}}</b></td>
          <td align="center"><b>{{$dias[1]}}</b></td>
          <td align="center"><b>{{$dias[2]}}</b></td>
          <td align="center"><b>{{$dias[3]}}</b></td>
          <td align="center"><b>{{$dias[4]}}</b></td>
          <td align="center"><b>{{$dias[5]}}</b></td>
          <td align="center"><b>{{$dias[6]}}</b></td>
        </tr>
      </tbody>
    </table>
  </body>
</html>