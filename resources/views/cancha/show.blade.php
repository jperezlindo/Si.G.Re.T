@extends('layouts.mainMenu')

@section('content')
  
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <h2 class="text-center"><strong>Datos de la Cancha</strong></h2>
    </div>
  </div> 

  <div class="row">
    <div class="col-xs-12 col-sm-4 col-md-4 col-md-offset-4">
      <img width="200px" src="{{ Storage::url ($cancha->foto) }}" class="center-block img-responsive img-thumbnail user-imag" alt="Responsive image" alt="User Image">
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <div class="form-group">
          <label for="">Codigo: </label>
          <input type="text" class="form-control" name="cod" value="{{ $cancha->cod }}" readonly>
        </div>  
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label for="">Nombre: </label>
          <input type="text" class="form-control" name="name" value="{{ $cancha->name }}" readonly>
        </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
      <div class="form-group">
          <label for="">Ancho en centimetros </label>
          <input type="text" class="form-control" name="ancho_cm" value="{{ $cancha->ancho_cm }}" readonly>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label for="">Largo en centimetro </label>
          <input type="text" class="form-control" name="largo_cm" value="{{ $cancha->largo_cm }}" readonly>
        </div>
    </div>
  </div>


  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="form-group">
          <label for="">Descripcion: </label>
          <textarea class="form-control" rows="5" name="descripcion" value="" readonly>{{ $cancha->descripcion }}</textarea>
      </div>
    </div>
  </div>

  <div class="row">  
    <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2" >
        <div class="form-group">
          <label for="">Tipo de Deporte: </label>
          <input type="text" class="form-control" name="tipo" value="{{ $cancha->tipo }}" readonly>
        </div>  
    </div>
  </div>
  
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="text-center">
        <h3><span class="label label-info"><b>Servicos Ofrecidos por la cancha</b></span></h3>
      </div>
      
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="">
            <td class="active text-center"><strong>Servicio</strong></td>
            <td class="active text-center"><strong>Precio</strong></td>
            <td class="active text-center"><strong>Cobro por Hora</strong></td>
            <td class="active text-center"><strong>Obligatorio</strong></td>
          </thead>
          @foreach ($cancha->cancha_servicio as $cs)
          <tbody>
            <tr>
              <td class = "success text-left"><b>{{$cs->servicio->name}}</b></td>
              <td class = "success text-right">$ <b>{{$cs->precio}}</b></td>
              @if ($cs->xhr)
                <td class = "success text-center">
                  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                </td>
              @else
                <td class = "success text-center">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </td>
              @endif
              @if($cs->requerido == 1)
                <td class = "success text-center">
                  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                </td>
              @else
                <td class = "success text-center">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </td>
              @endif
            </tr>
          </tbody>  
          @endforeach
        </table>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
      <hr>
      <a href="{{route('cancha.index')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>
    </div>
  </div>
@endsection