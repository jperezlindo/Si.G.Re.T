
		<form action="{{route('fixture.primeraRonda')}}" method="POST">
			<div class="modal modal-primary fade" id="confirmacionInicio_{{$categoria->id}}">
			  	<div class="modal-dialog">
				    <div class="modal-content text-center">
				    	<div class="modal-header">
							<h3><strong>COMENZAR EL TORNEO PARA LA CATEGORIA</strong></h3>
				    	</div>
						<div class="modal-body">
							<h4>Esta por armar el fixture para la categoria.</h4>
							<h4>¿Realmente desea continuar?.</h4>
						</div>
					      <!-- Pie del Modal -->
						<div class="modal-footer" >
							<div class="row" v-show="newCant_hs">
								<div class="col-xs-10 col-sm-12 col-md-5 ">
									<div class="form-group">
										<button type="button" class="btn btn-warning btn-block" data-dismiss="modal">
											<b>SALIR</b>
										</button>
									</div>
								</div>
								<div class="col-xs-10 col-sm-12 col-md-5 col-md-offset-2">
									<div class="form-group">
										{!! csrf_field()!!} <!-- funcion para el token -->
										<button type="submit" class="btn btn-success btn-block">
											<b>CONTINUAR</b>
										</button>
										<input type="hidden" name="categoria_torneo_id" value="{{$categoria->id}}">
									</div>
								</div>
							</div>
						</div>
				    </div>
				</div>
			</div>
		</form>
