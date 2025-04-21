@extends('layouts.mainMenu')

@section('content')
  
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
	  <div class="alert alert-info text-center" role="alert">
	    <h3><b>MOVIMIENTOS EN LA TABLA RESERVA POR USUARIO</b></h3>
	  </div>
	  <hr>
	</div>
	</div>


	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
	  <div class="table-responsive">
	    <table class="table table-hover">
	        <thead class="">
	            <td class="active text-left"><strong>Usuario</strong></td>
	        	<td class="active text-left"><strong>Numero</strong></td>
	            <td class="active text-left"><strong>Accion</strong></td>
	            <td class="active text-left"><strong>Fecha y Hora</strong></td>
	            <td class="active text-center"><strong>Ver</strong></td>
	        </thead>
	      @foreach ($movimientos as $movimiento)
	        <tbody>
	            <tr>
		            <td class = "success text-left"><b>{{$movimiento['u']}}</b></td>
		            <td class = "success text-center"><b>{{$movimiento['n']}}</b></td>
		            <td class = "success text-left"><b>{{$movimiento['m']->accion}}</b></td>
		            <td class = "success text-left"><b>{{$movimiento['m']->fecha_hora}}</b></td>
		            <td class = "success text-center" title="VER ACCION">
				      <a href="{{route('auditoria.reserva.movimiento', $movimiento['m']->id)}}" class="btn btn-info btn-xs">
				        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
				      </a>
				    </td>
				</tr>
			</tbody>
	      @endforeach
	    </table>
	  </div>
	</div>
	</div>

@endsection