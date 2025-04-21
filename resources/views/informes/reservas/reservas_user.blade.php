@extends('layouts.mainMenu')

@section('content')

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
    <div class="alert alert-info text-center" role="alert">
      <h3><strong>CANTIDAD DE RESERVAS POR USUARIOS</strong></h3>
      SELECCIONE LAS FECHAS DESDE Y HASTA, Y PRESIONE EN EL BOTON CONSULTAR. EL SISTEMA LE ARROJARA UN LISTADO MOSTRANDOLE LA CANTIDAD DE RESERVAS QUE HICIERON SUS CLIENTES ORDENADO POR TOP.
    </div>
  </div>
</div>

<form class="form-group" method="GET" action="{{ route('informe.get_cruf')}}">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-2">
     <div class="form-group">
       <label for="">Fecha desde:* </label>
       <input type="date" class="form-control" name="desde" value="{{ old('desde') }}" required>
     </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4">
     <div class="form-group">
       <label for="">Fecha hasta:* </label>
       <input type="date" class="form-control" name="hasta" value="{{ old('hasta') }}" required>
     </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="form-group">
        <input type="hidden" name="empresa_id" value="{{Auth::user()->user_empresa->empresa_id}}">
        {!! csrf_field()!!} <!-- funcion para el token -->
        <button type="submit" class="form-control btn btn-primary btn-block"><b>CONSULTAR</b></button>
      </div>
    </div>
  </div>
</form>

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
    <hr>
    <div class="form-group">
      <a href="{{route('home')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>
    </div>
  </div>
</div>
@endsection