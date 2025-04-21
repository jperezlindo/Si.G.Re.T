@extends('layouts.mainMenu')

@section('content')

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="alert alert-info text-center" role="alert">
        <h2><b>INFORMACION DEL TORNEO: {{$torneo->name}}</b>  .</h2>
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
                <label for="">Inicio el:</label><br>
                <h4 for=""><b>{{$torneo->f_desde->format('d-m-Y')}}</b></h4>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3">
              <div class="form-group text-center">
                <label for="">Finalizo el:</label><br>
                <h4 for=""><b>{{$torneo->f_hasta->format('d-m-Y')}}</b></h4>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
              <div class="form-group text-center">
                <label for="">Hora de Inicio:</label><br>
                <h4 for=""><b>{{$torneo->hora}} hs. </b></h4>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
              <div class="form-group text-center">
                <label for="">Inscripciones desde:</label><br>
                <h4 for=""><b>{{$torneo->ini_ins->format('d-m-Y')}}</b></h4>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
              <div class="form-group text-center">
                <label for="">Inscripciones hasta:</label><br>
                <h4 for=""><b>{{$torneo->fin_ins->format('d-m-Y')}}</b></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-10 col-md-offset-1">
      <div class="form-group">
        @include('fragment.msg')
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <h4 class="text text-center"><strong>Categorias Participantes</strong></h4>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="">
            <td class="active text-center"><strong>Participaron</strong></td>
            <td class="active text-left"><strong>Categoria</strong></td>
            <td class="active text-left"><strong>Equipo Campeon</strong></td>
            <td class="active text-center"><strong>Mas Informacion</strong></td>
            <td class="active text-center"><strong>FIXTURE</strong></td>
            <td class="active text-center"><strong>PDF</strong></td>
          </thead>
          <tbody>
          @foreach ($agregadas as $categoria)
            <tr>
              <td class = "success text-center">
                <b>{{$categoria->ins}}/{{ $categoria->cupo }}</b>
              </td>
              <td class = "success text-left"><b>
                {{$categoria->categoria->c_etario->name}}-{{$categoria->categoria->c_sexo->name}}-{{$categoria->categoria->c_categoria->name}}</b></td>

              <td class = "success text-left"><b>{{ $categoria->ganador }}</b></td>

              <td class = "success text-center" title="VER INFORMACION">
				        <a data-toggle="modal" data-target="#info_torneo_{{ $categoria->id }}" class="btn btn-info btn-xs">
                 <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
             	  </a>
                @include('torneo.modals.info_torneo') 
              </td>
              <td class = "success text-center" title="VER FIXTURE">
               <a href="{{ route('fixture.fixture', $categoria->id) }} " class="btn btn-primary btn-xs">
                 <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
               </a>
              </td>
              <td class = "success text-center" title="VER PDF">
               <a href="{{ route('torneo.pdf', [$torneo->id,$categoria->id]) }} " class="btn btn-danger btn-xs">
                 <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
               </a>
              </td>
            </tr>
          @endforeach
          </tbody>  
        </table>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
      <a href="{{route('torneo.finalizados')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>      
    </div>
  </div>

@endsection