<div class="row">
  	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
	  	<div class="table-responsive">
		    <div class="form-group ">
			    <h4 class = "text-right"><span class="label label-success">Reservas Confirmadas</span></h4>
			    <table class="table table-hover table-striped ">
				    <thead class="">
				    	<td class="active text-left"><strong>Nro.</strong></td>
				        <td class="active text-left"><strong>Fecha</strong></td>
				        <td class="active text-left"><strong>Inicia</strong></td>
				        <td class="active text-left"><strong>Finaliza</strong></td>
				        <td class="active text-left"><strong>Cancha</strong></td>
				        <td class="active text-center"><strong>VALOR</strong></td>
				        <td class="active text-center" colspan="3"><strong>Acciones</strong></td>
				    </thead>
				    <tbody>

				        @foreach ($reservas as $i => $dr)
				        	@if(($dr->activo) and ($dr->confirmada))
					        <tr>
					        	<td class = "success text-center">{{$i+1}}</td>
								<td class = "success text-left">{{$dr->fecha_reservada->format('d/m/Y')}}</td>
								<td class = "success text-left">{{(int)$dr->hr_reservada}}:00 hs.</td>
								<td class = "success text-left">{{(int)$dr->hr_reservada + $dr->cant_hs}}:00 hs.</td>
								<td class = "success text-left">{{$dr->ca}}</td>
								<td class = "success text-right"><strong>$ {{$dr->monto}}</strong></td>
				        		<td class = "success text-center" title="VER DETALLE">
									<a href="{{ route('reserva.show', $dr->reserva_id ) }}" class="btn btn-info btn-xs">
								  		<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
									</a>
								</td>
								<td class = "success text-center" title="EDITAR RESERVA">
									<form action="{{route('detalle_reserva.edit')}}" method="GET">
										<button type="submit" class="btn btn-warning btn-xs">
									  		<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
										</button>
										<input type="hidden" name="detalle_reserva_id" value="{{$dr->id}}">
									</form>
								</td>
							    <td class = "success text-center" title="CANCELAR RESERVA"> 	
					              	<form action="{{route('detalle_reserva.destroy', $dr->id)}}" method="POST"> 
		                				<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" 
		                				data-target="#modalConfirmacionAnularDetalle_{{$dr->id}}">
		                				<span class="glyphicon glyphicon-remove" aria-hidden="true" ></span></button>
		                				@include('reserva.viewsModals.confirmacionAnularDetalle')
					              	</form>
							    </td>    	
					        </tr>
					        @endif
				        @endforeach
			      	</tbody> 
			    </table>
			</div>
	  	</div>
  	</div>
</div>