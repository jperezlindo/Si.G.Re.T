@extends('layouts.mainMenu')

@section('content')

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">  
        <div class="form-group">
        <div class="alert alert-info text-center">
          <h2 class="text-center">FIXTURE del Torneo: <strong>{{ $torneo->name }}</strong></h2>
          <h4 class="text-center">categoria: <strong>{{ $categoria }}</strong></h4>
        </div>
          </div>
      </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="">
            <td class="active text-left"><strong>INSTANCIA</strong></td>
            <td class="active text-left"><strong>PARTIDO</strong></td>
            <td class="active text-left"><strong>EQUIPO</strong></td>
            <td class="active text-center"><strong>SET_01</strong></td>
            <td class="active text-center"><strong>SET_02</strong></td>
            <td class="active text-center"><strong>SET_03</strong></td>
            <td class="active text-center"><strong>RESULTADADO</strong></td>
          </thead>
          <tbody>
          @php $name = 'false'; $p = 1; @endphp
          @foreach ($partidos as $partido)
            @if ($p)
              @php $par =  $partido; $p = 0; @endphp
            @endif
            <tr>
              @if ($name != $partido->instancia->name)
                  @php $aa = 1;  @endphp
              @endif
              @if ($aa)@php $aa = 0; $name = $partido->instancia->name  @endphp
                <td class = "success text-left"><b>{{$partido->instancia->name}}</b></td>
              @else
                <td class = "success text-left"></td>
              @endif
              <td class = "success text-left">
                <a href="{{ route('partido.show', $partido->id)}}" class="btn btn-info btn-block">
                  <b>Ver {{$partido->name}}</b>
                </a>
              </td>
                            
              @php $a = 1;  @endphp
              @foreach ($partido->detalle_partido as $dp)
                
                @if ($a) @php $a = 0;  @endphp
                  <td class = "success text-left"><b>{{$dp->equipo->name}}</b></td>
                  <td class = "success text-center">{{$dp->set_01}}</td>
                  <td class = "success text-center">{{$dp->set_02}}</td>
                  <td class = "success text-center">{{$dp->set_03}}</td>
                  
                  @if ($dp->isWinn)
                    <td class = "success text-center"><span class="label label-success">Ganador</span></td>
                  @else
                    <td class = "success text-center"></td>
                  @endif
                @else
                <tr>
                  <td class = "success text-left"></td>
                  <td class = "success text-center"></td>
                  <td class = "success text-left"><b>{{$dp->equipo->name}}</b></td>
                  <td class = "success text-center">{{$dp->set_01}}</td>
                  <td class = "success text-center">{{$dp->set_02}}</td>
                  <td class = "success text-center">{{$dp->set_03}}</td>
	              @if ($dp->isWinn)
	                <td class = "success text-center"><span class="label label-success">Ganador</span></td>
	              @else
	                <td class = "success text-center"></td>
	              @endif
                </tr>
                @endif
              @endforeach
              <tr>
                  <td></td>
              </tr>         
            </tr> 
          @endforeach
          </tbody> 
        </table>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
      <a href="{{route('torneo.show_end', $torneo->id)}}" class="btn btn-warning btn-block"><b>SALIR</b></a>
    </div>
  </div>

@endsection