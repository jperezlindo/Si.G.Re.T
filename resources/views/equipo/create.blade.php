@extends('layouts.mainMenu')

@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="alert alert-info text-center">
        <h3 class="text-center"><strong>Crea tu Propio Equipo</strong></h3>
      </div>
      <hr>
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
  
  <form class="form-group" method="POST" action="{{ route('equipo.store') }}">
    
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
          <div class="form-group">
            <label for="">Nombre del Equipo:* </label>
            <input type="text" class="form-control" name="name" placeholder="" value="{{ old('user') }}" style="text-transform: uppercase;" required>
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label for="">Categoria:* </label>
            <select name="categoria_id" class="form-control" required>
              <option value="">Selecciones una Categoria</option>
              @foreach ($categorias as $categoria)
                <option value="{{$categoria->id}}"> 
                  {{$categoria->c_etario->name}} | {{$categoria->c_sexo->name}} | {{$categoria->c_categoria->name}} 
                </option>
              @endforeach
            </select>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
        <div class="form-group">
            <label for="">Descripcion: </label>
            <textarea class="form-control" rows="5" name="descripcion" style="text-transform: uppercase;"></textarea>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <div class="form-group">
          <a href="{{route('home')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          {!! csrf_field()!!} <!-- funcion para el token -->
          <button type="submit" class="btn btn-success  btn-block"><b>GUARDAR</b></button>
        </div>
      </div>
    </div>
  </form>
 
@endsection