
	<div class="modal modal-primary fade" id="modalConfirmacionAnularDetalle_{{$dr->id}}">
	  	<div class="modal-dialog">
		    <div class="modal-content">
		    	<div class="modal-header">
					<h3><strong>Realmente desea anular la Fecha y Cancha?</strong></h3>
		    	</div>
				<div class="modal-body">
					<div class="form-froup">
						<label for="">Dejanos un comentario</label>
						<textarea class="form-control" rows="3" name="comentario"></textarea>
					</div>
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
	                			{{ csrf_field() }}
	                			<input type="hidden" name="_method" value="DELETE">
	                			<button type="submit" class="btn btn-success btn-block"><b>ACEPTAR</b></button>
	                		</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
	</div>

