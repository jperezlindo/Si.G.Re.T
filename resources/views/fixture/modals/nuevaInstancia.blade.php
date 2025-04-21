<div class="modal modal-primary fade" id="nuevaInstancia">
  	<div class="modal-dialog">
	    <div class="modal-content text-center">
	    	<div class="modal-header">
				<h3><strong>CONFIRMAR NUEVA INSTANCIA</strong></h3>
	    	</div>
			<div class="modal-body">
				<h4>Esta a punto de armar nuevos enfrentamientos para una nueva instancia. ¿Desea continuar?</h4>
			</div>
		      <!-- Pie del Modal -->
			<div class="modal-footer" >
				<div class="row" v-show="newCant_hs">
					<div class="col-xs-10 col-sm-12 col-md-5 ">
						<div class="form-group">
							<button type="button" class="btn btn-warning btn-block" data-dismiss="modal">
								<b>CANCELAR</b>
							</button>
						</div>
					</div>
					<div class="col-xs-10 col-sm-12 col-md-5 col-md-offset-2">
						<div class="form-group">
							{!! csrf_field()!!} <!-- funcion para el token -->
							<button type="submit" class="btn btn-success btn-block">
								<b>ACEPTAR</b>
							</button>
					        <input type="hidden" name="categoria_torneo_id" value="{{$par->categoria_torneo_id}}">
					        <input type="hidden" name="ins_fin" value="{{$par->instancia_id}}">
						</div>
					</div>
				</div>
			</div>
	    </div>
	</div>
</div>