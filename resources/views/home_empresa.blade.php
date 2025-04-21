@extends('layouts.mainMenu')

@section('content')
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12"> 
      <div class="form-group">
          @include('fragment.msg')
          @include('flash::message')
        </div>
    </div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">	
	  <div class="form-group">
			<div class="alert alert-info text-center">
				<h1><b>HOLA: {{Auth::user()->name}}</b>, aqui tienes algunos datos</h1>
			</div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">  
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>Reservas para hoy: {{ $reservas->count()}}</h3>

        <p>En la tabla de abajo podras visualizar las reservas actuales</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="{{ route('reserva.consultarReservas') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>

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
          <td class="active text-center" colspan="2"><strong>Acciones</strong></td>
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
                <td class = "success text-center" title="FINALIZAR FECHA">  
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
<hr>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-2">  
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{ $cant_us }}</h3>

        <p>Usuarios Registrados actualmente</p>
      </div>
      <div class="icon">
        <i class="ion ion-person"></i>
      </div>
      <a href="{{route('users.index')}}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-4">  
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{ $cant_to }}</h3>

        <p>Torneos vigentes</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="{{ route('torneo.index') }}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>
@endsection
