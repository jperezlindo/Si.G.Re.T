<div class="modal modal-primary fade" id="confirmacionFinalizarDetalleOK_{{$dr->id}}">
  	<div class="modal-dialog">
	    <div class="modal-content text-center">
	    	<div class="modal-header">
				<h3><strong>FINALIZAR JUEGO</strong></h3>
	    	</div>
			<div class="modal-body">
				<div class="form-froup">
					<p>FINALIZARA LA FECHA, INDICANDO QUE LA MISMA SE JUGO EN TIEMPO Y FORMA</p>
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
                			<input type="hidden" name="detalle_reserva_id" value="{{$dr->id}}">
                			<button type="submit" class="btn btn-success btn-block"><b>ACEPTAR</b></button>
                		</div>
					</div>
				</div>
			</div>
	    </div>
	</div>
</div>