<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Registrate</title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <h2 class="text-center"><strong>Finaliza tu Registro en SiGRet</strong></h2>
          <p>* Datos obligatorios</p>
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
    <hr> 
    <div class="container">
      <form class="form-group" method="POST" action="{{ route('finishUpdate', Auth::user()->id) }}" enctype="multipart/form-data"> 
          <input  name="_method" type="hidden" value="PUT">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
                <div class="form-group">
                  <label for="">D.N.I:*</label><span class="label label-danger" id="error_dni"></span>
                  <input type="number" class="form-control" name="dni" id="dni" value="{{ old('dni') }}" onchange="val_dni()"required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-5">
                <div class="form-group">
                  <label for="">Apellido:* </label>
                  <input type="text" class="form-control" name="apellido" placeholder="" value="{{old('apellido')}}" required>
                </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
                <div class="form-group">
                  <label for="">Nombre:* </label>
                  <input type="text" class="form-control" name="name" placeholder="" value="{{ old('name') }}" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-5">
                <div class="form-group">
                  <label for="">Fecha de Nacimiento:* </label>
                  <input type="date" class="form-control" name="fecha_nacimiento" placeholder="" value="{{old('fecha_nacimiento')}}" required>
                </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
              <div class="form-group">
                  <label for="">Email:* </label>
                  <input type="email" class="form-control" name="email" placeholder="" value=" {{ Auth::user()->email }} " readonly>
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
                  <label for="">Direccion:* </label>
                  <input type="direccion" class="form-control" name="direccion" placeholder="" value="{{old('direccion')}}" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-5">
                <div class="form-group">
                  <label for="">Sexo:* </label>
                  <select class="form-control" name="sexo" value="" >
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
                <label class="text text-center"><strong>Categorias</strong></label>
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
              <label for="">Empresa: </label>
              <select name="empresa_id" class="form-control">
                @foreach ($empresas as $em)
                  <option value="{{$em->id}}">{{$em->name}}</option>
                @endforeach
              </select>
                </div>
            </div>
          </div>

          <hr>
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-10 col-md-offset-1">
              {!! csrf_field()!!} <!-- funcion para el token -->
              <button type="submit" class="btn btn-success  btn-block">Finalizar</button>
            </div>
          </div>
          <br>
      </form>
    </div>


    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @include('layouts.validaciones')
  </body>

</html>
