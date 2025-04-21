@extends('layouts.mainMenu')

@section('content')

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
    <div class="alert alert-info text-center" role="alert">
      <h3><strong>CANTIDAD DE RESERVAS POR CANCHAS</strong></h3>
      SELECCIONE LAS FECHAS DESDE Y HASTA, Y PRESIONE EN EL BOTON CONSULTAR. EL SISTEMA LE ARROJARA UN GRAFICO MOSTRANDOLE EL PORSENTAJE Y CANTIDAD DE RESERVAS QUE TUVO CADA CANCHA.
    </div>
  </div>
</div>

<form class="form-group" method="GET" action="{{ route('informe.get_crcf')}}">
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
        <input type="hidden" name="flag" value="1">
        {!! csrf_field()!!} <!-- funcion para el token -->
        <button type="submit" class="form-control btn btn-primary btn-block"><b>CONSULTAR</b></button>
      </div>
    </div>
  </div>
</form>

@if ($canchas->isNotEmpty())
  @include('informes.reservas.reservas_canchas_grafico')
@endif

<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
    <a href="{{route('home')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>
  </div>
  @if (false)
  <div class="col-xs-12 col-sm-2 col-md-1">
    <form action="{{route('informe.get_crcf')}}" method="GET">
      <input type="hidden" name="empresa_id" value="{{Auth::user()->user_empresa->empresa_id}}">
      <input type="hidden" name="flag" value="0">
      <input type="hidden" name="desde" value="{{$desde}}">
      <input type="hidden" name="hasta" value="{{$hasta}}">
      {!! csrf_field()!!} <!-- funcion para el token -->
      <button type="submit"  class="btn btn-danger btn-block"><b>PDF</b></button>
    </form>
  </div>
  @endif
</div>
@endsection