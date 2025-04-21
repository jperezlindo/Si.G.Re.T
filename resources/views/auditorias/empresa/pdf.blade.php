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
      <p><b>INFORME DE MOVIMIENTO EN LA TABLA EMPRESA POR USUARIO</b></p>
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
    <table border="border-collapse" width="100%" align="lefth">
      <thead>
         <tr>
            <td align="left"><b>Campo</b></td>
            <td align="left"><b>DATOS ACTUALES</b></td>
            <td align="left"><b>DATOS HISTORICO</b></td>
         </tr>
      </thead>
      <tbody>
        <tr>
          <td> </td>
          <td> </td>
          <td> </td></tr>
        <tr>
          <td>Nombre</td>
          <td>{{$new_data['NOMBRE']}}</td>
          <td>{{$old_data['NOMBRE']}}</td>
        </tr>
        <tr>
          <td>Razon Social</td>
          <td>{{$new_data['RAZON SOCIAL']}}</td>
          <td>{{$old_data['RAZON SOCIAL']}}</td>
        </tr>
        <tr>
          <td>CUIT</td>
          <td>{{$new_data['CUIT']}}</td>
          <td>{{$old_data['CUIT']}}</td>
        </tr>
        <tr>
          <td>Tel/Cel</td>
          <td>{{$new_data['TELEFONO']}}/{{$new_data['CELULAR']}}</td>
          <td>{{$old_data['TELEFONO']}}/{{$old_data['CELULAR']}}</td>
        </tr>
        <tr>
          <td>email</td>
          <td>{{$new_data['EMAIL']}}</td>
          <td>{{$old_data['EMAIL']}}</td>
        </tr>
        <tr>
          <td>Direccion</td>
          <td>{{$new_data['DIRECCION']}}</td>
          <td>{{$old_data['DIRECCION']}}</td>
        </tr>
        <tr>
          <td>Rubro</td>
          <td>{{$new_data['RUBRO']}}</td>
          <td>{{$old_data['RUBRO']}}</td>
        </tr>
        <tr>
          <td>Logo</td>
          <td><img width="200px" src="{{ asset(Storage::url ($new_data['LOGO'])) }}" class="left-block img-responsive img-rounded" 
            alt="Responsive image"></td>
          <td><img width="200px" src="{{ asset(Storage::url ($old_data['LOGO'])) }}" class="left-block img-responsive img-rounded" 
            alt="Responsive image"></td>
        </tr>
      </tbody>
    </table>
  </body>
</html>

          

