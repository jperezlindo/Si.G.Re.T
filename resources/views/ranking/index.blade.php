@extends('layouts.mainMenu')

@section('content')
  	
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
			<div class="alert alert-info text-center" role="alert">
				<h3><strong>Ranking</strong>, aqui podra visualizar las posicion actual de los jugadores.</h3 class="text center">
			</div>
		</div>
	</div>	
	<form class="form-group" method="GET" action="{{ route('ranking.index') }}">
	    <div class="row">
	    	<div class="form-group ">
	    		<div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4 input-group">
					<select class="form-control" name="categoria_id" required>
						<option value="">Seleccione una categoria</option>
						@foreach ($categorias as $cat)
						  <option value="{{$cat->id}}"> 
						    {{$cat->c_etario->name}} | {{$cat->c_sexo->name}} | {{$cat->c_categoria->name}}  
						  </option>
						@endforeach
					</select>       		
			        <span class="input-group-btn" v-show="newFecha">
			            <button type="submit" class="btn btn-info" title="PRESIONE PARA VER RANKING" >
			              <b>VER RANKING</b>
			            </button>
			        </span> 
	    		</div>
	    	</div>
	    </div>
	</form>

	@if ($categoria)
	<div class="row">
	  	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		  	<div class="table-responsive">
			    <div class="form-group">
				    <div class="text-center" >
				    <h3><span class="label label-info">
				     {{$categoria->c_etario->name}}-{{$categoria->c_sexo->name}}-{{$categoria->c_categoria->name}}
				    </span></h3>
					</div>
				    <table class="table table-hover table-striped">
					    <thead class="">
					    	<td class="active text-center"><strong>Posición</strong></td>
					        <td class="active text-left"><strong>Jugador</strong></td>
					        <td class="active text-center"><strong>Puntos</strong></td>
					        <td class="active text-center"><strong>Promedio</strong></td>
					        <td class="active text-center"><strong>Torneos Jugados</strong></td>
					    </thead>
					    <tbody>
					    @foreach ($posiciones as $i => $posicion)
					        <tr>
					        	<td class = "success text-center"><b>{{ $i + 1}}</b></td>
								<td class = "success text-left"><b>{{ $posicion->user_empresa->user->user}}</b></td>
								<td class = "success text-right"><b>{{ $posicion->puntos}}</b></td>
								<td class = "success text-right"><b>{{ $posicion->promedio}}</b></td>
								<td class = "success text-center"><b>{{ $posicion->torneos_jugados}}</b></td>
					        </tr> 
				      	@endforeach
				      	</tbody> 
				    </table>
				</div>
		  	</div>
	  	</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-md-8 col-md-offset-2">
			@include('flash::message')
		</div>
	</div>
	@endif

	<br>
    <div class="row">
    	@if ($categoria)
      		<div class="col-xs-12 col-sm-6 col-md-7 col-md-offset-2">
      	@else
			<div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
      	@endif	
        <a href="{{route('home')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a><br>
      </div>
      @if ($categoria)
      <div class="col-xs-12 col-sm-2 col-md-1">
        <form action="{{route ('ranking.pdf_x_categoria')}}" method="GET">
        	<input type="hidden" name="empresa_id" value="{{Auth::user()->user_empresa->empresa_id}}">
        	<input type="hidden" name="categoria_id" value="{{$categoria->id}}" required>
        	{!! csrf_field()!!} <!-- funcion para el token -->
        	<button type="submit" class="btn btn-danger btn-block"><b>PDF</b></button>
        </form>
      </div>
      @endif
    </div>
@endsection