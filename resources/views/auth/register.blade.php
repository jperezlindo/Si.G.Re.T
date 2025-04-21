<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Registrate</title>

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/customRegister.css">
  <link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">

</head>

<body>
  <div class="col-xs-12 col-sm-12 col-md-12">
    @include('fragment.msg')
    @include('fragment.error')
  </div>
  <div class="my-container">
    <div class="container ">
      <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-12 col-md-offset-">

          <div class="my-form-top">
            <div class="my-form-top-left">
              <h1>Registrate en <strong>Si.G.Re.T</strong></h1>
              <p>Ingrese sus datos</p>
            </div>
          </div>

          <div class="my-form-button">
          <form class="form-group" method="POST" action="{{ route('register') }}"> 
            
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
                <div class="form-group">
                  <label for="">Nombre de Usuario:* </label>
                  <input type="text" class="form-control" name="user" value="{{old('user')}}" maxlength="30" required>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-5">
                <div class="form-group">
                    <label for="">Email:* </label>
                    <input type="email" class="form-control" name="email" value="{{old('email')}}" maxlength="50" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
                  <div class="form-group">
                    <label for="">D.N.I:*</label><span class="label label-danger" id="error_dni"></span>
                    <input type="number" class="form-control" name="dni" id="dni" value="{{ old('dni') }}" onchange="val_dni()" required>
                  </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-5">
                  <div class="form-group">
                    <label for="">Apellido:* </label>
                    <input type="text" class="form-control" name="apellido" value="{{old('apellido')}}" maxlength="30" required>
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
                  <div class="form-group">
                    <label for="">Nombre:* </label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" maxlength="30" required>
                  </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-5">
                  <div class="form-group">
                    <label for="">Fecha de Nacimiento:* </label>
                    <input type="date" class="form-control" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}" required>
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
                <div class="form-group">
                    <label for="">Direccion:* </label>
                    <input type="direccion" class="form-control" name="direccion" value="{{old('direccion')}}" maxlength="250" required>
                  </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-5">
                <div class="form-group">
                  <label>Celular:* </label><span class="label label-danger" id="error_cel"></span>
                  <input id="cel" type="number" class="form-control" name="cel" value="{{old('cel')}}" required onchange="val_cel()">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
                <div class="form-group">
                  <label class="text text-center">Categorias</label>
                  <select class="form-control" name="categoria_id" required>
                    <option value="">Selecione una categoria</option>
                    @foreach ($categorias as $cat)
                      <option value="{{$cat->id}}"> 
                        {{$cat->c_etario->name}} | {{$cat->c_sexo->name}} | {{$cat->c_categoria->name}}  
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-5">
                  <div class="form-group">
                    <label for="">Sexo:* </label>
                    <select class="form-control" name="sexo">
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otros">Otros</option>
                    </select>
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
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
              <div class="col-xs-12 col-sm-6 col-md-5">
                <div class="form-group">
                  <label for="">Empresa: </label>
                  <select name="empresa_id" class="form-control">
                    @foreach ($empresas as $em)
                      <option value="{{$em->id}}">{{$em->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="">Contraseña:* </label>
                  <input id="password" type="password"  placeholder="Contraseña..." class="form-control" name="password" maxlength="20" required>
                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-5">
                <div class="form-group">
                  <label for="">Repita Contraseña:* </label>
                  <input id="password-confirm" type="password"  placeholder=" Repita su Contraseña..." class="form-control" name="password_confirmation" maxlength="20" required>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-1">
                {!! csrf_field()!!} <!-- funcion para el token -->
                <button type="submit" class="btn btn-success btn-block"><b>REGISTRARME</b></button>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
                <a href="/" class="btn btn-warning btn-block"><b>SALIR</b></a>
              </div>
            </div>
          </form>
          </div>

        </div>
      </div>
    </div>
  </div>

  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  @include('layouts.validaciones')
</body>
</html>
