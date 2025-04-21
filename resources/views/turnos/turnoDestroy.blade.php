<form action="{{route('empresa.turnos.destroy')}}" method="POST">
	<div class="modal modal-primary fade" id="turnoDestroy_{{$dia[4]}}">
	  	<div class="modal-dialog">
		    <div class="modal-content">
				<div class="modal-body text-center">
					<h3><strong>Realmente desea desactivar el turno?</strong></h3>
				</div>
			      <!-- Pie del Modal -->
				<div class="modal-footer" >
					<div class="row" v-show="newCant_hs">
						<div class="col-xs-10 col-sm-12 col-md-6">
							<div class="form-group">
								<button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><b>CANCELAR</b></button>
							</div>
						</div>
						<div class="col-xs-10 col-sm-12 col-md-6">
	                		<div class="form-group">
	                			{!! csrf_field()!!} <!-- funcion para el token -->
	                			<button type="submit" class="btn btn-success btn-block"><b>ACEPTAR</b></button>
	                			<input type="hidden" name="td_id" value="{{$dia[4]}}">
	                		</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
	</div>
</form>