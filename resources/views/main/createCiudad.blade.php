@extends('layouts.mainMenu')

@section('content')
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
	 	@include('flash::message')
	 	@include('fragment.msg')
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
	 	<h2 class="text-center"><strong>Agregar nueva Ciudad</strong></h2>
	</div>
</div>

<!-- Agrega nuevas ciudades -->
<form class="form-group" method="POST" action="{{ route('main.storeCiudad') }}" enctype="multipart/form-data"> 
	<hr>
    <div class="row">
    	<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
    		<div class="form-group">
	      		<label for="">Seleccionar Provincia </label>
	      		<select name="provincia_id" class="form-control"  required>
	      			<option value="">Seleccione la Provincia</option>
	            @foreach ($provincias as $provincia)
					<option value="{{ $provincia->id }}">  {{ $provincia->name }} | {{ $provincia->pais->name }}</option>
	            @endforeach
	       		</select>
	       	</div>
      	</div>
  	</div>
  	<div class="row">
    	<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
      		<label for="">Nueva Ciudad:* </label>
      		<input type="text" name="cp" class="form-control" maxlength="4" placeholder="Codigo Postal">
      		<br>
      		<input type="text" name="name" class="form-control"  placeholder="Nombre de la Ciudad" maxlength="35" required>
      	</div>
  	</div>
	<hr>

  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
      <div class="form-group">
        @include('fragment.error')
      </div>
    </div>
  </div>
	<div class="row">
	  <div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-3">
	  	<a href="{{route('home')}}" class="btn btn-warning  btn-block"
	    onclick ="return confirm('Desea cancelar la Accion?')"><b>SALIR</b></a>
	  </div>
	  <div class="col-xs-12 col-sm-6 col-md-3">
	    {!! csrf_field()!!} <!-- funcion para el token -->
	    <button type="submit" class="btn btn-success  btn-block"><b>GUARDAR</b></button>
	  </div>
	</div>
	<br>
</form>
@endsection