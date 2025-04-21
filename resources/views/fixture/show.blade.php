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
            <td class="active text-left"><strong>SET_01</strong></td>
            <td class="active text-left"><strong>SET_02</strong></td>
            <td class="active text-left"><strong>SET_03</strong></td>
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
                @if (Auth::user()->rol() < 4)
                  <a href="{{route('partido.create', $partido->id)}}" class="btn btn-primary btn-bloxk">
                    <b>{{$partido->name}}</b>
                  </a>
                @else
                  <span class="label label-primary"><b>{{$partido->name}}</b></span>
                @endif
              </td>
              
              @php $a = 1;  @endphp
              @foreach ($partido->detalle_partido as $dp)
                
                @if ($a) @php $a = 0;  @endphp
                  <td class = "success text-left"><b>{{$dp->equipo->name}}</b></td>
                  <td class = "success text-right">{{$dp->set_01}}</td>
                  <td class = "success text-right">{{$dp->set_02}}</td>
                  <td class = "success text-right">{{$dp->set_03}}</td>
                  @if ($partido->finalizado)
                      @if ($dp->isWinn)
                        <td class = "success text-center"><span class="label label-success">Ganador</span></td>
                      @else
                        <td class = "success text-center"></td>
                      @endif
                  @else
                    <td class = "success text-center"><span class="label label-info">Por Jugar</span></td>
                  @endif
                @else
                <tr>
                  <td class = "success text-left"></td>
                  <td class = "success text-left"></td>
                  <td class = "success text-left"><b>{{$dp->equipo->name}}</b></td>
                  <td class = "success text-right">{{$dp->set_01}}</td>
                  <td class = "success text-right">{{$dp->set_02}}</td>
                  <td class = "success text-right">{{$dp->set_03}}</td>
                  @if ($partido->finalizado)
                    @if ($dp->isWinn)
                      <td class = "success text-center"><span class="label label-success">Ganador</span></td>
                    @else
                      <td class = "success text-center"></td>
                    @endif
                  @else
                    <td class = "success text-center"><span class="label label-info">Por Jugar</span></td>
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

  <br>
@if (Auth::user()->rol() < 4)
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
      <a href="{{route('fixture.create', $torneo->id)}}" class="btn btn-warning btn-block"><b>SALIR</b></a><br>
    </div>
      @if ($par->instancia_id == 1)
        <div class="col-xs-12 col-sm-6 col-md-4">
        <form action="{{route('fixture.finalizar_categoria')}}" method="POST"> 
          <button type="button" class="btn btn-success btn-block" data-toggle="modal" 
             data-target="#finalizarCategoria"><b>FINALIZAR</b></button><br>
             @include('fixture.modals.finalizarCategoria')
        </form>
        </div>
      @else
        <div class="col-xs-12 col-sm-6 col-md-4">
        <form action="{{route('fixture.instancias')}}" method="POST"> 
          <button type="button" class="btn btn-success btn-block" data-toggle="modal" 
              data-target="#nuevaInstancia"><b>NUEVA INSTANCIA</b></button><br>
              @include('fixture.modals.nuevaInstancia')
        </form>
        </div>
      @endif
  </div>
@else
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
      <a href="{{route('inscripciones.create')}}" class="btn btn-warning btn-block"><b>SALIR</b></a>
    </div>
  </div>
@endif
@endsection