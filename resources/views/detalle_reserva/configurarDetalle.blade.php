<div class="row">

  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">  
    <div class="row">
    	<div class="form-group ">
    		<div class="col-xs-12 col-sm-12 col-md-8 col-xs-offset- col-sm-offset- col-md-offset-2 input-group">
        		<input type="date" class="form-control" name="fecha_reservada" v-model="newFecha" 
                    title="INGRESE LA FECHA QUE DESEA CONSULTAR" >
    	        <span class="input-group-btn" v-show="newFecha">
    	            <button type="submit" class="btn btn-info" v-on:click.prevent="getCanchas" title="PRESIONE PARA CONSULTAR FECHA" >
    	              <b>Consultar Fecha</b>
    	            </button>
    	        </span>
    		</div>
    	</div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-md-offset-">
      <div class="form-group text-center">  
        <span class="label label-danger" v-if="canchas.f==1">FEHCA NO VALIDA. POR FAVOR SELECCIONE UNA NUEVA FECHA.</span>
        <span class="label label-warning" v-if="canchas.f == 2">NO ATENDEMOS EN EL DIA SELECCIONADO. SEPA DISCULPAR, GRACIAS</span>
      </div> 
    </div>
    <div class="form-group" v-if="canchas.length">
      <label>Seleccione la Cancha que desea Reservar:</label>
      <select class="form-control" name="cancha_id" v-model="newCancha_id" v-on:click.prevent="getHoras" required>
        <option disable value="">Seleccionar una cancha</option>
        <option  v-for="cancha in canchas" v-bind:value="cancha.id" >@{{ cancha.name }}</option>
      </select>
    </div>

    <div class="form-group" v-show="newCancha_id">
      <label>Seleccione la Hora que desea Reservar</label>
      <select class="form-control" name="hr_reservada" v-model="newHr_reservada" v-on:click.prevent="getHsRes" required>
        <option disable value="">Seleccione la hora de su reserva</option>                 
        <option  v-for="hora in horas" v-bind:value="hora" >@{{ hora }}:00 hs.</option>
      </select>
    </div>

    <div class="form-group" v-show="newHr_reservada">
      <label>Seleccione la Cantidad de Horas que desea reservar</label>
      <select class="form-control" name="cant_hs" v-model="newCant_hs" required >
        <option disable value="">selecione la cantidad de horas a reservar</option>
        <option v-for="ch in can_hs" v-bind:value="ch">@{{ ch }}</option>
      </select>
    </div>

  </div>
</div>