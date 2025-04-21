@extends('layouts.mainMenu')

@section('content')

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
      <div class="alert alert-info text-center" role="alert">
        <h5><strong>Modificar Categoria</strong>, aqui puede modificar los datos de la categoria.</h5 class="text center">
      </div>
      <hr>
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

  <!-----------------------Agrega las categorias a l torneo---------------------------------------->
    <form class="form-group" method="POST" action="{{ route('torneo.update_cat') }}">

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-1">
          <div class="form-group">
            <label class="text text-center"><strong>Categorias</strong></label>
            <select class="form-control" name="categoria_id" required>
              <option value="{{$categoria->categoria_id}}">
              	{{$categoria->categoria->c_etario->name}} | {{$categoria->categoria->c_sexo->name}} | {{$categoria->categoria->c_categoria->name}}
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
            <input type="number" min="0" class="form-control text-right" name="valor" value="{{ $categoria->valor }}" required>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-2">
          <div class="form-group">
            <label for="">Tipo de Equipo:* </label>
            <select name="n_ptes" class="form-control" value="{{ $categoria->n_ptes }}" required>
              @if ($categoria->n_ptes == 1)
                <option value="1">Single</option>
                <option value="2">Double</option>
              @else
                <option value="2">Double</option>
                <option value="1">Single</option>
              @endif
            </select>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-2">
          <div class="form-group">
              <label for="">Total de Equipo:* </label>
              <input type="number" min="0" class="form-control text-right" name="cupo" value="{{ $categoria->cupo }}" required>
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
            <input type="number" min="0" class="form-control text-right" name="campeon" value="{{ $categoria->campeon }}" required>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-2">
          <div class="form-group">
            <label for="">Sub Campeon</label>
            <input type="number" min="0" class="form-control text-right" name="subcampeon" value="{{ $categoria->subcampeon }}" required>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-2">
          <div class="form-group">
            <label for="">Semi Final</label>
            <input type="number" min="0" class="form-control text-right" name="semifinal" value="{{ $categoria->semifinal }}" required>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-2">
          <div class="form-group">
            <label for="">Cuartos de Final</label>
            <input type="number" min="0" class="form-control text-right" name="cuartos" value="{{ $categoria->cuartos }}" required>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-2">
          <div class="form-group">
            <label for="">Octavos de Final</label>
            <input type="number" min="0" class="form-control text-right" name="octavos" value="{{ $categoria->octavos }}" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
          <label for="">Descripcion:* </label>
          <textarea class="form-control" rows="3" name="descripcion" required>{{$categoria->descripcion}}</textarea>
        </div>
      </div>
    <hr>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-2 col-md-offset-1">
		  <div class="form-group">
		    {!! csrf_field()!!} <!-- funcion para el token -->
		    <a href="{{ route ('torneo.edit_cat', $categoria->torneo_id)}}" class="btn btn-warning btn-block"><b>SALIR</b></a>
		  </div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-2 col-md-offset-6">
		  <div class="form-group">
		    {!! csrf_field()!!} <!-- funcion para el token -->
		    <button type="submit" class="btn btn-success  btn-block"><b>GUARDAR</b></button>
		    <input type="hidden" name="categoria_torneo_id" value="{{$categoria->id}}">
		    <input type="hidden" name="torneo_id" value="{{$categoria->torneo_id}}">
		  </div>
		</div>
	</div>
  </form>

@endsection