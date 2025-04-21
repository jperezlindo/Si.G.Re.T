@extends('layouts.mainMenu')

@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="alert alert-info text-center" role="alert">
        <h2 class="text-center"><strong>Torneos Jugados en {{Auth::user()->user_empresa->empresa->name}}</strong></h2>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-12">
      <div class="form-group">
        @include('fragment.msg')
        @include('fragment.error')
      </div>
    </div>
  </div>
  @if ($torneos->isNotEmpty())
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="">
            <td class="active text-left"><strong>Torneo</strong></td>
            <td class="active text-left"><strong>Desde</strong></td>
            <td class="active text-left"><strong>Hasta</strong></td>
            <td class="active text-left"><strong>Hora Inicio</strong></td>
            <td class="active text-left"><strong>Inicia Inscripcion</strong></td>
            <td class="active text-left"><strong>Finaliza Inscripcion</strong></td>
            <td class="active text-center"><strong>Ver Torneo</strong></td>
          </thead>
          @foreach ($torneos as $torneo)
          <tbody>
            <tr>
              <td class = "success text-left"><b>{{$torneo->name}}</b></td>
              <td class = "success text-left">{{$torneo->f_desde->format('d/m/Y')}}</td>
              <td class = "success text-left">{{$torneo->f_hasta->format('d/m/Y')}}</td>
              <td class = "success text-left">{{$torneo->hora}} hs.</td>
              <td class = "success text-left">{{$torneo->ini_ins->format('d/m/Y')}}</td>
              <td class = "success text-left">{{$torneo->fin_ins->format('d/m/Y')}}</td>
              
              <td class = "success text-center" title="VER TORNEO">
                <a href="{{route('torneo.show_end', $torneo->id)}}" class="btn btn-info btn-xs">
                  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                </a>
              </td>
            </tr>
          </tbody>  
          @endforeach
        </table>
      </div>
    </div>
  </div>

  @else
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
        <div class="alert alert-info" role="alert">
          <h3 class="text-center"><strong>POR EL MOMENTO NO HAY TORNEOS FINALIZADOS.</strong></h3>
        </div>
      </div>
    </div>
  @endif
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
      <hr>
      <a href="{{route('home')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>
    </div>
  </div>
@endsection