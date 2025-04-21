@extends('layouts.mainMenu')

@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">  
        <div class="form-group">
        <div class="alert alert-info text-center">
          <h2><b>EDITAR SERVICIOS ASOCIADOS</b></h2>
        </div>
          </div>
      </div>
    </div>
    <div class="row">
    <div class="col-xs-12 col-sm-10 col-md-8 col-md-offset-2">
      @include('fragment.msg')
      @include('fragment.error')
    </div>
  </div>


  <form class="form-group" method="POST" action="{{ route('cancha.updateService') }}">
    
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
          <div class="form-group">
            <label for="">Cancha: </label>
            <input type="text" class="form-control" value="{{$cs->cancha->name}}" readonly>
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label for="">Servicio</label>
            <input type="text" class="form-control" value="{{$cs->servicio->name}}" readonly>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
          <div class="form-group">
            <label for="">¿Se cobra por Hora?: </label>
            <select class="form-control" name="xhr" required>
              @if ($cs->xhr)
                <option value="1">SI</option>
                <option value="0">NO</option>
              @else
                <option value="0">NO</option>
                <option value="1">SI</option>
              @endif
            </select>
          </div>
      </div> 
      <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label for="">¿Es Obligatorio?: </label>
            <select class="form-control" name="requerido" required>
              @if ($cs->requerido)
                <option value="1">SI</option>
                <option value="0">NO</option>
              @else
                <option value="0">NO</option>
                <option value="1">SI</option>
              @endif
            </select>
          </div>
      </div>
    </div>
        
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <div class="form-group">
            <label>Precio del Servicio</label>
            <input type="number" min="0" class="form-control text-right" name="precio" required="numeric"  value="{{$cs->precio}}">
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label for="">Activo </label>
            <select class="form-control" name="activo" required>
              @if ($cs->activo)
                <option value="1">SI</option>
                <option value="0">NO</option>
              @else
                <option value="0">NO</option>
                <option value="1">SI</option>
              @endif
            </select>
          </div>
      </div>
    </div>
      
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <a href="{{route('cancha.addService')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 ">
        {!! csrf_field()!!} <!-- funcion para el token -->
        <input type="hidden" name="cs_id" value="{{$cs->id}}">
        <button type="submit" class="btn btn-success  btn-block"></a><b>GUARDAR</b></button>
      </div>
    </div>   
</form>
@endsection