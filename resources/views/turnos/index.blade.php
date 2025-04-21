@extends('layouts.mainMenu')

@section('content')


  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="alert alert-info text-center" role="alert">
       <h1><b>TURNOS PARA LA EMPRESA</b></h1>
      </div>
      <hr>
    </div>
    <div class="col-xs-12 col-sm-10 col-md-10 col-md-offset-1">
      @include('fragment.msg')
    </div>
  </div>

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-2 col-md-offset-2">
  	<a href="{{ route('empresa.turnos.create')}}" class="btn btn-primary btn-block"><b>NUEVO TURNO</b></a><br>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
	<div class="table-responsive">
		<table class="table table-hover">
			<thead class="">
				<td class="active text-center"><strong>TURNO</strong></td>
				<td class="active text-center"><strong>DESDE</strong></td>
				<td class="active text-center"><strong>HASTA</strong></td>
				<td class="active text-center"><strong>Editar</strong></td>
			</thead>
			<tbody>
			@php $a=''; @endphp	
			@foreach ($turnos as $turno)
			  <tr>
				<td class="success text-center">{{ $turno->name}}</td>
				<td class="success text-center">{{ $turno->hr_ini}}</td>
				<td class="success text-center">{{ $turno->hr_fin}}</td>
			    <td class = "success text-center" title="EDITAR TURNO">
			      <a href="{{ route('empresa.turnos.edit', $turno->id)}}" class="btn btn-warning btn-xs">
			        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
			      </a>
			    </td>
			  </tr>
			@endforeach
			</tbody>
		</table>
	</div>
  </div>	
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
	  <div class="alert alert-info text-center" role="alert">
	   <h4><b>TURNOS POR DIAS</b></h4>
	  </div>
	  <hr>
	</div>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
	<div class="table-responsive">
		<table class="table table-hover">
			<thead class="">
				<td class="active text-center"><strong>DIA</strong></td>
				<td class="active text-center"><strong>TURNO</strong></td>
				<td class="active text-center"><strong>DESDE</strong></td>
				<td class="active text-center"><strong>HASTA</strong></td>
				<td class="active text-center"><strong>Desactivar</strong></td>
			</thead>
			<tbody>
			@php $a=''; @endphp	
			@foreach ($dias as $dia)
			  <tr>
			  	@if ($dia->get(0) <> $a)
				  	@php $a = $dia[0]; @endphp
			  		<td class = "success text-left">{{$a}}</td>
				@else
				<td class = "success text-center"></td>
				@endif

			  	@foreach ($dia as $i => $d)
			  		@if ($d <> $a and $i <> 4)
			  		<td class = "success text-center">{{$d}}</td>
			  		@endif
				@endforeach	
			    <td class = "success text-center" title="DESACTIVAR TURNO">
			 		<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" 
		            	data-target="#turnoDestroy_{{$dia[4]}}"><span class="glyphicon glyphicon-remove" aria-hidden="true" ></span></button>
		            @include('turnos.turnoDestroy')
			    </td>
			  </tr>
			@endforeach
			</tbody>
		</table>
	</div>
  </div>	
</div>

@endsection