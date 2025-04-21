
	<div class="modal modal-primary fade" id="abonarReserva_{{$reserva->id}}">
	  	<div class="modal-dialog modal-lg">
		    <div class="modal-content">
	    		<div class="modal-header">
					<strong>ESTA POR ABONAR SU RESERVA EN: {{ Auth::user()->user_empresa->empresa->name }}</strong>
		    	</div>
				<div class="modal-body">
					<h3 class="text-center"><strong>INGRESE LOS DATOS DE SU TARJERA</strong></h3>
					<hr>
					<div class="row">
	      				<div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
						  <div class="form-group">
						    <label>NUMERO DE TARJETA</label>
						    <input type="number" class="form-control" placeholder="ingrese los numero sin espacios">
						  </div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-">
						  <div class="form-group">
						    <label>FECHA EXPIRACION</label>
						    <input type="text" class="form-control" placeholder="en formato MMAA">
						  </div>
						</div>
					</div>
					<div class="row">
	      				<div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
						  <div class="form-group">
						    <label>TITULAR</label>
						    <input type="text" class="form-control" placeholder="Como figura en la tarjeta">
						  </div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-">
						  <div class="form-group">
						    <label>CODIGO DE SEGURIDAD</label>
						    <input type="number" class="form-control" placeholder="xxx">
						  </div>
						</div>
					</div>
					<div class="row">
	      				<div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
						  <div class="form-group">
						    <label>EMAIL:</label>
						    <input type="email" class="form-control" placeholder="ejemplo@ejemplo.com">
						  </div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-">
						  <div class="form-group">
						    <label>DIRECCION</label>
						    <input type="text" class="form-control" placeholder="mo figura en el resumen">
						  </div>
						</div>
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
	                			{!! csrf_field()!!} <!-- funcion para el token -->
	                			<button type="submit" class="btn btn-success btn-block"><b>ACEPTAR</b></button>
	                			<input type="hidden" name="reserva_id" value="{{$reserva->id}}">
	                		</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
	</div>
