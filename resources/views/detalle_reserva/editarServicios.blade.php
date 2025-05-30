@extends('layouts.mainMenu')

@section('content')
  
<div class="row">
  <div class="col-xs-10 col-sm-12 col-md-8 col-md-offset-2">
    <div class="form-group">
      <div class="alert alert-info text-center" role="alert">
        <h5><strong>Editar Servicios</strong>, 
        aqui podra agregar o quitar los servicios adicionales, disponibles para la cancha.</h5>
      </div>
    </div>
  </div>
</div>
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-2">
      <label>Fecha del partido:</label>
      <div class="alert alert-info text-center" role="alert">
        <b>{{$dr->fecha_reservada->format('d/m/Y')}}</b>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-">
      <label>Cancha a ocupar:</label> 
      <div class="alert alert-info text-center" role="alert">
        <b>{{$cancha->name}}</b>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-">  
      <label>Inicia a las:</label>
      <div class="alert alert-info text-center" role="alert">
        <b>{{($dr->hr_reservada)}}:00 hs</b>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-">
      <label>Finaliza a las:</label>
      <div class="alert alert-info text-center" role="alert">
        <b>{{$dr->hr_reservada + $dr->cant_hs}}:00 hs</b>
      </div>
    </div>  
  </div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <label>Servicios disponibles</label>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="">
            <td class="active text-left"><strong>Servicio</strong></td>
            <td class="active text-left"><strong>Se cobra</strong></td>
            <td class="active text-left"><strong>Precio</strong></td>
            <td class="active text-center"><strong>Agregar</strong></td>
          </thead>
          <tbody>
          @foreach ($disponibles as $disponible)
            <tr>
              <td class = "success text-left">{{$disponible->servicio->name}}</td>
              @if ($disponible->xhr)
                <td class = "success text-left"><span class="label label-success">por hora</span></td>
              @else
                <td class = "success text-left"><span class="label label-success">por reserva</span></td>
              @endif
              <td class = "success text-right">$ {{$disponible->precio}}</td>
                <td class = "success text-center">
                  <button  class="btn btn-success btn-xs" data-toggle="modal" data-target="#ConfAgreSerEdit_{{$disponible->id}}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                  </button>
                  @include('detalle_reserva.modals.confirmarAgregarServicioEditar')
                </td>
            </tr>
          @endforeach
          </tbody>  
        </table>
      </div>
    </div>
  </div>

<h3 class="text-center"><strong>Servicios contratados Actualmente</strong></h3>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
    <div class="table-responsive">
      <table class="table table-hover">
        <thead class="">
          <td class="active text-center"><strong>Cancha</strong></td>
          <td class="active text-center"><strong>Servicio</strong></td>
          <td class="active text-center"><strong>Valor</strong></td>
          <td class="active text-center"><strong>Monto</strong></td>
          <td class="active text-center"><strong>Quitar</strong></td>
        </thead>
        @php $a = 1; @endphp
        <tbody>

        @foreach ($asociados as $as)
          <tr>
            @if ($a)
              @php $a = 0; @endphp
              <td class = "success text-left">{{$as->cancha_servicio->cancha->name}}</td>
            @else
              <td class = "success"></td>
            @endif
            <td class = "success text-left">{{$as->cancha_servicio->servicio->name}}</td>
            <td class = "success text-right">$ {{$as->cancha_servicio->precio}}</td>
            @if($as->cancha_servicio->xhr)
            <td class = "success text-right">$ {{$as->cancha_servicio->precio * $dr->cant_hs }}.00</td>
            @else
            <td class = "success text-right">$ {{$as->cancha_servicio->precio }}</td>
            @endif
            @if ($as->cancha_servicio->requerido)
            <td class = "success"></td>
            @else
            <td class = "success text-center">
              <button  class="btn btn-danger btn-xs" data-toggle="modal" data-target="#confirmarQuitarServicioEditar_{{$as->id}}">
                <span class=" glyphicon glyphicon-remove" aria-hidden="true" ></span>
              </button>
              @include('detalle_reserva.modals.confirmarQuitarServicioEditar')
            </td>
            @endif
          </tr>
        @endforeach
          <tr>
            <td class = "info text-right"></td>
            <td class = "info text-right"></td>
            <td class = "info text-right"><strong>Sub TOTAL</strong></td>
            <td class = "info text-right"><strong>$ {{$as->detalle_reserva->monto}} </strong></td>
            <td class = "info"></td>
          </tr>
          <tr>
            <td class = "warning text-right"></td>
            <td class = "warning text-right"></td>
            <td class = "warning text-right"><strong>TOTAL</strong></td>
            <td class = "warning text-right"><strong>$ {{$as->detalle_reserva->reserva->total}} </strong></td>
            <td class = "warning"></td>        
          </tr>
        </tbody>  
      </table>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
    <div class="form-group">
      <form action="{{route('detalle_reserva.edit')}}" method="GET">
        <button type="submit" class="btn btn-primary btn-block"><b>VOLVER</b></button>
        <input type="hidden" name="detalle_reserva_id" value="{{$dr->id}}">
      </form>
    </div>
  </div>
  <div class="col-xs-12 col-sm-6 col-md-4 ">
    <div class="form-group">
      <a href="{{ route('reserva.misReservas') }}" class="btn btn-warning btn-block"><b>SALIR</b></a>
    </div>
  </div>
</div> 
@endsection