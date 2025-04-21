<div class="modal modal-primary fade" id="ConfirmarEditarReserva">
  	<div class="modal-dialog modal-sm">
	    <div class="modal-content">
			<div class="modal-body">
				<strong>Realmente desea Guardar los Cambios de su Reserva?</strong>, la misma no sera confirmada hasta ser finalizarla.
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
                			{!! csrf_field()!!} <!-- funcion para el token -->
                			<button type="submit" class="btn btn-success btn-block">Aceptar</button>
                		</div>
					</div>
				</div>
			</div>
	    </div>
	</div>
</div>
