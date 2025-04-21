@extends('layouts.mainMenu')

@section('content')
  
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="progress">
          <div class="progress-bar progress-bar-striped progress-bar-info active" role="progressbar" style="width: 33%">
            <strong>Paso: 1/3</strong>
        </div>
      </div>
    </div>
  </div>  

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="alert alert-info text-center" role="alert">
        <h2><strong>1- Datos del Torneo</strong>, aqui puede agregar los datos para el nuevo  Torneo.</h2>
      </div>
      <hr>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-2">
      <div class="form-group">
        @include('fragment.msg')
        @include('fragment.error')
      </div>
    </div>
  </div>

  

  <form class="form-group" method="POST" action="{{ route('torneo.store') }}" enctype="multipart/form-data">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-2">
        <div class="form-group">
          <label for="">Tipo de Torneo: </label>
          <select name="tipo_torneo_id" class="form-control" required>
            <option value="">Seleccione el Tipo de Torneo</option>
              @foreach ($tipos as $tipo)
                <option value="{{$tipo->id}}"> {{$tipo->name}} </option>
              @endforeach
          </select>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
          <label for="">Nombre del Torneo:* </label>
          <input type="text" class="form-control" name="name" value="{{ old('name') }}" style="text-transform: uppercase;" maxlength="50" required>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-2" >
        <div class="form-group">
          <label for="">Hora Inicio:* </label>
          <input  type="time" min="0" max="24" class="form-control text-right" name="hora" value="{{ old('hora') }}" required>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-2">    
        <div class="form-group">
          <label for="">Fecha Inicio:* </label>
          <input  type="date" min="<?php $hoy=date("Y-m-d"); echo $hoy; ?>" 
           class="form-control" name="f_desde" value="{{ old('f_desde') }}" required>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-2" >
        <div class="form-group">
          <label for="">Fecha Fin:* </label>
          <input  type="date" min="<?php $hoy=date("Y-m-d"); echo $hoy; ?>"
           class="form-control" name="f_hasta" value="{{ old('f_hasta') }}" required>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-2 ">
        <div class="form-group">
          <label for="">Inicio de Inscripcion:* </label>
          <input type="date" 
           class="form-control" name="ini_ins" value="{{ old('ini_ins') }}" required> 
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-2">
        <div class="form-group">
          <label for="">Fin de Inscripcion:* </label>
          <input type="date" min="<?php $hoy=date("Y-m-d"); echo $hoy; ?>"
           class="form-control" name="fin_ins" value="{{ old('fin_ins') }}" required>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
        <div class="form-group">
            <label for="">Descripcion de Torneo:* </label>
            <textarea class="form-control" rows="5" name="descripcion" value="{{ old('descripcion') }}" 
            style="text-transform: uppercase;" maxlength="250" required></textarea>
        </div>
      </div>
    </div>

    

    <br>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <a href="{{route('home')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        {!! csrf_field()!!} <!-- funcion para el token -->
        <button type="submit" class="btn btn-primary  btn-block"><b>SIGUIENTE</b></button>
      </div>
    </div>
    <br>

</form>
@endsection