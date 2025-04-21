@extends('layouts.mainMenu')

@section('content')

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
      <div class="progress">
          <div class="progress-bar progress-bar-striped progress-bar-info active" role="progressbar" style="width: 100%">
            <strong>Paso: 3/3</strong>
        </div>
      </div>
    </div>
  </div>  

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
      <div class="alert alert-info text-center" role="alert">
        <h3><strong>3- Agregar/Quitar Categorias</strong>, aqui puede agregar o quitar las categorias que podran participar en el torneo.</h3>
      </div>
      <hr>
    </div>
  </div>
  <!-----------------------Agrega las categorias a l torneo---------------------------------------->
  <form class="form-group" method="POST" action="{{ route('torneo.store_cat') }}">

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-1">
        <div class="form-group">
          <label class="text text-center"><strong>Categorias</strong></label>
          <select class="form-control" name="categoria_id" required>
            <option value="">Seleccione una categoria</option>
            @foreach ($categorias as $cat)
              <option value="{{$cat->id}}"> 
                {{$cat->c_etario->name}} | {{$cat->c_sexo->name}} | {{$cat->c_categoria->name}}  
              </option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-2 ">
        <div class="form-group">
          <label for="">Valor de la Inscripcion:* </label>
          <input type="number" min="1" max="99999" class="form-control text-right" name="valor" value="{{ old('valor') }}" required>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-2">
        <div class="form-group">
          <label for="">Tipo de Equipo:* </label>
          <select name="n_ptes" class="form-control" value="{{ old('n_ptes') }}" required>
            <option value="">Seleccione el tipo </option>
            <option value="1">Single</option>
            <option value="2">Doble</option>
          </select>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-2">
        <div class="form-group">
            <label for="">Total de Equipos:* </label>
            <input type="number" min="4" max="250" class="form-control text-right" name="cupo" value="{{ old('cupo') }}" required>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
        <div class="form-group text-center">
            <h3 for=""><b>Puntos a repartir por jugador</b></h3>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-2 col-md-offset-1">
        <div class="form-group">
          <label for="">Campeón</label>
          <input type="number" min="0" max="1000" class="form-control text-right" name="campeon" value="{{ old('campeon') }}" required>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-2">
        <div class="form-group">
          <label for="">Sub Campeon</label>
          <input type="number" min="0" max="1000" class="form-control text-right" name="subcampeon" value="{{ old('subcampeon') }}" required>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-2">
        <div class="form-group">
          <label for="">Semi Final</label>
          <input type="number" min="0" max="1000" class="form-control text-right" name="semifinal" value="{{ old('semifinal') }}" required>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-2">
        <div class="form-group">
          <label for="">Cuartos de Final</label>
          <input type="number" min="0" max="1000" class="form-control text-right" name="cuartos" value="{{ old('cuartos') }}" required>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-2">
        <div class="form-group">
          <label for="">Octavos de Final</label>
          <input type="number" min="0" max="1000" class="form-control text-right" name="octavos" value="{{ old('octavos') }}" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
        <label for="">Descripcion:* </label>
        <textarea class="form-control" rows="3" name="descripcion" maxlength="250" required></textarea><br>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
        <div class="form-group">
          {!! csrf_field()!!} <!-- funcion para el token -->
          <button type="submit" class="btn btn-success  btn-block">agregar</button>
          <input type="hidden" name="torneo_id" value="{{ $torneo->id }}">
          <input type="hidden" name="editar" value="0">
        </div>
      </div>
    </div>
  </form>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        @include('fragment.msg')
        @include('fragment.error')
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
      <h4 class="text text-center"><strong>Categorias Agregadas</strong></h4>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="">
            <td class="active text-left"><strong>Cupo</strong></td>
            <td class="active text-left"><strong>Categoria</strong></td>
            <td class="active text-left"><strong>Valor</strong></td>
            <td class="active text-left"><strong>Equipo</strong></td>
            <td class="active text-left"><strong>Campeón</strong></td>
            <td class="active text-left"><strong>Sub Campeón</strong></td>
            <td class="active text-left"><strong>Semi</strong></td>
            <td class="active text-left"><strong>Cuartos</strong></td>
            <td class="active text-left"><strong>Octavos</strong></td>
            <td class="active text-center"><strong>Quitar</strong></td>
          </thead>
          <tbody>
          @foreach ($agregadas as $categoria)
            <tr>
              <td class = "success text-right">{{ $categoria->cupo }}</td>
              <td class = "success text-left">
                {{$categoria->categoria->c_etario->name}}, {{$categoria->categoria->c_sexo->name}},{{$categoria->categoria->c_categoria->name}} </td>
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

              <td class = "success text-center" title="QUITAR CATEGORIA">
                <form action="{{route('torneo.destroy_cat')}}" method="POST">
                  <input type="hidden" name="categoria_id" value="{{ $categoria->id }}">
                  <input type="hidden" name="editar" value="0">
                  {{ csrf_field() }}    
                  <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" 
                  data-target="#quitarCategoria_{{$categoria->id}}">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true" ></span></button>
                  @include('torneo.modals.quitarCategoria')
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
    <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-1">
      <div class="form-group">
        <a href="{{route('reserva_torneo.create', $torneo->id)}}" class="btn btn-primary btn-block"><b>VOLVER</b></a>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-6">
      <div class="form-group">
        <a data-toggle="modal" data-target="#torneoEnd" class="btn btn-success btn-block"><b>GUARDAR</b></a>
        @include('torneo.modals.torneoEnd')
      </div>
    </div>
  </div>

@endsection