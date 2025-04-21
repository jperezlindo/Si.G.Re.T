@extends('layouts.mainMenu')

@section('content')

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="progress">
          <div class="progress-bar progress-bar-striped progress-bar-info active" role="progressbar" style="width: 67%">
            <strong>Paso: 2/3</strong>
        </div>
      </div>
    </div>
  </div>  

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="alert alert-info text-center" role="alert">
        <h3><strong>2- Agregar/Quitar Reservas</strong>, aqui puede agregar o quitar las reservas realizadas para el torneo.</h3>
      </div>
      <hr>
    </div>
  </div>
  <!-----------------------Agrega las categorias a l torneo---------------------------------------->
 
  <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
        <div class="table-responsive">
          <div class="form-group ">
            <h3 class = "text-left"><span class="label label-info">Lista de reservas confirmadas disponibles para asociarlas al torneo</span></h3>
            <table class="table table-hover table-striped ">
              <thead class="">
                <td class="active text-left"><strong>Nro.</strong></td>
                  <td class="active text-left"><strong>Fecha</strong></td>
                  <td class="active text-left"><strong>Inicia</strong></td>
                  <td class="active text-left"><strong>Finaliza</strong></td>
                  <td class="active text-left"><strong>Cancha</strong></td>
                  <td class="active text-center"><strong>Agregar</strong></td>
              </thead>
              <tbody>

                  @foreach ($reservas as $i => $dr)
                    @if(($dr->activo) and ($dr->confirmada))
                    <tr>
                      <td class = "success text-center">{{$i+1}}</td>
                      <td class = "success text-left">{{$dr->fecha_reservada->format('d/m/Y')}}</td>
                      <td class = "success text-left">{{(int)$dr->hr_reservada}}:00 hs.</td>
                      <td class = "success text-left">{{(int)$dr->hr_reservada + $dr->cant_hs}}:00 hs.</td>
                      <td class = "success text-left">{{$dr->ca}}</td>
                      <td class = "success text-center">
                        <form action="{{route('reserva_torneo.store')}}" method="POST">
                          {{ csrf_field() }}    
                          <button  class="btn btn-success btn-xs">
                          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                          </button>
                          <input type="hidden" name="torneo_id" value="{{$torneo->id}}">
                          <input type="hidden" name="detalle_reserva_id" value="{{$dr->id}}">
                        </form>
                      </td>
                    </tr>
                    @endif
                  @endforeach
                </tbody> 
            </table>
        </div>
        </div>
      </div>
  </div>
  <hr>
  <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
        <div class="table-responsive">
          <div class="form-group ">
            <h3 class = "text-left"><span class="label label-info">Lista de reservas agregadas al torneo</span></h3>
            <table class="table table-hover table-striped ">
              <thead class="">
                <td class="active text-left"><strong>Nro.</strong></td>
                  <td class="active text-left"><strong>Fecha</strong></td>
                  <td class="active text-left"><strong>Inicia</strong></td>
                  <td class="active text-left"><strong>Finaliza</strong></td>
                  <td class="active text-left"><strong>Cancha</strong></td>
                  <td class="active text-center"><strong>Agregar</strong></td>
              </thead>
              <tbody>

                  @foreach ($agregadas as $i => $dr)
                    @if(($dr->activo) and ($dr->confirmada))
                    <tr>
                      <td class = "success text-center">{{$i+1}}</td>
                      <td class = "success text-left">{{$dr->fecha_reservada->format('d/m/Y')}}</td>
                      <td class = "success text-left">{{(int)$dr->hr_reservada}}:00 hs.</td>
                      <td class = "success text-left">{{(int)$dr->hr_reservada + $dr->cant_hs}}:00 hs.</td>
                      <td class = "success text-left">{{$dr->ca}}</td>
                      <td class = "success text-center">
                        <form action="{{route('reserva_torneo.destroy')}}" method="POST">
                          {{ csrf_field() }}    
                          <button  class="btn btn-danger btn-xs">
                          <span class=" glyphicon glyphicon-remove" aria-hidden="true"></span>
                          </button>
                          <input type="hidden" name="detalle_reserva_id" value="{{$dr->id}}">
                        </form>
                      </td>
                    </tr>
                    @endif
                  @endforeach
                </tbody> 
            </table>
        </div>
        </div>
      </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-2 col-md-offset-2">
      <form action="{{route('torneo.destroy', $torneo->id)}}" method="POST">
        <div class="form-group">
          <a data-toggle="modal" data-target="#torneoDestroy_{{ $torneo->id }}" class="btn btn-danger btn-block"><b>CANCELAR</b></a><br>
        </div>
        @include('torneo.modals.torneoDestroy')
      </form>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-4">
      <div class="form-group">
        <a href="{{ route('torneo.create_cat', $torneo->id) }}" class="btn btn-primary btn-block"><b>SIGUIENTE</b></a>
      </div>
    </div>
  </div>

@endsection