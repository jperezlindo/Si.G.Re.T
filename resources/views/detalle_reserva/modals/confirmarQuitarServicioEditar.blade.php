<form action="{{route('servicios_requeridos.destroy', [$as->id, $dr->id, 1] )}}" method="POST">
  <div class="modal modal-primary fade" id="confirmarQuitarServicioEditar_{{$as->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body text-center">
          <h3>¿Quitar servicio contratato?</h3>
          <strong>El servicio sera quitado de su reserva actual, pero podra volver a agregarlo</strong>
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
                <input type="hidden" name="_method" value="DELETE">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>