@extends('layouts.mainMenu')

@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="alert alert-info text-center">
        <h3 class="text-center"><strong>Equipos</strong></h3>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
      <div class="form-group">
        @include('fragment.msg')
         @include('fragment.error')
      </div>
    </div>
  </div>

  <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
        <div class="table-responsive">
          <div class="form-group">
            <table class="table table-hover table-striped">
              <thead class="">
                <td class="active text-center"><strong>Nro.</strong></td>
                <td class="active text-left"><strong>Nombre</strong></td>
                <td class="active text-left"><strong>Categoria</strong></td>
                <td class="active text-center"><strong>Integrantes</strong></td>
                <td class="active text-center"><strong>Asociarme</strong></td>
              </thead>
              <tbody>
              @foreach ($equipos as $i => $equipo)
                  <tr>
                    <td class = "success text-center"><b>{{ $i + 1}}</b></td>
                    <td class = "success text-left"><b>{{ $equipo->name}}</b></td>
                    <td class = "success text-left"><b>
                      {{$equipo->categoria->c_etario->name}}-{{$equipo->categoria->c_sexo->name}}-{{$equipo->categoria->c_categoria->name}}
                    </b></td>
                    <td class = "success text-center"><b>{{$equipo->user_empresa_equipo->count()}}</b></td>
                    <td class = "success text-center">
                      <form action="{{route('miequipo.store')}}" method="POST">
                        {{ csrf_field() }}    
                        <button  class="btn btn-success btn-xs">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        <input type="hidden" name="equipo_id" value="{{$equipo->id}}">
                        </button>
                      </form>
                    </td>
                  </tr> 
                @endforeach
                </tbody> 
            </table>
        </div>
        </div>
      </div>
  </div>
  <br>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
        <a href="{{route('home')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>
      </div>
    </div>

@endsection