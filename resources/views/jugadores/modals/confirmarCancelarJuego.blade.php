<div class="modal modal-primary fade" id="confirmarCancelarJuego">
  	<div class="modal-dialog">
	    <div class="modal-content">
			<div class="modal-body text-center">
				<h3><strong>¿REALMENTE DESEAS CANCELAR EL JUEGO?</strong></h3>
				<p>El mismo ya no aparecera el la lista de invitaciones</p>
			</div>
		      <!-- Pie del Modal -->
			<div class="modal-footer" >
				<div class="row" v-show="newCant_hs">
					<div class="col-xs-10 col-sm-12 col-md-6">
						<div class="form-group">
							<button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><b>SALIR</b></button>
						</div>
					</div>
					<div class="col-xs-10 col-sm-12 col-md-6">
                		<div class="form-group">
                			{!! csrf_field()!!} <!-- funcion para el token -->
                			<button type="submit" class="btn btn-success btn-block"><b>ACEPTAR</b></button>
                		</div>
					</div>
				</div>
			</div>
	    </div>
	</div>
</div>