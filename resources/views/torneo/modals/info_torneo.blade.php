<div class="modal modal-primary fade" id="info_torneo_{{ $categoria->id }}">
  	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
			<div class="modal-body">
				<h3><strong>INFORMACION DEL TORNEO</strong></h3>
			</div>
			<div class="modal-body">
			
			  <div class="row">
			    <div class="col-xs-12 col-sm-12 col-md-12">
			      <div class="panel panel-default">
			        <div class="panel-body">
			          
			          <div class="row">
			            <div class="col-xs-12 col-sm-12 col-md-4">
			              <div class="form-group text-center">
			                <label for="">Cupo de Equipos:</label><br>
			                <h4 for=""><b>{{$categoria->cupo}}</b></h4>
			              </div>
			            </div>
			            <div class="col-xs-12 col-sm-12 col-md-4">
			              <div class="form-group text-center">
			                <label for="">Valor Inscripcion:</label><br>
			                <h4 for=""><b>$ {{$categoria->valor}}</b></h4>
			              </div>
			            </div>
			            <div class="col-xs-12 col-sm-12 col-md-4">
			              <div class="form-group text-center">
			                <label for="">Tipo Equipo:</label><br>
			                @if ($categoria->n_ptes == 1)
			                	<h4 for=""><b>SINGLE</b></h4>
			                @else
			                	<h4 for=""><b>DOUBLE</b></h4>
			                @endif
			              </div>
			            </div>				       			      
			          </div>
			          <h4><strong>Puntos a Repartir</strong></h4>
			          <div class="row">
			            <div class="col-xs-12 col-sm-12 col-md-2 col-md-offset-1">
			              <div class="form-group text-center">
			                <label for="">Campeón:</label><br>
			                <h4 for=""><b>{{$categoria->campeon}} pts.</b></h4>
			              </div>
			            </div>
			            <div class="col-xs-12 col-sm-12 col-md-2 ">
			              <div class="form-group text-center">
			                <label for="">Sub Campeón:</label><br>
			                <h4 for=""><b>{{$categoria->subcampeon}} pts.</b></h4>
			              </div>
			            </div>
			            <div class="col-xs-12 col-sm-12 col-md-2 ">
			              <div class="form-group text-center">
			                <label for="">Semifinalistas:</label><br>
			                <h4 for=""><b>{{$categoria->semifinal}} pts.</b></h4>
			              </div>
			            </div>
			            <div class="col-xs-12 col-sm-12 col-md-2 ">
			              <div class="form-group text-center">
			                <label for="">Cuartos:</label><br>
			                <h4 for=""><b>{{$categoria->cuartos}} pts.</b></h4>
			              </div>
			            </div>
			            <div class="col-xs-12 col-sm-12 col-md-2 ">
			              <div class="form-group text-center">
			                <label for="">Octavos:</label><br>
			                <h4 for=""><b>{{$categoria->octavos}} pts.</b></h4>
			              </div>
			            </div>
			          </div>
			          <hr>	
					  <h4><strong>Posiciones</strong></h4>
			            <div class="row">
				            <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-2">
				              <div class="form-group text-center">
				                <label for="">Posicion:</label>
				              </div>
				            </div>
				            <div class="col-xs-12 col-sm-12 col-md-4 ">
				              <div class="form-group text-center">
				                <label for="">Equipo:</label>
				              </div>
				            </div>
			          	</div>
			          @foreach ($categoria['posiciones'] as $posicion)
			            <div class="row">
				            <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-2">
				              <div class="form-group text-center">
				                <h4><b>{{$posicion['ins']}}</b></h4><br>
				              </div>
				            </div>
				            <div class="col-xs-12 col-sm-12 col-md-4 ">
				              <div class="form-group text-center">
				                <h4><b>{{$posicion['eq']}}</b></h4><br>
				              </div>
				            </div>
			          	</div>
			          @endforeach

			        </div>
			      </div>
			    </div>
			  </div>
			</div>

		      <!-- Pie del Modal -->
			<div class="modal-footer" >
				<div class="row" v-show="newCant_hs">
					<div class="col-xs-10 col-sm-12 col-md-12">
						<div class="form-group">
							<button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><b>SALIR</b></button>
						</div>
					</div>
				</div>
			</div>
	    </div>
	</div>
</div>