@extends('layouts.mainMenu')

@section('content')
 	@if (!$ss)
  	 <div class="row">
		<div class="col-xs-10 col-sm-12 col-md-6 col-md-offset-3">
			<div class="progress">
  				<div class="progress-bar progress-bar-striped progress-bar-info active" role="progressbar" style="width: 25%">
  					<strong>Paso: 1/4</strong>	
 				</div>
			</div>
		</div>
	</div>
	@endif
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
			<div class="alert alert-info text-center" role="alert">
				@if (!$ss)
				<h5><strong>1- Editemos su Reserva</strong>, para la fecha {{$dr->fecha_reservada->format('d-m-Y')}}, Inicia: {{(int)$dr->hr_reservada}}: 00hs, Finaliza: {{(int)$dr->hr_reservada + $dr->cant_hs }}:00 hs. </h5>
				@endif
				@if ($ss)
				<h3>Solo puedes editar los servicios para la Reserva de la fecha: <b>{{$dr->fecha_reservada->format('d-m-Y')}}</b>, Inicia: <b>{{(int)$dr->hr_reservada}}: 00hs</b>, Finaliza: <b>{{(int)$dr->hr_reservada + $dr->cant_hs }}:00 hs.</b></h3>
				<p>Si desea cambiar la hora o fecha, debera CANCELAR la actual y generar una nueva.</p>
				@endif
			</div>
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-6 col-md-offset-3">
			@include('fragment.msg')
		</div>
	</div>	
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-md-6 col-md-offset-3">
		    <div id="reserva">
			    <div class="row">
			    	@if (!$ss)
				    <form class="form-group" method="POST" action="{{ route('detalle_reserva.update') }}" >
				    	<input  name="_method" type="hidden" value="PUT">
				    	<input  name="editar" type="hidden" v-bind:value="1">
				        <div class="form-group">
				          <span v-for="error in errors" class="text-danger"> @{{ error }}</span>
				        </div>
						<div class="row">
							<div class="text-center col-md-8 col-md-offset-2">
								<label>Consulte Nuevamente la fecha para buscar disponibilidad </label>
							</div>
						</div>
						
						@include('detalle_reserva.configurarDetalle')
		                
						<div class="row">
							<div class="col-xs-8 col-sm-8 col-md-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2">
								<div class="form-group" v-show="newCant_hs">
					               <button type="button" class="btn btn-primary btn-block" data-toggle="modal" 
					               	data-target="#ConfirmarEditarReserva">Siguiente
					                </button>
			            		</div>
							</div>
						</div>
		                <input type="hidden" name="detalle_reserva_id" value="{{$dr->id}}">
		                @include('detalle_reserva.modals.confirmacionEditarReserva')
		            </form>
					@endif
					<hr>
		        </div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-md-4 col-md-offset-4">
	        <div class="form-group">
	        	<form action="{{ route ('servicios_requeridos.editarServicios', $dr->id)}}" method="GET">
			        <button type="submit" class="btn btn-lg btn-primary btn-block"><b>EDITAR SERVICIOS</b></button>
	        	</form>
	        </div>
	    </div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-md-4 col-md-offset-4">
	        <div class="form-group">
	        	<form action="{{ route ('jugadores.create1', $dr->id)}}" method="GET">
			        <button type="submit" class="btn btn-lg btn-primary btn-block"><b>EDITAR JUGADORES</b></button>
	        	</form>
	        </div>
	    </div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-md-4 col-md-offset-4">
	        <div class="form-group">
	        	<form action="{{route('detalle_reserva.destroy', $dr->id)}}" method="POST"> 
    				<button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" 
    				data-target="#modalConfirmacionAnularDetalle_{{$dr->id}}"><b>CANCELAR</b></button>
    				@include('reserva.viewsModals.confirmacionAnularDetalle')
	        	</form>
	        </div>
	    </div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-md-4 col-md-offset-4">
	        <div class="form-group">
	            <a href="{{ route ('reserva.misReservas')}}" class="btn  btn-warning btn-block"><b>SALIR</b></a>
	        </div>
	    </div>
	</div>

	
@endsection
