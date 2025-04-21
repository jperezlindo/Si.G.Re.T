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
          <pre>Fecha:{{$fecha}}          Usuario: {{Auth::user()->user}}                   Pag <span class="pagenum"></span></pre>
        </div>
    </footer>
     
    <table width="100%" border="0" align="center">
      <tr>
        <th>
          <img width="200px" src="{{ asset (Storage::url (Auth::user()->user_empresa->empresa->logo)) }}" height="150px" width="150px" class="img-thumbnail">
        </th>
        <th>
          <div class="text-center">
            <h2><b>{{ $emp->name}}</b></h2>
          </div>
        </th>                                                  
        <th align="right">
          <h2>{{$emp->nam}}</h2>
          <p>Telefono: {{$emp->tel}}</p>
          <p>CUIT: {{$emp->cuit}}</p>
          <p>Email: {{$emp->email}}</p>
        </th>
      </tr>        
    </table>
    <hr>
    <div align="center">
      <p><b>INFORME DE MOVIMIENTO EN LA TABLA TORNEO POR USUARIO</b></p>
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
          <td>{{ $auditoria->fecha_hora }}</td>
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
          <td>{{$new_data->name}}</td>
          <td>{{$old_data[1]}}</td>
        </tr>
        <tr>
          <td>Fecha Inicio</td>
          <td>{{$new_data->f_desde->format('Y-m-d')}}</td>
          <td>{{$old_data[2]}}</td>
        </tr>
        <tr>
          <td>Fecha Finalizacion</td>
          <td>{{$new_data->f_hasta->format('Y-m-d')}}</td>
          <td>{{$old_data[3]}}</td>
        </tr>
        <tr>
          <td>Hora</td>
          <td>{{$new_data->hora}}</td>
          <td>{{$old_data[4]}}</td>
        </tr>
        <tr>
          <td>Inicio de Inscripcion</td>
          <td>{{$new_data->ini_ins->format('Y-m-d')}}</td>
          <td>{{$old_data[5]}}</td>
        </tr>
        <tr>
          <td>Fin de Inscripcion</td>
          <td>{{$new_data->fin_ins->format('Y-m-d')}}</td>
          <td>{{$old_data[6]}}</td>
        </tr>
        <tr>
          <td>Descripcion</td>
          <td>{{$new_data->descripcion}}</td>
          <td>{{$old_data[7]}}</td>
        </tr>
        <tr>
          <td>Activo</td>
          <td>{{$new_data->activo}}</td>
          <td>{{$old_data[8]}}</td>
        </tr>
        <tr>
          <td>Finalizado</td>
          <td>{{$new_data->finalizado}}</td>
          <td>{{$old_data[9]}}</td>
        </tr>
        <tr>
          <td>Tipo de Torneo</td>
          <td>{{$new_data->tipo_torneo_id}}</td>
          <td>{{$old_data[10]}}</td>
        </tr>

      </tbody>
    </table>
  </body>
</html>