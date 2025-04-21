@extends('layouts.mainMenu')

@section('content')

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
	 	@include('fragment.msg')
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
	 	<h2 class="text-center"><strong>Agregar nuevo Servicio</strong></h2>
	</div>
</div>

<!-- Agrega nuevaos Servicios -->
<form class="form-group" method="POST" action="{{ route('servicio.store') }}" enctype="multipart/form-data"> 
	<hr>
  	<div class="row">
    	<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
      		<label for="">Nombre del Servico que se va a brindar:*</label>
      		<input type="text" maxlength="50" name="name" class="form-control" placeholder="Luz, Techo, Estacionamiento, etc." style="text-transform: uppercase;" value="{{old('name')}}" required>
      		<br>
      		<label for="">Descripcion:* </label>
            <textarea class="form-control" rows="5" name="descripcion" style="text-transform: uppercase;" required maxlength="250"></textarea>
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