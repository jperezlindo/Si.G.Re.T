@extends('layouts.mainMenu')

@section('content')

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
      <div class="alert alert-info text-center" role="alert">
        <h4><strong>INFORMACION DE MOVIMIENTO POR EL USUARIO</strong></h4>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-body">
          
		<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-2">
		  <div class="form-group text-left">
		    <label><b>Usuario</b></label><br>
		    <label><b>{{ $user->user }}</b></label><br>
		  </div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-2">
		  <div class="form-group text-left">
		    <label><b>Apellido</b></label><br>
		    <label><b>{{ $user->apellido }}</b></label><br>
		  </div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3">
		  <div class="form-group text-left">
		    <label><b>Nombre</b></label><br>
		    <label><b>{{ $user->name }}</b></label><br>
		  </div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3">
		  <div class="form-group text-left">
		    <label><b>Fecha y Hora</b></label><br>
		    <label><b>{{ $movi->fecha_hora }}</b></label><br>
		  </div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-2">
		  <div class="form-group text-left">
		    <label><b>Accion</b></label><br>
		    <label><b>{{ $movi->accion }}</b></label><br>
		  </div>
		</div>
		</div>
        <hr>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-2">
		      <div class="table-responsive">
		        <table class="table table-hover">
			        <thead class="">
			            <td class="active text-center"><strong>Campo</strong></td>
			        </thead>
			        <tbody>
			        @foreach ($new_data as $i => $n_d)
			            <tr>
			            	<td class = "success text-left">{{$i}}</td>
			            </tr>
					@endforeach
					</tbody>
		        </table>
		      </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-5">
		      <div class="table-responsive">
		        <table class="table table-hover">
			        <thead class="">
			            <td class="active text-center"><strong>Datos Actuales</strong></td>
			        </thead>
			        <tbody>
			        @foreach ($new_data as $i => $n_d)
			            <tr>
			            @if ($old_data[$i] == $n_d)
			            	<td class = "success text-left">{{$n_d}}</td>
			            @else
			               	<td class = "info text-left">{{$n_d}}</td>
			            @endif
			            </tr>
					@endforeach
					</tbody>
		        </table>
		      </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-5">
		      <div class="table-responsive">
		        <table class="table table-hover">
			        <thead class="">
			            <td class="active text-center"><strong>Datos Historicos</strong></td>
			        </thead>
			        <tbody>
			        @foreach ($old_data as $j => $o_d)
			            <tr>
			            @if ($new_data[$j] == $o_d)
			            	<td class = "success text-left">{{$o_d}}</td>
			            @else
			               	<td class = "danger text-left">{{$o_d}}</td>
			            @endif
			            </tr>
					@endforeach
					</tbody>
		        </table>
		      </div>
		    </div>
	  	</div>


        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-9 col-md-offset-1">
      <a href="{{route('auditoria.index')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>      
    </div>
    <div class="col-xs-12 col-sm-6 col-md-1">
      <a href="{{ route('auditoria.pdf', $movi->id) }}" class="btn btn-danger btn-block"><b>PDF</b></a>      
    </div>
  </div>


@endsection