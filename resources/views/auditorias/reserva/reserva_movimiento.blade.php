@extends('layouts.mainMenu')

@section('content')

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="alert alert-info text-center" role="alert">
        <h4><strong>INFORMACION DE MOVIMIENTO EN LA TABLA "DETALLES_RESERVA" POR EL USUARIO</strong></h4>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label><b>Usuario</b></label><br>
                <label><b>{{ $user->user }}</b></label><br>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label><b>Apellido</b></label><br>
                <label><b>{{ $user->apellido }}</b></label><br>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
              <div class="form-group text-left">
                <label><b>Nombre</b></label><br>
                <label><b>{{ $user->name }}</b></label><br>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
              <div class="form-group text-left">
                <label><b>Fecha y Hora</b></label><br>
                <label><b>{{ $auditoria->fecha_hora }}</b></label><br>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label><b>Accion</b></label><br>
                <label><b>{{ $auditoria->accion }}</b></label><br>
              </div>
            </div>
          </div>
          <hr>

          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <h5><label><b>CAMPO</b></label></h5>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <h4><label><b>DATOS ACTUALES</b></label></h4>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <h4><label><b>DATOS HISTORICO</b></label></h4>
              </div>
            </div>
          </div>
          <hr>
          
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label>Fecha Reservada</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$new_data->fecha_reservada->format('Y-m-d')}}</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$old_data[1]}}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label>Hora Reservada</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$new_data->hr_reservada}}</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$old_data[2]}}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label>Cantidad de Horas</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$new_data->cant_hs}}</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$old_data[3]}}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label>Monto</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$new_data->monto}}</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$old_data[4]}}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label>Activo</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$new_data->activo}}</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$old_data[5]}}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label>Confirmada</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$new_data->confirmada}}</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$old_data[6]}}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label>Cancha</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$new_data->ca}}</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$old_data[7]}}</label>
              </div>
            </div>
          </div>
          <hr>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-7 col-md-offset-2">
      <a href="{{route('auditoria.reserva')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>      
    </div>
    <div class="col-xs-12 col-sm-6 col-md-1">
      <a href="{{route('auditoria.reserva.movimiento.pdf', $auditoria->id)}}" class="btn btn-danger btn-block"><b>PDF</b></a>      
    </div>
  </div>


@endsection