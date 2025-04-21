@extends('layouts.mainMenu')

@section('content')

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
	 	<h2 class="text-center"><strong>Agregar nuevo Rol</strong></h2>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
	 	@include('flash::message')
	</div>
</div>

<!-- Agrega nuevos paises -->
<form class="form-group" method="POST" action="{{ route('main.storeRol') }}" enctype="multipart/form-data"> 
	<hr>
    <div class="row">
    	<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
    		<div class="form-group">
      			<label for="">Nuevo Rol </label>
      			<input type="text" name="tipo" class="form-control" required placeholder="Tipo de Rol (tipo)">
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
	  <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
	    {!! csrf_field()!!} <!-- funcion para el token -->
	    <button type="submit" class="btn btn-success  btn-block"></a>Guardar</button>
	  </div>
	  <div class="col-xs-12 col-sm-6 col-md-4">
	    <a href="{{route('home')}}" class="btn btn-warning  btn-block"
	    onclick ="return confirm('Desea cancelar la Accion?')">Cancelar</a>
	  </div>
	</div>
	<br>
</form>

@endsection
