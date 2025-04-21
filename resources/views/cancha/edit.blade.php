@extends('layouts.mainMenu')

@section('content')
  
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
      <h2 class="text-center"><strong>Modificar datos de la Cancha</strong></h2>
    </div>
    <div class="col-xs-12 col-sm-10 col-md-10 col-md-offset-2">
      @include('fragment.msg')
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
      <div class="form-group">
        @include('fragment.error')
      </div>
    </div>
  </div> 

  <form class="form-group" method="POST" action="{{ route('cancha.update', $cancha->id) }}" enctype="multipart/form-data">
  
    <input  name="_method" type="hidden" value="PUT">
    <div class="row">
      <div class="col-xs-12 col-sm-4 col-md-4 col-md-offset-4">
        <img width="200px" src="{{ Storage::url ($cancha->foto) }}" class="center-block img-responsive img-thumbnail user-imag" alt="Responsive image" alt="User Image">
        * Datos Obligatorios
      </div>
    </div>
    <hr>
    
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <div class="form-group">
          <label for="">Codigo:* </label>
          <input type="text" class="form-control" name="cod" maxlength="6" value="{{ $cancha->cod }}" readonly>
        </div>  
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label for="">Nombre:* </label>
            <input type="text" class="form-control" name="name" maxlength="20" value="{{ $cancha->name }}" required>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <div class="form-group">
            <label for="">Ancho en centimetros:* </label>
            <input type="number" min="1" max="2000" step="0.1" class="form-control" name="ancho_cm" value="{{ $cancha->ancho_cm }}" required>
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label for="">Largo en centimetro:* </label>
            <input type="number" min="1" max="2000" step="0.1" class="form-control" name="largo_cm" value="{{ $cancha->largo_cm }}" required>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
        <div class="form-group">
            <label for="">Descripcion: </label>
            <textarea class="form-control" rows="5" name="descripcion" value="">{{ $cancha->descripcion }}</textarea>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2" >
          <div class="form-group">
            <label for="">Tipo de Deporte:* </label>
            <input type="text" class="form-control" name="tipo" maxlength="20" value="{{ $cancha->tipo }}" required>
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
        <a href="{{route('cancha.index')}}" class="btn btn-warning  btn-block"
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