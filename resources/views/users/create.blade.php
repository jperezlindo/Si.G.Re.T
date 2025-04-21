@extends('layouts.mainMenu')

@section('content')
  
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
      <div class="alert alert-info text-center" role="alert">
        <h1><strong>ALTA DE USUARIO</strong></h1>
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

  <form class="form-group" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
          <div class="form-group">
            <label for="">Usuario:* </label>
            <input type="text" class="form-control" name="user" value="{{ old('user') }}" maxlength="30" required>
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-5">
          <div class="form-group">
            <label for="">D.N.I:*</label><span class="label label-danger" id="error_dni"></span>
            <input type="number" min="5000000" max="50000000" class="form-control" name="dni" id="dni" value="{{ old('dni') }}" onchange="val_dni()"  placeholder="Ingresar con 0 en caso de que el DNI sea menor a 10M" maxlength="8"required>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1" >
          <div class="form-group">
            <label for="">Apellido:* </label>
            <input type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" style="text-transform: uppercase;" maxlength="30" required>
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-5 ">
        <div class="form-group">
          <label for="">Nombre:* </label>
          <input type="text" class="form-control" name="name" value="{{ old('name') }}" style="text-transform: uppercase;" maxlength="30" required>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
        <div class="form-group">
            <label for="">Email:* </label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" style="text-transform: lowercase;" maxlength="50" required="email">
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-5">
          <div class="form-group">
            <label for="">Fecha de Nacimiento:* </label>
            <input type="date" class="form-control" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" min="1917-01-01" max="2015-12-31" required>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
        <div class="form-group">
            <label for="">Direccion:* </label>
            <input type="direccion" class="form-control" name="direccion" value="{{ old('direccion') }}" style="text-transform: uppercase;" maxlength="60" required>
          </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-5" >
          <div class="form-group">
            <label>Cel: </label><span class="label label-danger" id="error_cel"></span>
            <input id="cel" type="text" max="15" class="form-control" name="cel" value="{{old('cel')}}" onchange="val_cel()">
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
        <div class="form-group">
            <label for="">Sexo:* </label>
            <select class="form-control" name="sexo" value="" >
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otros">Otros</option>
            </select>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-5">
          <div class="form-group">
            <label for="">Ciudad: </label>
            <select name="ciudad_id" class="form-control">
              @foreach ($ciudades as $ciudad)
                <option value="{{$ciudad->id}}"> 
                  {{$ciudad->name}} | {{$ciudad->provincia->name}} | {{$ciudad->provincia->pais->name}} 
                </option>
              @endforeach
            </select>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
            <div class=" form-group {{ $errors->has('password') ? ' has-error' : '' }} ">
              <label for="">Contraseña:* </label>
                <input id="password" type="password"  placeholder="Contraseña..." class="form-control" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-5">
        <div class="form-group">
          <label for="">Repita la Contraseña:* </label>
           <input id="password-confirm" type="password"  placeholder=" Repita su Contraseña..." class="form-control" name="password_confirmation" required>
        </div>
      </div>
    </div>

    <br>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
        <a href="{{route('home')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-5">
        {!! csrf_field()!!} <!-- funcion para el token -->
        <button type="submit" class="btn btn-success btn-block"><b>GUARDAR</b></button>
      </div>
    </div>
    <br>
  </form>

@endsection