<div class="row">
  	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
	  	<div class="table-responsive">
		    <div class="form-group">
			    <h4 class = "text-right"><span class="label label-danger">Reservas No Confirmadas</span></h4>
			    <table class="table table-hover table-striped">
				    <thead class="">
				    	<td class="active text-left"><strong>Reserva Nro.</strong></td>
				        <td class="active text-left"><strong>Fecha</strong></td>
				        <td class="active text-left"><strong>Inicia</strong></td>
				        <td class="active text-left"><strong>Finaliza</strong></td>
				        <td class="active text-center"><strong>VALOR</strong></td>
				        <td class="active text-center" colspan="3"><strong>Acciones</strong></td>
				    </thead>
				    <tbody>
				    @foreach ($rnc as $reserva)
				        @foreach ($reserva->detalles_reserva as $dr)
				        	@if($dr->activo)
					        <tr>
					        	<td class = "success text-left">{{$reserva->id}}</td>
								<td class = "success text-left">{{$dr->fecha_reservada->format('d/m/Y')}}</td>
								<td class = "success text-left">{{(int)$dr->hr_reservada}}:00 hs.</td>
								<td class = "success text-left">{{(int)$dr->hr_reservada + $dr->cant_hs}}:00 hs.</td>
								<td class = "success text-right"><strong>$ {{$dr->monto}}</strong></td>
								<td class = "success text-right"></td>
								<td class = "success text-right"></td>
								<td class = "success text-right"></td>		            	
					        </tr>
					        @endif
				        @endforeach
				        <tr>
				        	<td class = "info text-left"></td>
				        	<td class = "info text-left"></td>
				        	<td class = "info text-left"></td>
				        	<td class = "info text-left"><strong>TOTAL</strong></td>
				        	<td class = "info text-right"> <strong>$ {{$reserva->total}} </strong></td>
			        		<td class = "info text-right" title="VER DETALLE">
								<a href="{{ route('reserva.show', $reserva->id ) }}" class="btn btn-info btn-xs">
							  		<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
								</a>
							</td>
							<td class = "info text-center" title="CONFIRMAR RESERVA"> 	
				              	<form action="{{route('reserva.confirmarReserva')}}" method="POST"> 
	                				<button type="submit" class="btn btn-success btn-xs">{!! csrf_field()!!}
	                				<span class="glyphicon glyphicon-ok" aria-hidden="true" ></span></button>
	                				<input name="reserva_id" type="hidden" value="{{$reserva->id}}">
				              	</form>
						    </td>	
			        		<td class = "info text-left" title="ANULAR RESERVA"> 	
				              	<form action="{{route('reserva.destroy', $reserva->id)}}" method="POST"> 
	                				<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" 
	                				data-target="#modalConfirmacionAnularReserva_{{$reserva->id}}">
	                				<span class=" glyphicon glyphicon-remove" aria-hidden="true" ></span></button>
	                				@include('reserva.viewsModals.confirmacionAnularReserva')
				              	</form>
						    </td>	
				        </tr> 
			      @endforeach
			      	</tbody> 
			    </table>
			</div>
	  	</div>
  	</div>
</div>