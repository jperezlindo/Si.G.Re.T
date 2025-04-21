@extends('layouts.mainMenu')

@section('content')

@if ($uee)
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		  <div class="alert alert-info text-center">
		    <h3 class="text-center"><strong>Mi Equipo</strong></h3>Aqui podra visualizar los datos de su equipo
		  </div>
		  <hr>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-12">
		  <div class="form-group">
		    @include('fragment.msg')
		    @include('fragment.error')
		  </div>
		</div>
	</div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6">
              <div class="form-group text-center">
                <label for="">Nombre del equipo:</label><br>
                <h4 for=""><b>{{$uee->equipo->name}}</b></h4>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
              <div class="form-group text-center">
                <label for="">Categoria del Equipo:</label><br>
                <h4 for=""><b>
                	{{$uee->equipo->categoria->c_etario->name}}-{{$uee->equipo->categoria->c_sexo->name}}-{{$uee->equipo->categoria->c_categoria->name}}
                </b></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
	
	@if ($ints)
	<div class="row">
	    <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead class="">
						<td class="active text-center"><strong>Usuario</strong></td>
						<td class="active text-center"><strong>Apellido</strong></td>
						<td class="active text-center"><strong>Nombre</strong></td>
						<td class="active text-center"><strong>Puntos</strong></td>
						<td class="active text-center"><strong>Torneos Jugados</strong></td>
						<td class="active text-center"><strong>Quitar Jugador</strong></td>
					</thead>
					@foreach ($ints as $int)
					<tbody>
					  <tr>
					    <td class = "success text-center">{{$int['us']}}</td>
					    <td class = "success text-center">{{$int['ap']}}</td>
					    <td class = "success text-center">{{$int['no']}}</td>
					    <td class = "success text-center">{{$int['pu']}}</td>
					    <td class = "success text-center">{{$int['tj']}}</td>

					   	<td class = "success text-center" title="DA DE BAJA EL USUARIO DEL EQUIPO">
					      <form action="{{route('miequipo.quitar.jugador')}}" method="POST">
					      	{{ csrf_field() }}  	
					      	<button  type="button" class="btn btn-danger btn-xs" data-toggle="modal" 
	                		data-target="#confirmarQuitarJugador">
					        <span class=" glyphicon glyphicon-remove" aria-hidden="true"></span>
					        <input type="hidden" name="_method" value="DELETE">
					        <input type="hidden" name="user_empresa_equipo_id" value="{{ $int['id'] }}">
					      	</button>
					      	@include('mi_equipo.modals.confirmarQuitarJugador')
					      </form>
					    </td>
					  </tr>
					</tbody>	
					@endforeach
				</table>
			</div>
	    </div>
	    <div class="col-xs-12 col-sm-6 col-md-4">

	    </div>
	</div>
	@else
	  <div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
	      <div class="alert alert-info" role="alert">
	        <h3 class="text-center"><strong>Su EQUIPO no tiene integrantes.</strong></h3>
	      </div>
	    </div>
	  </div>
	@endif
@else
<hr>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="alert alert-info" role="alert">
        <h3 class="text-center"><strong>Usted no se sencuentra asociado a ningun EQUIPO.</strong></h3>
      </div>
    </div>
  </div>
@endif
<hr>
<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-2">
    <div class="form-group">
        <a href="{{ route('home') }}" class="btn btn-warning btn-block"><b>SALIR</b></a>
    </div>
  </div>
  <div class="col-xs-12 col-sm-2 col-md-2 col-md-offset-1">
    <div class="form-group">
    @if ($uee)
    	<a href="{{ route('equipo.edit', $uee->equipo_id) }}" class="btn btn-primary  btn-block"><b>EDITAR EQUIPO</b></a>
    @endif
    </div>
  </div>
  
  <div class="col-xs-12 col-sm-12 col-md-2 col-md-offset-1">
    <div class="form-group">
    	<a href="{{ route('equipo.index') }}" class="btn btn-primary  btn-block"><b>ASOCIARME A UN EQUIPO</b></a>
    </div>
  </div>
  
</div>

@endsection