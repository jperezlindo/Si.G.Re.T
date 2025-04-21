@extends('layouts.mainMenu')

@section('content')
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-12">
	 	@include('fragment.msg')
	</div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
      <div class="alert alert-info text-center" role="alert">
         <h2 class="text-center">TORNEO: <strong>{{ $torneo->name }}</strong></h2>
          
	 	<h3 class="text-center">
	 		<strong>{{ $partido->instancia->name}}</strong>...
	 		Partido: <strong>{{ $partido->name}}</strong>
	 	</h3>
	 	<h4 class="text-center">categoria: <strong>{{ $categoria }}</strong></h4>
      </div>
    </div>
</div>

<form class="form-group" method="POST" action="{{ route('partido.store') }}"> 
	
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-3">
		  <div class="form-group">
          <label for="">Fecha del partido:* </label>
          @if ($partido->cancha == 'CANCHA')
          	<input  type="date" class="form-control" name="fecha" min="{{$desde}}" max="{{$hasta}}" value="{{date('Y-m-d')}}" required>
          @else
			<input  type="date" class="form-control" min="{{$desde}}" max="{{$hasta}}" name="fecha"  value="{{ $partido->fecha->toDateString()}}" required>
          @endif

		  </div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-">
          <div class="form-group">
            <label for="">Cancha en la cual se jugo: </label>
            <select name="cancha" class="form-control" required>
			  @if ($partido->cancha == 'CANCHA')
				<option value="">Seleccione la cancha</option>
			  @else
				<option value="{{ $partido->cancha}}">{{ $partido->cancha}}</option>
			  @endif
              @foreach ($canchas as $cancha)
                <option value="{{$cancha->name}}"> 
                  {{$cancha->name}}
                </option>
              @endforeach
            </select>
          </div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-3">
		  <div class="form-group">
		    <label>Hora que inicio:* </label>
		    <input id="ini" class="form-control" type="time" min="{{$hora}}" name="hr_ini" value="{{ $partido->hr_ini}}" required>
		  </div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-">
		  <div class="form-group">
		    <label>Hora que finalizo:*</label>
		    <input id="fin" class="form-control" type="time" min="08:00" name="hr_fin" value="{{ $partido->hr_fin}}" onBlur="hora_partido()" required>
		    <span class="label label-danger" id="error_fin"></span>
		  </div>
		</div>
	</div>

@foreach($partido_ as $dp)
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
		  <div class="form-group text-center">
		      <div class="panel panel-info">
			    <div class="panel-heading">
			  		<h4><b>Equipo: {{ $dp[0]->equipo->name }}</b></h4>
					<label> Jugadores:
						@foreach ($dp[1] as $name)
							{{ $name }}
						@endforeach
							 @if ($dp[0]->isWinn)
								<span class="label label-success">GANADOR</span>
			  				@endif
					</label>
			   </div>
		  	</div>		    
		  </div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-3">
		  <div class="form-group text-center">
		    <label for="{{ $dp[0]->id }}">SET_01</label>
		    <input class="text-center" type="number" min="0" name="set_01[]" id="{{$dp[0]->id}}" value="{{ $dp[0]->set_01 }}" required>
		  </div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-2">
		  <div class="form-group text-center">
		    <label for="{{ $dp[0]->id }}">SET_02</label>
		    <input class="text-center" type="number" min="0" name="set_02[]" id="{{$dp[0]->id}}" value="{{ $dp[0]->set_02 }}" required>
		  </div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-2">
		  <div class="form-group text-center">
		    <label for="{{ $dp[0]->id }}">SET_03</label>
		    <input class="text-center" type="number" min="0" name="set_03[]" id="{{$dp[0]->id}}" value="{{ $dp[0]->set_03 }}" required>
		  </div>
		</div>		
	</div>
@endforeach
  	<div class="row">
    	<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
      		<label for="">Comentario:*</label>
            <textarea class="form-control" rows="5" name="comentario" style="text-transform: uppercase;" required>
            	{{ $dp[0]->comentario}}
            </textarea>
            <input type="hidden" name="ct_id" value="{{ $partido->categoria_torneo_id }}">
            <input type="hidden" name="partido_id" value="{{ $partido->id }}">
      	</div>
  	</div>
	<hr>
	<div class="row">
	  <div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-3">
	    <a href="{{route('fixture.show', $partido->categoria_torneo_id)}}" class="btn btn-warning  btn-block"><b>SALIR</b></a><br>
	  </div>
	  <div class="col-xs-12 col-sm-6 col-md-3">
	    {!! csrf_field()!!} <!-- funcion para el token -->
	    <button type="submit" class="btn btn-success  btn-block"><b>GUARDAR</b></button>
	  </div>
	</div>

</form>
@endsection