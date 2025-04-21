
	<div class="modal modal-primary fade" id="ConfirmacionAnularDetalleNC_{{$dr->id}}">
	  	<div class="modal-dialog">
		    <div class="modal-content">
		    	<div class="modal-header">
					<h3><strong>Realmente desea anular su Reserva?</strong></h3>
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
								<button type="button" class="btn btn-warning btn-block" data-dismiss="modal">Cancelar</button>
							</div>
						</div>
						<div class="col-xs-10 col-sm-12 col-md-6">
	                		<div class="form-group">
	                			{{ csrf_field() }}
	                			<input type="hidden" name="_method" value="DELETE">
	                			<button type="submit" class="btn btn-success btn-block">Aceptar</button>
	                		</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
	</div>

