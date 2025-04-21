@extends('layouts.mainMenu')

@section('content')

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="alert alert-info text-center" role="alert">
       <h1><b>AGREGAR NUEVO TURNO</b></h1>
      </div>
    </div>
    <div class="col-xs-12 col-sm-10 col-md-12 col-md-offset-">
      @include('fragment.msg')
      @include('fragment.error')
    </div>
  </div>

@if ($create)
<form class="form-group" method="POST" action="{{ route('empresa.turnos.store') }}"> 
@else
<form class="form-group" method="POST" action="{{ route('empresa.turnos.update') }}">
<input type="hidden" name="turno_id" value="{{$turno->id}}">
@endif   
    <div class="row">
    	<div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-2">
      		<label for="">Nombre </label>
      		@if ($create)
				<input type="text" name="name" class="form-control" required>
      		@else
				<input type="text" name="name" class="form-control" value="{{$turno->name}}" readonly>
      		@endif  
      		
      	</div>
    	<div class="col-xs-12 col-sm-12 col-md-2">
      		<label for="">Hora Inicio </label>
      		<input  type="time" min="0" max="24" name="hr_ini" class="form-control" value="{{$turno->hr_ini}}" required >
      	</div>
    	<div class="col-xs-12 col-sm-12 col-md-2">
      		<label for="">Hora Fin</label>
      		<input  type="time" min="0" max="24" name="hr_fin" class="form-control" value="{{$turno->hr_fin}}" required><br>
      	</div>
  	</div>
  	<div class="row">
	  <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
	    {!! csrf_field()!!} <!-- funcion para el token -->
	    <button type="submit" class="btn btn-success  btn-block"><b>GUARDAR</b></button>
	    <input type="hidden" name="flag" value="1">
	  </div>
	</div>
</form>
<hr>
<form class="form-group" method="POST" action="{{ route('empresa.turnos.store') }}"> 
    <div class="row">
    	<div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-2">
    		<div class="form-group">
	      		<label for="">Seleccionar Dia</label>
	      		<select name="dia_id" class="form-control" required>
	      		<option value="">Eliga el dia</option>
	            @foreach ($dias as $dia)
					<option value="{{ $dia->id }}">  {{ $dia->name }} </option>
	            @endforeach
	       		</select>
	       	</div>
      	</div>
    	<div class="col-xs-12 col-sm-12 col-md-4">
    		<div class="form-group">
	      		<label for="">Seleccionar Turno</label>
	      		<select name="turno_id" class="form-control" required>
	      		<option value="">Eliga el turno</option>
	            @foreach ($turnos as $turno)
					<option value="{{ $turno->id }}">  {{ $turno->name }} </option>
	            @endforeach
	       		</select>
	       	</div>
      	</div>
  	</div>
  	<div class="row">
	  <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
	    {!! csrf_field()!!} <!-- funcion para el token -->
	    <button type="submit" class="btn btn-success  btn-block"><b>AGREGAR</b></button>
	    <input type="hidden" name="flag" value="0">
	  </div>
	</div>
</form>
	<hr>
	<div class="row">
	  <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
	  	<a href="{{route('empresa.turnos.index')}}" class="btn btn-primary  btn-block"><b>VOLVER</b></a>
	  </div>
	  <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-">
	  	<a href="{{route('home')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>
	  </div>
	</div>
	

@endsection