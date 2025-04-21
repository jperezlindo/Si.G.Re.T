@extends('layouts.mainMenu')

@section('content')

<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-12">
    <div class="form-group">
      @include('fragment.msg')
      @include('fragment.error')
    </div>
  </div>
</div> 
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">  
    <div class="form-group">
      <div class="alert alert-info text-center">
        <h2 class="text-center"><strong>Torneos a los que estas Inscripto</strong></h2>
      </div>
    </div>
  </div>
</div>

@if ($inscripciones->isNotEmpty())
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
    <h4><b>Equipo Actual: <span class="label label-success">{{ $equipo->equipo->name}}</span> </b></h4>
    <hr>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead class="">
          <td class="active text-left"><strong>Torneo</strong></td>
          <td class="active text-left"><strong>Desde</strong></td>
          <td class="active text-left"><strong>Hasta</strong></td>
          <td class="active text-left"><strong>Hora Inicio</strong></td>
          <td class="active text-center" colspan="3"><strong>Acciones</strong></td>
        </thead>
        @foreach ($inscripciones as $ins)
        <tbody>
          <tr>
            <td class = "success text-left">{{$ins->categoria_torneo->torneo->name}}</td>
            <td class = "success text-left">{{$ins->categoria_torneo->torneo->f_desde->format('d/m/Y')}}</td>
            <td class = "success text-left">{{$ins->categoria_torneo->torneo->f_hasta->format('d/m/Y')}}</td>
            <td class = "success text-left">{{$ins->categoria_torneo->torneo->hora}} hs.</td>

            <td class = "success text-right" title="VER FIXTURE">
              <a href="{{route('fixture.show', $ins->categoria_torneo_id)}}" class="btn btn-primary btn-xs">
                <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
              </a>
            </td>
            <td class = "success text-left" title="VER TORNEO">
              <a href="{{route('torneo.show', $ins->categoria_torneo->torneo_id)}}" class="btn btn-info btn-xs">
                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
              </a>
            </td>
            <td class = "success text-right" title="ANULAR INSCRIPCION">
              <form action="{{route('inscripciones.destroy', $ins->id)}}" method="POST">  
                  <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" 
                  data-target="#confirmacionAnular_{{$ins->id}}">
                  <span class=" glyphicon glyphicon-remove" aria-hidden="true"></span>
                  </button>
                  @include('inscripciones.modals.confirmacionAnulacion')
              </form>
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
        <h3 class="text-center"><strong>POR EL MOMENTO NO TIENES INSCRIPCIONES REALIZADAS.</strong></h3>
      </div>
    </div>
  </div>
@endif
  <br>
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
      <a href="{{route('home')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>
    </div>
  </div>
@endsection