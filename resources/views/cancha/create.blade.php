@extends('layouts.mainMenu')

@section('content')

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 ">
      <div class="form-group">
        @include('fragment.msg')
        @include('fragment.error')
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <h2 class="text-center"><strong>Agregar nueva Cancha</strong></h2>
    </div>
  </div>

  <form class="form-group" method="POST" action="{{ route('cancha.store') }}" enctype="multipart/form-data">

  <hr>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
          <div class="form-group">
            <label for="">Codigo:* </label>
            <input type="text" maxlength="6" class="form-control" name="cod"  value="{{ old('cod') }}" required>
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label for="">Nombre:* </label>
            <input type="text" maxlength="20" class="form-control" name="name" style="text-transform: uppercase;" value="{{ old('name') }}" required>
          </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
        <div class="form-group">
            <label for="">Descripcion: </label>
            <textarea class="form-control" rows="5" name="descripcion" maxlength="120"></textarea>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <div class="form-group">
            <label for="">Ancho en centimetros:* </label>
            <input type="number" min="1" max="2000" step="0.1" class="form-control" name="ancho_cm" required="numeric"  value="{{ old('ancho_cm') }}">
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label for="">Largo en centimetro:* </label>
            <input type="number" min="1" max="2000" step="0.1" class="form-control" name="largo_cm" required="numeric"  value="{{ old('largo_cm') }}">
          </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2" >
          <div class="form-group">
            <label for="">Tipo de Deporte:* </label>
            <input type="text" maxlength="20" class="form-control" name="tipo" value="{{ old('tipo') }}" style="text-transform: uppercase;" required>
          </div>  
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 ">
        <div class="form-group">
          <label for="">Imagen de la Cancha</label>
          <input type="file" name="foto" id="foto" accept="image/*">
        </div>
      </div>
    </div>

    <hr/>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <a href="{{route('home')}}" class="btn btn-warning  btn-block"
        onclick ="return confirm('Desea cancelar la Accion?')"><b>SALIR</b></a>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        {!! csrf_field()!!} <!-- funcion para el token -->
        <button type="submit" class="btn btn-success  btn-block"><b>GUARDAR</b></button>
      </div>
    </div>
    <br>

</form>
@endsection