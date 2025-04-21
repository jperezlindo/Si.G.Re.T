@extends('layouts.mainMenu')

@section('content')

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
    <strong>@include('fragment.msg')</strong>
    <strong>@include('flash::message')</strong>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
    <div class="alert alert-info text-center" role="alert">
      <h1><strong>Listado de Reservas</strong></h1>
    </div>
  </div>
</div>  
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <form class="" method="GET" action="{{route('reserva.consultarReservas')}}" role="search" >
      <div class="input-group">
        <input class="form-control" type="date" name="fecha" aria-describedby= "search" autofocus>
        <span class="input-group-btn"><button type="submit" class="btn btn-info" ><span class="glyphicon glyphicon-search"></span></button></span> 
      </div>
      <input type="hidden" name="flag" value="1">
      </form>
  </div>
</div>
<br>

@if ($reservas->isNotEmpty())
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
    <div class="table-responsive">
      <table class="table table-hover table-striped">
        <thead class="">
          <td class="active text-center"><strong>Nro.</strong></td>
          <td class="active text-leftr"><strong>Usuario</strong></td>
          <td class="active text-cleft"><strong>Fecha</strong></td>
          <td class="active text-cleft"><strong>Inicia</strong></td>
          <td class="active text-cleft"><strong>Finaliza</strong></td>
          <td class="active text-cleft"><strong>Cancha</strong></td>
          <td class="active text-center"><strong>Precio</strong></td>
          <td class="active text-center" colspan="4"><strong>Acciones</strong></td>
        </thead>
        <tbody>
          @php $i=1; @endphp
          @foreach ($reservas as $dr)
          <tr>
            <td class = "success text-center">{{$i++}}</td>
            <td class = "success text-left">{{$dr->au}}</td>
            <td class = "success text-left">{{$dr->fecha_reservada->format('d/m/Y')}}</td>
            <td class = "success text-left">{{(int)$dr->hr_reservada}}:00 hs.</td>
            <td class = "success text-left">{{(int)$dr->hr_reservada + $dr->cant_hs}}:00 hs.</td>
            <td class = "success text-left"><strong>{{$dr->ca}}</strong></td>
            <td class = "success text-right"><strong>$ {{$dr->monto}}</strong></td>
            @if ($dr->confirmada)
              @if ($dr->activo)
                <td class = "success text-right" title="FINALIZAR RESERVA">  
                  <form action="{{ route('detalle_reserva.finalizarDetalle')}}" method="POST"> 
                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" 
                    data-target="#confirmacionFinalizarDetalleOK_{{$dr->id}}">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span></button>
                    @include('detalle_reserva.modals.confirmacionFinalizarDetalleOK')   
                  </form>
                </td>
              @else
                <td class = "success text-left" ><span class="label label-success">FINALIZO</span></td>
              @endif
            @else
              <td class = "success text-left" ><span class="label label-danger">NO CONFIRMADA</span></td>
            @endif   
            <td class = "success text-center" title="VER DETALLE">
              <a href="{{ route('reserva.show', $dr->reserva_id ) }}" class="btn btn-info btn-xs">
                  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
              </a>
            </td>
            <td class = "success text-center" title="CANCELAR RESERVA">   
              <form action="{{route('detalle_reserva.destroy', $dr->id)}}" method="POST"> 
                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" 
                data-target="#modalConfirmacionAnularDetalle_{{$dr->id}}">
                <span class="glyphicon glyphicon-remove" aria-hidden="true" ></span></button>
                @include('reserva.viewsModals.confirmacionAnularDetalle')
                <input type="hidden" name="flag" value="1">
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
    <div class="alert alert-warning text-left" >
      <h4><strong>PARA LISTAR LAS RESERVAS, SELECCIONE UNA FECHA O DEJELA EN BLANCO(LISTA TODAS) Y PRESIONE EN LA LUPA .</strong></h4>
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
