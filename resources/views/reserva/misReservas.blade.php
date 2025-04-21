@extends('layouts.mainMenu')

@section('content')
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-md-offset-">
    @include('fragment.msg')
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
    <div class="alert alert-info text-center" role="alert">
      <h1><strong>Listado de Mis Reservas</strong></h1>
    </div>
  </div>
</div>  

@if($reservas->isNotEmpty())
  @include('reserva.confirmadas') 
@else
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="alert alert-info" role="alert">
        <h3 class="text-center"><strong>No tienes reservas por el momento.</strong></h3>
      </div>
    </div>
  </div>
@endif
<br>
@if ($rnc->isNotEmpty())
  @include('reserva.noConfirmadas')
@endif
<br>
@if($cnc->isNotEmpty())
  @include('reserva.detallesNoConfirmados')
@endif

<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-2">
    <div class="form-group">
      <form action="{{route('home')}}" method="GET">
        <button type="submit" class="btn btn-warning btn-block"><b>SALIR</b></button>
      </form>
    </div>
  </div>
  <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-4">
    <div class="form-group">
      <a href="{{route('reserva.create')}}" class="btn btn-primary  btn-block"><b>NUEVA RESERVA</b></a>
    </div>
  </div>
</div>
@endsection




