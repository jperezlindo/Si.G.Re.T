<div class="row">
  	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
	  	<div class="table-responsive">
		    <div class="form-group">
			    <h5><label class = "text-left"><span class="label label-warning">Canchas No Confirmadas</span></label></h5>
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
				    @foreach ($cnc as $dr)
				        <tr>
				        	<td class = "success text-left">{{$dr->reserva_id}}</td>
							<td class = "success text-left">{{$dr->fecha_reservada->format('d/m/Y')}}</td>
							<td class = "success text-left">{{(int)$dr->hr_reservada}}:00 hs.</td>
							<td class = "success text-left">{{(int)$dr->hr_reservada + $dr->cant_hs}}:00 hs.</td>
							<td class = "success text-right"><strong>$ {{$dr->monto}}</strong></td>
				        	
			        		<td class = "success text-right" title="VER DETALLE">
								<a href="{{ route('reserva.show', $dr->reserva_id ) }}" class="btn btn-info btn-xs">
							  		<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
								</a>
							</td>
							<td class = "success text-center" title="CONFIRMAR FECHA"> 	
				              	<form action="{{ route('detalle_reserva.confirmarDetalle')}}" method="POST"> 
	                				<button type="submit" class="btn btn-success btn-xs">{!! csrf_field()!!}
	                				<span class="glyphicon glyphicon-ok" aria-hidden="true" ></span></button>
	                				<input name="detalle_reserva_id" type="hidden" value="{{$dr->id}}">
				              	</form>
						    </td>	
			        		<td class = "success text-left" title="ANULAR FECHA"> 	
				              	<form action="{{route('detalle_reserva.destroy', $dr->id)}}" method="POST"> 
	                				<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" 
	                				data-target="#ConfirmacionAnularDetalleNC_{{$dr->id}}">
	                				<span class="glyphicon glyphicon-minus-sign" aria-hidden="true" ></span></button>
	                				@include('detalle_reserva.modals.confirmacionAnularDetalleNC')
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