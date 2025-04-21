@extends('layouts.mainMenu')

@section('content')
  	
  	<div class="row">
		<div class="col-xs-10 col-sm-12 col-md-6 col-md-offset-3">
			<div class="progress">
  				<div class="progress-bar progress-bar-striped progress-bar-info active" role="progressbar"  style="width: 25%">
  					<strong>Paso: 1/4</strong>
 				</div>
			</div>
		</div>
	</div>	
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
			<div class="alert alert-info text-center" role="alert">
				<h5><strong>1- Configuremos su reserva</strong>, solo necesitara ingresar los datos que se le solicita.</h5 class="text center">
			</div>
		</div>
		<div class="col-xs-12 col-sm-10 col-md-6 col-md-offset-3">
			@include('fragment.msg')
		</div>
	</div>	
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-6 col-xs-offset-2 col-sm-offset-2 col-md-offset-3">
		    <div id="reserva">		    	
		    	
		    	<div class="form-group">
  					<span v-for="error in errors" class="text-danger"> @{{ error }}</span>
				</div>
				<div class="row">
					<div class="text-center col-md-8 col-md-offset-2">
						<label>Seleccione la fecha que desea reservar </label>
					</div>
				</div>

			    <div class="row">
				    <form class="form-group" method="POST" action="{{ route('reserva.store') }}" >
				        @include('detalle_reserva.configurarDetalle')
		                <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
			                <div class="form-group" v-show="newCant_hs">
	                			{!! csrf_field()!!} <!-- funcion para el token -->
	                			<button type="submit" class="btn btn-primary btn-block"><b>SIGUIENTE</b></button>
				            </div>
				        </div>		                
		            </form>
		        </div>
		       	<div class="row">
		       		<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		            	<div class="form-group" v-show="newCancha_id">
		                	<a href="{{ route ('reserva.index')}}" class="btn btn-warning btn-block"><b>CANCELAR</b></a>
		                </div>
		            </div>
		        </div>
			</div>
		</div>
	</div>
	
@endsection
