@extends('layouts.mainMenu')

@section('content')

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
	 	<h2 class="text-center"><strong>Modificar el Servicio</strong></h2>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
	 	@include('fragment.msg')
	</div>
</div>

<!-- Agrega nuevaos Servicios -->
  <form class="form-group" method="POST" action="{{ route('servicio.update', $se->id) }}" enctype="multipart/form-data">
  <input  name="_method" type="hidden" value="PUT">
	<hr>
  	<div class="row">
    	<div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
      		<label for="">Nombre del Servico que se va a brindar:*</label>
      		<input type="text" maxlength="50" name="name" class="form-control" value="{{$se->name}}" required>
      		<br>
      		<label for="">Descripcion:* </label>
            <textarea class="form-control" rows="5" maxlength="250" name="descripcion" required>{{ $se->descripcion }}</textarea>
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
	    <a href="{{route('servicio.index')}}" class="btn btn-warning  btn-block"
	    onclick ="return confirm('Desea cancelar la Accion?')"><b>SALIR</b></a>
	  </div>
	  <div class="col-xs-12 col-sm-6 col-md-4">
	    {!! csrf_field()!!} <!-- funcion para el token -->
	    <button type="submit" class="btn btn-success  btn-block"><b>GUARDAR</b></button>
	  </div>
	</div>
	<br>
</form>
@endsection