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
          <pre>Fecha: {{$fecha->format('d-m-Y H:i:s')}}          Usuario: {{Auth::user()->user}}         Pag <span class="pagenum"></span></pre>
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
      <p><b>DETALLE DE RESERVA</b></p>
    </div>
    <p align="center">__________________________________________________________________________________________
    </p>
    <table border="border-collapse" width="100%" align="lefth">
	      <thead>
	        <tr>
	            <td align="left"><strong>fecha</strong></td>
	            <td align="left"><strong>Inicia</strong></td>
	            <td align="left"><strong>finaliza</strong></td>
	            <td align="left"><strong>Cancha</strong></td>
              <td align="left"><strong>Hora/s</strong></td>
	            <td align="left"><strong>Servicios</strong></td>
	            <td align="center"><strong>Precio</strong></td>
              <td align="center"><strong>TOTAL</strong></td>
	        </tr>
	      </thead>
        <tbody> 
          @foreach ($detalles as $dr)
               
            @php$a=0; @endphp
            @foreach ($asociados as $as)

                @if ($dr->id == $as->detalle_reserva_id)
               
                  @if ($a == 0) @php $a=1; $d = $dr; $b=1;@endphp
                  <tr>
                  <td align="left">{{$as->detalle_reserva->fecha_reservada->format('d/m/Y')}}</td>
                  <td align="center">{{(int)$as->detalle_reserva->hr_reservada}} hs.</td>
                  <td align="center">{{(int)$as->detalle_reserva->hr_reservada + $as->detalle_reserva->cant_hs}} hs.</td>
                  <td align="left">{{$as->cancha_servicio->cancha->name}}</td>
                  <td align="center">{{$as->detalle_reserva->cant_hs}}</td>
                  <td align="left">{{$as->cancha_servicio->servicio->name}}</td>
                  <td align="right">${{$as->cancha_servicio->precio}}</td>
                  <td align="right">${{$as->cancha_servicio->precio*$as->detalle_reserva->cant_hs}}.00</td>
                  </tr>
                  @else
                  <tr> 
                    @php $a=1; $d = $dr;@endphp
					           <td></td><td></td><td></td><td></td><td></td>
                    <td align="left">{{$as->cancha_servicio->servicio->name}}</td>
                    @if ($as->cancha_servicio->xhr)
                    <td align="right">${{$as->cancha_servicio->precio}}</td>
                    <td align="right">${{$as->cancha_servicio->precio*$as->detalle_reserva->cant_hs}}.00</td>
                    @else
                    <td align="right">${{$as->cancha_servicio->precio}}</td>
                    <td align="right">${{$as->cancha_servicio->precio}}</td>
                    @endif
                  </tr>
                  @endif               
                @else
                  @if ($b==1)
                    @php $b=0;@endphp
                    <tr>
						          <td></td><td></td><td></td><td></td><td></td>
                      <td align="right">SUB</td>
	                    <td align="left"><strong>TOTAL</strong></td>
	                    <td align="right"><strong>${{$d->monto}}</strong></td>
	                </tr>
                  @endif
                @endif

            @endforeach
          @endforeach
          @if ($b==1)
            @php $b=0;@endphp
            <tr>
				      <td></td><td></td><td></td><td></td><td></td>
              <td align="right"><b>SUB</b></td>
              <td align="left"><strong>TOTAL</strong></td>
	            <td align="right"><strong>${{$d->monto}}</strong></td>
	           </tr>
          @endif
            <tr>
      				<td></td><td></td><td></td><td></td><td></td><td></td>
      				<td align="left"><strong>TOTAL</strong></td>
      				<td align="right"><strong>${{$d->reserva->total}}</strong></td>
            </tr> 
        </tbody>          
    </table>
  </body>
</html>