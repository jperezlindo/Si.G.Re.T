@extends('layouts.mainMenu')

@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-12 col-md-offset-">
      <div class="form-group">
        @include('fragment.msg')
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="alert alert-info text-center" role="alert">
        <h4><strong>INFORMACION del Torneo</strong>, aqui puede visualizar los datos del Torneo <b>{{$torneo->name}}</b>  .</h4>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4">
              <div class="form-group text-center">
                <label for="">Torneo:</label><br>
                <h4 for=""><b>{{$torneo->name}}</b></h4>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
              <div class="form-group text-center">
                <label for="">Tipo de Torneo:</label><br>
                <h4 for=""><b>{{$torneo->tipo_torneo->name}}</b></h4>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
              <div class="form-group text-center">
                <label for="">Inicia a las:</label><br>
                <h4 for=""><b>{{$torneo->hora}} hs. </b></h4>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3">
              <div class="form-group text-center">
                <label for="">Fecha Inicio:</label><br>
                <h4 for=""><b>{{$torneo->f_desde->format('d-m-Y')}}</b></h4>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
              <div class="form-group text-center">
                <label for="">Fecha Fin:</label><br>
                <h4 for=""><b>{{$torneo->f_hasta->format('d-m-Y')}}</b></h4>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
              <div class="form-group text-center">
                <label for="">Abre Inscripciones:</label><br>
                <h4 for=""><b>{{$torneo->ini_ins->format('d-m-Y')}}</b></h4>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
              <div class="form-group text-center">
                <label for="">Cierra Inscripciones:</label><br>
                <h4 for=""><b>{{$torneo->fin_ins->format('d-m-Y')}}</b></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
      <h4 class="text text-center"><strong>Categorias Participantes</strong></h4>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="">
            <td class="active text-left"><strong>Inscrptos</strong></td>
            <td class="active text-left"><strong>Categoria</strong></td>
            <td class="active text-left"><strong>Valor</strong></td>
            <td class="active text-left"><strong>Equipo</strong></td>
            <td class="active text-left"><strong>Campeón</strong></td>
            <td class="active text-left"><strong>Sub Campeón</strong></td>
            <td class="active text-left"><strong>Semi</strong></td>
            <td class="active text-left"><strong>Cuartos</strong></td>
            <td class="active text-left"><strong>Octavos</strong></td>
            <td class="active text-center"><strong>Inscribirme</strong></td>
          </thead>
          <tbody>
          @foreach ($agregadas as $categoria)
            <tr>
              <td class = "success text-center">
                <span class="label label-danger">
                  <b>{{$categoria->ins}}/{{ $categoria->cupo }}</b>
                </span>
                <a href="{{route ('inscripciones.show', $categoria->id)}}" class="btn btn-info btn-xs"><b>VER</b></a>
              </td>
              <td class = "success text-left">
                {{$categoria->categoria->c_etario->name}}-{{$categoria->categoria->c_sexo->name}}-{{$categoria->categoria->c_categoria->name}} </td>
              <td class = "success text-right">$ {{ $categoria->valor }}</td>
              
              @if ($categoria->n_ptes == 1)
                <td class = "success text-left">Single</td>
              @else
                <td class = "success text-left">Double</td>
              @endif
              <td class = "success text-right">{{ $categoria->campeon }} pts.</td>
              <td class = "success text-right">{{ $categoria->subcampeon }} pts.</td>
              <td class = "success text-right">{{ $categoria->semifinal }} pts.</td>
              <td class = "success text-right">{{ $categoria->cuartos }} pts.</td>
              <td class = "success text-right">{{ $categoria->octavos }} pts.</td>
              <td class = "success text-center" title="INSCRIBIRSE AL TORNEO">  
                <form action="{{ route('inscripciones.store')}}" method="POST"> 
                  <button type="button" class="btn btn-success btn-xs" data-toggle="modal" 
                  data-backdrop="static" data-target="#confirmacionInscripcion_{{$categoria->id}}">
                  <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span></button>
                  @include('inscripciones.modals.confirmacionInscripcion')
                </form>
              </td>
            </tr>
          @endforeach
          </tbody>  
        </table>
      </div>
    </div>
  </div>

  @if (Auth::user()->rol() < 4)
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
      <a href="{{route('torneo.index')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>      
    </div>
  </div>
  @else
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
      <a href="{{route('inscripciones.create')}}" class="btn btn-primary  btn-block"><b>MIS TORNEOS</b></a><br>      
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4">
      <a href="{{route('torneo.index')}}" class="btn btn-primary  btn-block"><b>TORNEOS ABIERTOS</b></a>      
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
      <a href="{{route('home')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>      
    </div>
  </div>
  @endif

@endsection