@extends('layouts.mainMenu')

@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      @include('fragment.msg')
    </div>
  </div>
    
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <h2 class="text-center"><strong>Detalles de su Reserva</strong></h2>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-10 col-md-10 col-md-offset-2">
      <h3><strong>Reserva numero:{{ $reserva->id }}</strong></h3>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="">
            <td class="active text-left"><strong>fecha</strong></td>
            <td class="active text-left"><strong>Inicia</strong></td>
            <td class="active text-left"><strong>finaliza</strong></td>
            <td class="active text-left"><strong>Cancha</strong></td>
            <td class="active text-left"><strong>Hora/s</strong></td>
            <td class="active text-left"><strong>Servicios</strong></td>
            <td class="active text-center"><strong>Precio</strong></td>
            <td class="active text-center"><strong>TOTAL</strong></td>
          </thead>
          @foreach ($detalles as $dr)      
            @php$a=0; @endphp
            <tbody>
            @foreach ($asociados as $as)
              <tr>
                @if ($dr->id == $as->detalle_reserva_id)
                  @if ($a == 0)@php $a=1; $d = $dr; $b=1;@endphp
                  <td class = "success text-left">{{$as->detalle_reserva->fecha_reservada->format('d/m/Y')}}</td>
                  <td class = "success text-left">{{(int)$as->detalle_reserva->hr_reservada}}:00 hs.</td>
                  <td class = "success text-left">{{(int)$as->detalle_reserva->hr_reservada + $as->detalle_reserva->cant_hs}}:00 hs.</td> 
                  <td class = "success text-left">{{$as->cancha_servicio->cancha->name}}</td>
                  <td class = "success text-right">{{(INT)$as->detalle_reserva->cant_hs}} hs.</td>
                  <td class = "success text-left">{{$as->cancha_servicio->servicio->name}}</td>
                  <td class = "success text-right">${{$as->cancha_servicio->precio}}.00</td>
                  <td class = "success text-right">${{$as->cancha_servicio->precio * $as->detalle_reserva->cant_hs}}.00</td>
                  @else
                    @php $a=1; $d = $dr;@endphp
                    <td class = "success text-center"></td>
                    <td class = "success text-center"></td>
                    <td class = "success text-center"></td>
                    <td class = "success text-center"></td><td class = "success text-center"></td>
                    <td class = "success text-left">{{$as->cancha_servicio->servicio->name}}</td>
                    @if ($as->cancha_servicio->xhr)
                    <td class = "success text-right">${{$as->cancha_servicio->precio}}.00</td>
                    <td class = "success text-right">${{$as->cancha_servicio->precio*$as->detalle_reserva->cant_hs}}.00</td>
                    @else
                    <td class = "success text-right">${{$as->cancha_servicio->precio}}</td>
                    <td class = "success text-right">${{$as->cancha_servicio->precio}}</td>
                    @endif
                  @endif
                @else
                  @if ($b==1)
                    @php $b=0;@endphp
                    <td class = "warning text-center"></td>
                    <td class = "warning text-center"></td>
                    <td class = "warning text-center"></td><td class = "warning text-center"></td>
                    <td class = "warning text-center"></td><td class = "warning text-center"></td>
                    <td class = "warning text-right"><strong>SUB TOTAL</strong></td>
                    <td class = "warning text-right"><strong>${{$d->monto}}</strong></td>
                  @endif
                @endif
              </tr> 
            @endforeach
          @endforeach
          @if ($b==1)
            @php $b=0;@endphp
            <td class = "warning text-center"></td>
            <td class = "warning text-center"></td>
            <td class = "warning text-center"></td><td class = "warning text-center"></td>
            <td class = "warning text-center"></td><td class = "warning text-center"></td>
            <td class = "warning text-right"><strong>SUB TOTAL</strong></td>
            <td class = "warning text-right"><strong>${{$d->monto}}</strong></td>
          @endif
            </tbody>
            <tr>
              <td class = "info text-center"></td>
              <td class = "info text-center"></td>
              <td class = "info text-center"></td><td class = "info text-center"></td>
              <td class = "info text-center"></td><td class = "info text-center"></td>
              <td class = "info text-right"><strong>TOTAL</strong></td>
              <td class = "info text-right"><strong>${{$d->reserva->total}}</strong></td>
            </tr>                  
        </table>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-2">
      @if (Auth::user()->rol() < 4)
        <a href="{{route('reserva.consultarReservas')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a><br>
      @else
        <a href="{{route('home')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a><br>
      @endif
    </div>
  
    <div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-">
      <a href="{{route('reserva.misReservas')}}" class="btn btn-primary  btn-block"><b>MIS RESERVAS</b></a><br>
    </div>

      <div class="col-xs-12 col-sm-2 col-md-1 col-md-offset-1">
        <form action="{{route ('reserva.pdf_reserva')}}" method="GET">
          <input type="hidden" name="empresa_id" value="{{Auth::user()->user_empresa->empresa_id}}">
          <input type="hidden" name="reserva_id" value="{{$reserva->id}}" required>
          {!! csrf_field()!!} <!-- funcion para el token -->
          <button type="submit" class="btn btn-danger btn-block"><b>PDF</b></button>
        </form>
      </div>
  </div>
  <hr>

  @if ($confirmados->isNotEmpty())
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <h3 class = "text-center"><span class="label label-info">Lista de jugadores que confirmaron su participacion</span></h3>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="">
            <td class="active text-left"><strong>User</strong></td>
            <td class="active text-left"><strong>Apellido</strong></td>
            <td class="active text-left"><strong>Nombre</strong></td>
            <td class="active text-left"><strong>email</strong></td>
            <td class="active text-left"><strong>Fecha</strong></td>
            <td class="active text-left"><strong>Hora</strong></td>
          </thead>
          <tbody>
            @foreach ($confirmados as $co)
              <tr>
                <td class="success text-left">{{ $co['user'] }}</td>
                <td class="success text-left">{{ $co['ape'] }}</td>
                <td class="success text-left">{{ $co['name'] }}</td>
                <td class="success text-left">{{ $co['email'] }}</td>
                <td class="success text-left">{{ $co['fec']->format('d-m-Y') }}</td>
                <td class="success text-left">{{ $co['hr'] }}:00 hs.</td>
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
        <h3>TODAVIA NO DISPONE DE CONFIRMACIONES PARA EL JUEGO</h3>
      </div>
    </div>
  </div>
  @endif
@endsection
