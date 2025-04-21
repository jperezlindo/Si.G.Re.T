@extends('layouts.mainMenu')

@section('content')

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">  
    <div class="form-group">
      <div class="alert alert-info text-center">
        <h2 class="text-center"><strong>Equipos Inscriptos</strong></h2>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
    <div class="table-responsive">
      <table class="table table-hover">
        <thead class="">
          <td class="active text-left"><strong>Equipo</strong></td>
          <td class="active text-left"><strong>Jugador</strong></td>
          <td class="active text-center"><strong>Puntos</strong></td>
          <td class="active text-center"><strong>Torneos Jugados</strong></td>
        </thead>
        <tbody>
        @foreach ($equipos as $jugador)
          <tr>
            <td class = "success text-left"><b>{{$jugador[0]}}</b></td>
            <td class = "success text-left"><b>{{$jugador[1]}}</b></td>
            <td class = "success text-center"><b>{{$jugador[2]}}</b></td>
            <td class = "success text-center"><b>{{$jugador[3]}}</b></td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

  <br>
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
      <a href="{{route('torneo.show', $id_torneo)}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>
    </div>
  </div>
@endsection