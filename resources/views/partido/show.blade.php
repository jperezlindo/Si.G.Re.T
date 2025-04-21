@extends('layouts.mainMenu')

@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
	    <div class="alert alert-info text-center" role="alert">
		 	<h2 class="text-center">
		 		<strong>{{ $partido->instancia->name}}</strong>...
		 		Partido: <strong>{{ $partido->name}}</strong>
		 	</h2>
	    </div>
    </div>
</div>


	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-3">
          <div class="form-group">
          <label for="">Fecha:* </label>
		  <input type="text" class="form-control" value="{{ $partido->cancha}}" readonly>
          </div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-">
		  <div class="form-group">
          <label for="">Fecha:* </label>
		  <input type="date" class="form-control" value="{{ $partido->fecha->toDateString()}}" readonly>
		  </div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-3">
		  <div class="form-group ">
		    <label >Inicio a las</label>
		    <input class="form-control" type="text" value="{{ $partido->hr_ini}} hs." readonly>
		  </div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-">
		  <div class="form-group ">
		    <label>finalizo a las</label>
		    <input class="form-control" type="text" value="{{ $partido->hr_fin}} hs." readonly>
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
		    <input class="text-center" type="number" value="{{ $dp[0]->set_01 }}" readonly>
		  </div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-2">
		  <div class="form-group text-center">
		    <label for="{{ $dp[0]->id }}">SET_02</label>
		    <input class="text-center" type="number" value="{{ $dp[0]->set_02 }}" readonly>
		  </div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-2">
		  <div class="form-group text-center">
		    <label for="{{ $dp[0]->id }}">SET_03</label>
		    <input class="text-center" type="number" value="{{ $dp[0]->set_03 }}" readonly>
		  </div>
		</div>		
	</div>
@endforeach
  	<div class="row">
    	<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
      		<label for="">Comentario</label>
            <textarea class="form-control" rows="5" name="comentario" readonly>
            	{{ $dp[0]->comentario}}
            </textarea>
      	</div>
  	</div>
	<hr>
	<div class="row">
	  <div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
	    <a href="{{route('fixture.fixture', $partido->categoria_torneo_id)}}" class="btn btn-warning  btn-block"><b>SALIR</b></a><br>
	  </div>
	</div>
@endsection