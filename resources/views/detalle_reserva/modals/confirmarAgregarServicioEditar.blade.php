<form action="{{ route('servicios_requeridos.store') }}" method="POST">
	{{ csrf_field() }}    
	 <div class="modal modal-primary fade" id="ConfAgreSerEdit_{{$disponible->id}}">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-body text-center">
	          <h2><b>Agregar servicio</b></h2>
	          <b>El servicio sera agregado a su reserva actual, podra quitarlo cuando quiera.</b>
	        </div>
	          <!-- Pie del Modal -->
	        <div class="modal-footer" >
	          <div class="row" v-show="newCant_hs">
	            <div class="col-xs-10 col-sm-12 col-md-6 col-xs-offset-">
	              <div class="form-group">
	                <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><b>CANCELAR</b></button>
	              </div>
	            </div>
	            <div class="col-xs-10 col-sm-12 col-md-6">
	              <div class="form-group">
	                {{ csrf_field() }}  
	                <button type="submit" class="btn btn-success btn-block"><b>ACEPTAR</b></button>
	                <input name="cancha_servicio_id" type="hidden" value="{{$disponible->id}}">
					<input name="detalle_reserva_id" type="hidden" value="{{$dr->id}}">
					<input name="editar" type="hidden" value="1">
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
	</div>
</form>