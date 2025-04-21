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
				<h1>HOLA!!! <b>{{Auth::user()->name}}</b></h1> <h4>BIENVENIDO A "{{Auth::user()->user_empresa->empresa->name}}"</h4> 
			</div>
      	</div>
    </div>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-2">  
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>Tienes: {{ $cant_res }}</h3>

        <p><b>Reservas vigentes</b></p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="{{route('reserva.misReservas')}}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-4">  
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>Tienes: {{$cant_ins}}</h3>

        <p><b>Torneo por jugar</b></p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="{{route('inscripciones.create')}}" class="small-box-footer">Mas información <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>
@if ($reservas->isEmpty())
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">	
	    <div class="form-group">
			<div class="alert alert-info text-center">
				<h4>NO CUENTAS CON RESERVAS PARA EL DIA DE HOY.</h4>
			</div>
      	</div>
    </div>
</div>
@else
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
  	  <h4 class="text text-center"><b>LA SIGUIENTE TABLA LISTA TUS RESERVAS DEL DIA</b></h4>
	  <div class="table-responsive">
	    <table class="table table-hover table-striped">
	      <thead class="">
	        <td class="active text-left"><strong>Fecha</strong></td>
	        <td class="active text-left"><strong>Inicia</strong></td>
	        <td class="active text-left"><strong>Finaliza</strong></td>
	        <td class="active text-left"><strong>Cancha</strong></td>
	        <td class="active text-center"><strong>Precio</strong></td>
          <td class="active text-center" colspan="2"><strong>Acciones</strong></td>
	      </thead>
	      <tbody>
	      	@foreach ($reservas as $dr)
	        <tr>
	          <td class = "success text-left">{{$dr->fecha_reservada->format('d/m/Y')}}</td>
	          <td class = "success text-left">{{(int)$dr->hr_reservada}}:00 hs.</td>
	          <td class = "success text-left">{{(int)$dr->hr_reservada + $dr->cant_hs}}:00 hs.</td>
	          <td class = "success text-left">{{$dr->ca}}</td>
            <td class = "success text-right"><b>${{$dr->monto}}</b></td>
            @if ($dr->confirmada)
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
              </form>
            </td>
            @else
              <td class = "success text-right" title="IR A CONFIRMAR">
                <a href="{{ route('reserva.misReservas') }}" class="btn btn-info btn-xs">
                  <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
                </a>
              </td>
              <td class = "success text-left"><span class="label label-danger">No Confirmada</span></td>
            @endif  
	        </tr>
	        @endforeach
	      </tbody>  
	    </table>
	  </div>
  </div>
</div>
@endif


	
@endsection
