<div class="modal modal-primary fade" id="confirmacionAnular_{{$ins->id}}">
  	<div class="modal-dialog">
	    <div class="modal-content text-center">
	    	<div class="modal-header">
				<h3><strong>CONFIRMACION DE CANCELACION DE INSCRIPCION</strong></h3>
	    	</div>
			<div class="modal-body">
				<div class="form-froup">
					<p>¿ESTA SEGURO DE CONFIRMAR SU NO PARTICIPACION EN EL TORNEO?</p>
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