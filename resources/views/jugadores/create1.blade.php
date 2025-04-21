@extends('layouts.mainMenu')

@section('content')
  
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        @include('fragment.msg')
        @include('fragment.error')
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="alert alert-info text-center" role="alert">
        <h5><strong>Jugadores</strong>, aqui puede ver los jugadores que participan del juego.</h5 class="text center">
      </div>
    </div>
  </div>

  <hr>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <h4><strong>Jugadores Confirmados</strong></h4>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="">
            <td class="active text-left"><strong>Apellido</strong></td>
            <td class="active text-left"><strong>Nombre</strong></td>
          </thead>
          <tbody>
          @foreach ($confirmados as $con)
            <tr>
              <td class = "success text-left">{{$con->user_empresa->user->apellido}}</td>
              <td class = "success text-left">{{$con->user_empresa->user->name}}</td>
            </tr>
          @endforeach
          </tbody>  
        </table>
      </div>
    </div>




    <!-- Buscador -->
  <div class="row">
    <div class=" form-group">
      <form class="" method="GET" action="{{route('jugadores.create1', $dr->id)}}" role="search" >
        <div class="col-xs-10 col-sm-4 col-md-8 col-xs-offset-1 col-md-offset-2 input-group ">
          <input class="form-control" type="text" name="buscar" placeholder="Ingrese el usuario que participaran en el juego" aria-describedby= "search" autofocus>
          <span class="input-group-btn">
            <button type="submit" class="btn btn-info" >
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span> 
        </div>
      </form> 
     </div>
  </div>
  <!-----------------------Agrega los jugadores para la reserva---------------------------------------->
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-2">
      <h4><strong>Posibles Participantes</strong></h4>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="">
            <td class="active text-left"><strong>Apellido</strong></td>
            <td class="active text-left"><strong>Nombre</strong></td>
            <td class="active text-center"><strong>Agregar</strong></td>
          </thead>
          <tbody>
          @foreach ($usuarios as $us)
            <tr>
              <td class = "success text-left">{{$us->apellido}}</td>
              <td class = "success text-left">{{$us->name}}</td>
              <td class = "success text-center">
                <a href="{{route('jugadores.addUser', [$us->user_empresa->id, $dr->id, 1])}}" 
                  class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
              </td>
            </tr>
          @endforeach
          </tbody>  
        </table>
      </div>
    </div>
    <!-- Jugadores a la reserva -->
    <div class="col-xs-12 col-sm-12 col-md-4">
      <h4><strong>Participantes No Confirmados</strong></h4>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="">
            <td class="active text-left"><strong>Apellido</strong></td>
            <td class="active text-left"><strong>Nombre</strong></td>
            <td class="active text-center"><strong>Quitar</strong></td>
          </thead>
          <tbody>
          @foreach ($jugadores as $jugador)
            <tr>
              <td class = "success text-left">{{$jugador->user_empresa->user->apellido}}</td>
              <td class = "success text-left">{{$jugador->user_empresa->user->name}}</td>
              <td class = "success text-center">
                <form action="{{route('jugadores.delUser', [$jugador->id, $dr->id, 1])}}" method="POST">
                  {{ csrf_field() }}    
                  <button  class="btn btn-danger btn-xs">
                  <span class=" glyphicon glyphicon-remove" aria-hidden="true"></span>
                  <input type="hidden" name="_method" value="DELETE">
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
  <hr>
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-2">
      <div class="form-group">
        <form action="{{route('detalle_reserva.edit')}}" method="GET">
          <button type="submit" class="btn btn-warning btn-block"><b>SALIR</b></button>
          <input type="hidden" name="detalle_reserva_id" value="{{$dr->id}}">
        </form>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-4">
      <div class="form-group">
        <a href="{{route('jugadores.avisarJugadores1', $dr->id)}}" class="btn btn-success btn-block"><b>AVISAR</b></a>
      </div>
    </div>
  </div>
@endsection