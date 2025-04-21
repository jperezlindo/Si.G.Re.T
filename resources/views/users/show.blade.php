@extends('layouts.mainMenu')

@section('content')
  <!-- Aca empieza LA VALIDACION-->
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
      <h2 class="text-center"><strong>Datos del Usuario</strong></h2>
    </div>
  </div>

  <!-- Aca empieza el formulario-->
    <div class="row">
      <div class="col-xs-12 col-sm-4 col-md-4 col-md-offset-4">
        <img width="200px" src="{{ Storage::url ($us->foto) }}" class="center-block img-responsive img-thumbnail user-imag" alt="Responsive image" alt="User Image">
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
          <div class="form-group">
            <label for="">Usuario: <span class="label label-success">{{ $us->user_empresa->rol->name }}</span> </label>
            <input type="text" class="form-control" name="user" placeholder="" value="{{$us->user}} " readonly>
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-5">
          <div class="form-group">
            <label for="">D.N.I* </label>
            <input type="text" class="form-control" name="dni" placeholder="" value="{{$us->dni}}" readonly>
          </div>
      </div>
    </div>

    <div class="row">
      
      <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1" >
          <div class="form-group">
            <label for="">Apellido: </label>
            <input type="text" class="form-control" name="apellido" placeholder="" value="{{$us->apellido}}" readonly>
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-5 ">
        <div class="form-group">
          <label for="">Nombre: </label>
          <input type="text" class="form-control" name="name" placeholder="" value="{{$us->name}}" readonly>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
        <div class="form-group">
            <label for="">Email: </label>
            <input type="email" class="form-control" name="email" placeholder="" value="{{$us->email}}" readonly>
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-5">
          <div class="form-group">
            <label for="">Fecha de Nacimiento: </label>
            <input type="date" class="form-control" name="fecha_nacimiento" placeholder="" value="{{$us->fecha_nacimiento->toDateString()}}" readonly>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
        <div class="form-group">
            <label for="">Direccion: </label>
            <input type="direccion" class="form-control" name="direccion" placeholder="" value="{{$us->direccion}}" readonly>
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-5">
          <div class="form-group">
            <label for="">Cel: </label>
            <input type="text" class="form-control" name="cel" placeholder="" value="{{$us->cel}}" readonly>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
        <div class="form-group">
            <label for="">Sexo: </label>
            <input class="form-control" name="sexo" value=" {{$us->sexo}}" readonly>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-5">
          <div class="form-group">
            <label for="">Ciudad: </label>
            <input type="text" class="form-control" name="ciudad_id" placeholder="" value="{{$us->ciudad->name}}" readonly>
          </div>
      </div>
    </div>

    <hr>

    <div class="row"> 
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-4">
          <a href="{{route('users.index')}}" class="btn btn-warning  btn-block">Volver</a>
      </div>
    </div>
    <br>

@endsection