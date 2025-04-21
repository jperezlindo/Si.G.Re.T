@extends('layouts.mainMenu')

@section('content')
  
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
    <div class="alert alert-info text-center" role="alert">
      <h1><strong>Mis Juegos</strong></h1>
    </div>
    <hr>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
    @include('fragment.msg')
  </div>
</div>
<br>
@if ($jcs->isNotEmpty())
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <label class = "text-left"><span class="label label-success">Juegos Confirmados</span></label>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="">
            <td class="active text-left"><strong>Fecha</strong></td>
            <td class="active text-left"><strong>Inicia</strong></td>
            <td class="active text-left"><strong>Finaliza</strong></td>
            <td class="active text-center"><strong>Anular</strong></td>
          </thead>
          <tbody>
          @foreach ($jcs as $jc)
            <tr>
              <td class = "success text-left">{{$jc->detalle_reserva->fecha_reservada->format('d/m/Y')}}</td>
              <td class = "success text-left">{{$jc->detalle_reserva->hr_reservada}}:00 hs.</td>
              <td class = "success text-left">{{$jc->detalle_reserva->hr_reservada + $jc->detalle_reserva->cant_hs }}:00 hs.</td>
              <td class = "success text-center" title="CANCELAR PARTICIPACION">
                <form action="{{route('jugadores.cancelarJuego')}}" method="POST">
                  {{ csrf_field() }}    
                  <button  type="button" class="btn btn-danger btn-xs" data-toggle="modal" 
                      data-target="#confirmarAnularJuego">
                  <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                  </button>
                  <input type="hidden" name="detalle_reserva_id" value="{{ $jc->detalle_reserva_id }}">
                  @include('jugadores.modals.confirmarAnularJuego')
                </form>
              </td>
            </tr>
          @endforeach
          </tbody>  
        </table>
      </div>
    </div>
  </div>
@else
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="alert alert-info text-center" role="alert">
        <h3><strong>No tienes ningun juego por el momento</strong></h3 class="text center">
      </div>
      <hr>
    </div>
  </div>
@endif
<hr>
@if ($jncs->isNotEmpty())
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <label class = "text-left"><span class="label label-warning">Invitaciones a Juegos</span></label>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="">
            <td class="active text-left"><strong>Fecha</strong></td>
            <td class="active text-left"><strong>Inicia</strong></td>
            <td class="active text-left"><strong>Finaliza</strong></td>
            <td class="active text-center" colspan="2"><strong>Acciones</strong></td>
          </thead>
          <tbody>
          @foreach ($jncs as $jnc)
            <tr>
              <td class = "success text-left">{{$jnc->detalle_reserva->fecha_reservada->format('d/m/Y')}}</td>
              <td class = "success text-left">{{$jnc->detalle_reserva->hr_reservada}}:00 hs.</td>
              <td class = "success text-left">{{$jnc->detalle_reserva->hr_reservada + $jnc->detalle_reserva->cant_hs }}:00 hs.</td>
              <td class = "success text-right" title="CONFIRMAR INVITACION">
                <form action="{{route('jugadores.confirmarJuego')}}" method="POST">
                  {{ csrf_field() }}    
                  <button  type="submit" class="btn btn-success btn-xs">
                  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                  </button>
                  <input type="hidden" name="detalle_reserva_id" value="{{ $jnc->detalle_reserva_id }}">
                </form>
              </td>
              <td class = "success text-left" title="CANCELAR INVITACION">
                <form action="{{route('jugadores.anularInvitacion')}}" method="POST">
                  {{ csrf_field() }}    
                  <button  type="button" class="btn btn-danger btn-xs" data-toggle="modal" 
                      data-target="#confirmarCancelarJuego">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                  </button>
                  <input type="hidden" name="jugador_id" value="{{ $jnc->id }}">
                  @include('jugadores.modals.confirmarCancelarJuego')
                </form>
              </td>
            </tr>
          @endforeach
          </tbody>  
        </table>
      </div>
    </div>
  </div>
@endif
<hr>
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