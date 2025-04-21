@extends('layouts.mainMenu')

@section('content')

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
	 	<h2 class="text-center"><strong>Agregar nuevo Pais</strong></h2>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
	 	@include('flash::message')
	</div>
</div>

<!-- Agrega nuevos paises -->
<form class="form-group" method="POST" action="{{ route('main.storePais') }}" enctype="multipart/form-data"> 
	<hr>
    <div class="row">
    	<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
    		<div class="form-group">
      			<label for="">Nuevo Pais:* </label>
      			<input type="text" name="name" class="form-control" required placeholder="Nombre del Pais">
      		</div>
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
