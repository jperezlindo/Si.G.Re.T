@extends('layouts.mainMenu')

@section('content')
  
	 <div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
			<div class="progress">
  				<div class="progress-bar progress-bar-striped progress-bar-info active" role="progressbar" style="width: 25%">
  					<strong>Paso: 1/4</strong>	
 				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
			<div class="alert alert-info text-center" role="alert">
				<h5><strong>1- Agregaremos una nueva Cancha</strong>, solo necesitara ingresar los datos que se le solicita.</h5 class="text center">
			</div>
			<hr>
		</div>
		<div class="col-xs-12 col-sm-10 col-md-6 col-md-offset-3">
			@include('fragment.msg')
			@include('fragment.error')
		</div>
	</div>	
	<div class="row">
		<div class="col-xs-8 col-sm-10 col-md-6 col-xs-offset-2 col-md-offset-3">
		    <div id="reserva">
			    <div class="row">
			        <div class="form-group">
			         	<span v-for="error in errors" class="text-danger"> @{{ error }}</span>
			        </div>
					<div class="row">
						<div class="text-center col-md-8 col-md-offset-2">
							<label>Consulte la fecha para su cancha </label>
						</div>
					</div>
					<div class="row">
						<form class="form-group" method="POST" action="{{ route('detalle_reserva.store') }}" >
							@include('detalle_reserva.configurarDetalle')
			                <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-2">
				                <div class="form-group" v-show="newCant_hs">
		                			<a class="btn btn-primary btn-block" 
		                			data-toggle="modal" data-target="#ConfirmarAgregarCancha"><b>SIGUIENTE</b></a>
		                			@include('detalle_reserva.modals.ConfirmarAgregarCancha')
					            </div>
					        </div>
			                <input name="reserva_id" type="hidden" value="{{$reserva->id}}">
		            	</form>
		            </div>
		            <div class="row">
		       			<div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-2">
			            	<div class="form-group" v-show="newCancha_id">
			                	<a href="{{ route('reserva.show', $reserva->id ) }}" class="btn btn-warning btn-block"><b>SALIR</b></a>
			                </div>
			            </div>
			        </div>
		        </div>
			</div>
		</div>
	</div>
@endsection