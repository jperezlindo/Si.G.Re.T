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
        <h5><strong>Editar Torneo</strong>, aqui puede modificar los datos para el Torneo. <b>{{$torneo->name}}</b></h5 class="text center">
      </div>
      <hr>
    </div>
  </div>

  <form class="form-group" method="POST" action="{{ route('torneo.update', $torneo->id) }}">
    <input  name="_method" type="hidden" value="PUT">

     <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-2">
        <div class="form-group">
          <label for="">Tipo de Torneo: </label>
          <select name="tipo_torneo_id" class="form-control" required>
            <option value="{{$torneo->tipo_torneo_id}}">{{$torneo->tipo_torneo->name}}</option>
              @foreach ($tipos as $tipo)
                <option value="{{$tipo->id}}"> {{$tipo->name}} </option>
              @endforeach
          </select>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
          <label for="">Nombre del Torneo:* </label>
          <input type="text" class="form-control" name="name" value="{{ $torneo->name }}" style="text-transform: uppercase;"  maxlength="50" required>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-2" >
        <div class="form-group">
          <label for="">Hora Inicio:* </label>
          <input  type="time" min="0" max="24" class="form-control text-right" name="hora" value="{{ $torneo->hora }}" readonly>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-2">    
        <div class="form-group">
          <label for="">Fecha Inicio:* </label>
          <input  type="date" min="<?php $hoy=date("Y-m-d"); echo $hoy; ?>" class="form-control" 
                  name="f_desde" value="{{ $torneo->f_desde->toDateString() }}" readonly  >
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-2" >
        <div class="form-group">
          <label for="">Fecha Fin:* </label>
          <input  type="date" min="<?php $hoy=date("Y-m-d"); echo $hoy; ?>" class="form-control" 
                  name="f_hasta" value="{{ $torneo->f_hasta->toDateString() }}" readonly>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-2 ">
        <div class="form-group">
          <label for="">Inicio de Inscripcion:* </label>
          <input type="date"  class="form-control" 
                  name="ini_ins" value="{{ $torneo->ini_ins->toDateString() }}" required>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-2">
        <div class="form-group">
          <label for="">Fin de Inscripcion:* </label>
          <input type="date" min="<?php $hoy=date("Y-m-d"); echo $hoy; ?>" class="form-control" 
                  name="fin_ins" value="{{ $torneo->fin_ins->toDateString() }}" required>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
        <div class="form-group">
            <label for="">Descripcion de Torneo: </label>
            <textarea class="form-control" rows="5" name="descripcion" 
            style="text-transform: uppercase;" maxlength="250" required>{{ $torneo->descripcion }}</textarea>
        </div>
      </div>
    </div>

    <br>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-2">
        <a href="{{route('torneo.index')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-1">
        <a href="{{route('torneo.edit_cat', $torneo->id)}}" class="btn btn-primary btn-block"
        ><b>EDITAR CATEGORIAS</b></a>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-1">
        {!! csrf_field()!!} <!-- funcion para el token -->
        <button type="submit" class="btn btn-success  btn-block"><b>GUARDAR</b></button>
      </div>
    </div>
  </form>
@endsection