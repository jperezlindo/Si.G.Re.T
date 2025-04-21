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
      <h3><b>TORNEO: {{ $torneo->name}}</b></h3>
    </div>
    <table border="border-collapse" width="100%" cellpadding="2">
      <thead>
      	<tr>
          <th align="left">Tipo de Torneo</th>
          <th align="left">Inicio</th>
          <th align="left">Hora Inicio</th>
          <th align="left">Finalizo</th>
         </tr>
      </thead>
      <tbody>
      	  <th align="left">{{ $torneo->tipo_torneo->name }}</th>
          <th align="left">{{ $torneo->f_desde->format('d-m-Y') }}</th>
          <th align="left">{{ $torneo->hora }} hs.</th>
          <th align="left">{{ $torneo->f_hasta->format('d-m-Y') }}</th>
      </tbody>
    </table>  
		<p align="center">__________________________________________________________________________________________</p>	
    <div align="center">
      <p><b>Categoria: {{$categoria->categoria->c_etario->name}}-{{$categoria->categoria->c_sexo->name}}-{{$categoria->categoria->c_categoria->name}}</b></p>
    </div>
    <table border="border-collapse" width="100%" cellpadding="2">
      <thead>
      	<tr>
          <th align="center">Tipo Equipo</th>
          <th align="center">Campeon</th>
          <th align="center">SubCampeon</th>
          <th align="center">Semifinal</th>
          <th align="center">Cuartos</th>
          <th align="center">Octavos</th>
         </tr>
      </thead>
      <tbody>
	      @if ($categoria->n_ptes == 1)
	        <td align="center">Single</td>
	      @else
	        <td align="center">Double</td>
	      @endif
          <td align="center">{{ $categoria->campeon }} pts.</td>
          <td align="center">{{ $categoria->subcampeon }} pts.</td>
          <td align="center">{{ $categoria->semifinal }} pts.</td>
          <td align="center">{{ $categoria->cuartos }} pts.</td>
          <td align="center">{{ $categoria->octavos }} pts.</td>
      </tbody>
    </table> 

    <p align="center">__________________________________________________________________________________________</p>
    
    <table border="border-collapse" width="100%" cellpadding="2">
      <thead>
      	<tr>
          <th align="left">INSTANCIA</th>
          <th align="left">EQUIPO</th>
          <th align="center">PUNTOS</th>
        </tr>
      </thead>
      <tbody>
		@foreach ($posiciones as $p)
		<tr>
          <td align="left">{{ $p->get('pos') }}</td>
          <td align="left">{{ $p->get('equ') }}</td>
          <td align="center">{{ $p->get('pts') }}</td>
        </tr>
		@endforeach
      </tbody>
    </table>   
  </body>
</html>