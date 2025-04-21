<div class="table-responsive">
	<!----Muestra los servicios disponibles para cada cancha------>
  	<h4 class="text-center"><strong>Servicios disponibles por Cancha</strong></h4>
  	<div class="form-group">
	    <table class="table table-hover">
	      <thead class="">
	        <td class="active text-left"><strong>Cancha</strong></td>
	        <td class="active text-left"><strong>Servicios Ofrecidos</strong></td>
	        <td class="active text-center"><strong>Cobro por Hora</strong></td>
			<td class="active text-center"><strong>Obligatorio</strong></td>
	        <td class="active text-center"><strong>Precio</strong></td>
	      </thead>
	      <tbody>
	      @foreach ($canchas as $ca)
	        @php $a=1; @endphp
	        @foreach ($servicios as $servicio)
	        
	          <tr>
	            @if($ca->id == $servicio->cancha_id)
	              @if ($a)
	                @php $a=0; @endphp
	                <td class = "success text-left"><strong>{{$servicio->cancha->name}}</strong></td>
	              @else
	                <td class = "success text-left"></td>
	              @endif
	              <td class = "success text-left">{{$servicio->servicio->name}}</td>
	              @if ($servicio->xhr)
	                <td class = "success text-center">
	                	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
	                </td>
	              @else
	                <td class = "success text-center">
	                	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
	                </td>
	              @endif
	              @if($servicio->requerido == 1)
	                <td class = "success text-center">
	                	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
	                </td>
	              @else
	                <td class = "success text-center">
	                	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
	                </td>
	              @endif
	              <td class = "success text-right"><strong>$ {{$servicio->precio}}</strong></td>
	            @endif
	          </tr>
	          
	        @endforeach
	      @endforeach
	      </tbody>
	    </table>
  	</div>
</div>