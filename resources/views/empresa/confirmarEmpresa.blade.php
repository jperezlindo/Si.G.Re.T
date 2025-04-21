<div class="modal modal-primary fade" id="confirmarEmpresa">
  	<div class="modal-dialog">
	    <div class="modal-content text-center">
	    	<div class="modal-header">
				<h3><strong>¿DESEA GUARDAR LOS CAMBIOS?</strong></h3>
	    	</div>


		      <!-- Pie del Modal -->
			<div class="modal-footer" >
				<div class="row">
					<div class="col-xs-10 col-sm-12 col-md-6">
						<div class="form-group">
							<button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><b>CANCELAR</b></button>
						</div>
					</div>
					<div class="col-xs-10 col-sm-12 col-md-6">
                		<div class="form-group">
                			{{ csrf_field() }}
                			<button type="submit" class="btn btn-success btn-block"><b>ACEPTAR</b></button>
                		</div>
					</div>
				</div>
			</div>
			
	    </div>
	</div>
</div>