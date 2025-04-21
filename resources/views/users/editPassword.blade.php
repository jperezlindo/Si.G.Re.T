@extends('layouts.mainMenu')

@section('content')
  <!-- Aca empieza LA VALIDACION-->
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <h2 class="text-center"><strong>Cambiar Contraseña</strong></h2>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
      @include('fragment.msg')
    </div>
  </div>
  
  <!-- Aca empieza el formulario-->
<form class="form-group" method="POST" action="{{route('users.updatePass', Auth::user()->id)}}" enctype="multipart/form-data"> 
    <input  name="_method" type="hidden" value="PUT">
      <hr/>
      <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-md-offset-4">
          <div class="form-group has-success has-feedback">
            <label class="control-label" for="inputSuccess2">Ingrese su contraseña Actual</label>
            <input id="myPassword" type="password"  placeholder="my Password" class="form-control" name="myPassword" required autofocus>

          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-md-offset-4">
          <div class="form-group has-success has-feedback">
            <label class="control-label" for="inputSuccess2">Ingrese su nueva Contraseña</label>
            <input id="password" type="password"  placeholder="Password" class="form-control" name="password" required autofocus>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-md-offset-4">
          <div class="form-group has-success has-feedback">
            <label class="control-label" for="inputSuccess2">Confirme su nueva contraseña</label>
            <input id="password-confirm" type="password"  placeholder="Confirmacion de Password" class="form-control" name="password_confirmation" required autofocus>
          </div>
        </div>
      </div>
      
      <hr>
      
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
          <div class="form-group">
            @include('fragment.error')
          </div>
        </div>
      </div>
   
    <hr>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <a href="{{route('home')}}" class="btn btn-warning  btn-block" 
          onclick ="return confirm('Desea Cancelar la accion?')">Cancelar</a>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        {!! csrf_field()!!} <!-- funcion para el token -->
        <button type="submit" class="btn btn-success  btn-block"></a>Guardar</button>
      </div>
    </div>
    <br>
</form>
@endsection