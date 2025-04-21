  <div class="modal modal-primary fade" id="finalizarReserva">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      	<div class="modal-header">
        	
          <div class="row">
            <div class="col-xs-10 col-sm-12 col-md-8 col-md-offset-2">
              <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-info active" role="progressbar" style="width: 100%">
                    <strong>Paso: 4/4</strong>
                </div>
              </div>
              <h3><strong>4 - Como desea continuar?.</strong></h3>
            </div>
          </div>
          
		    </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
              <div class="form-group">
                <form action="{{route('detalle_reserva.index')}}" method="GET"> 
                  {!! csrf_field()!!}
                  <button type="submit" class="btn btn-info btn-block" ><b>AGREGAR NUEVA CANCHA</b></button>
                  <input name="reserva_id" type="hidden" value="{{$dr->reserva_id}}">
                </form>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
              <div class="form-group">
                <form action="{{route('reserva.confirmarReserva')}}" method="POST">
                  {!! csrf_field()!!}
                  <button type="submit" class="btn btn-success btn-block" data-toggle="modal" data-backdrop="static" 
                  data-target="#cargando"><b>FINALIZAR</b></button>
                  <input type="hidden" name="reserva_id" value="{{$dr->reserva_id}}">
                </form>
              </div>
            </div>
          </div>
        </div>
          <!-- Pie del Modal -->
        <div class="modal-footer" >
            <div class="row">
              <div class="col-xs-12 col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
                <div class="form-group">
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><b>VOLVER</b></button>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal modal-success fade" id="cargando">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3>Estamos Notificando a los Jugadores</h3>
          <hr>
          <div class="progress">
            <div class="progress-bar progress-bar-success progress-bar-striped active" style="width: 100%">
            </div>
          </div>
          <h3>Por favor aguarde unos segundos. Gracias!!!</h3>
        </div>
      </div>
    </div>
  </div>