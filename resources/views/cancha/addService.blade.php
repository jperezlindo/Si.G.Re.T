@extends('layouts.mainMenu')

@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">  
        <div class="form-group">
        <div class="alert alert-info text-center">
          <h2><b>ASOCIAR LOS SERVICIOS A LAS CANCHAS</b></h2>
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


  <form class="form-group" method="POST" action="{{ route('cancha.storeService') }}" enctype="multipart/form-data">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
          <div class="form-group">
            <label for="">Seleccionar Cancha: </label>
            <select multiple class="form-control" name="cancha_id" required>
              @foreach ($canchas as $cancha)
                <option value="{{$cancha->id}}"> 
                  {{$cancha->name}}
                </option>
              @endforeach
            </select>
          </div>
      </div> 
      <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label for="">Seleccionar Servicio: </label>
            <select multiple class="form-control" name="servicio_id" required>
              @foreach ($servicioss as $servicio)
                <option value="{{$servicio->id}}"> 
                  {{$servicio->name}}
                </option>
              @endforeach
            </select>
          </div>
      </div>
    </div>
        
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <div class="form-group">
            <label class="form-inline text-center" for="">Precio del Servicio</label>
            <input type="number" min="0" class="form-control" name="precio" required="numeric"  value="{{ old('precio') }}">
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-">
        <div class="form-group">
          <div class="container">
            <label for="">Servicio Obligatorio?</label>
            <div class="radio">
              <label class="radio-inline"><input type="radio" name="requerido" id="" value="0" checked> No </label>
              <label class="radio-inline"><input type="radio" name="requerido" id="" value="1"> Si </label>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-2">
        <div class="container">
            <div class="form-group">
              <label for="">Se cobra por Hora?</label>
              <div class="radio">
                <label class="radio-inline"><input type="radio" name="xhr" id="" value="1" checked> Si </label>
                <label class="radio-inline"><input type="radio" name="xhr" id="" value="0"> No </label>
              </div>
          </div>
        </div>
      </div>
    </div>
      
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <a href="{{route('home')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 ">
        {!! csrf_field()!!} <!-- funcion para el token -->
        <button type="submit" class="btn btn-success  btn-block"></a><b>GUARDAR</b></button>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
        <div class="table-responsive">
          <!----Muestra los servicios disponibles para cada cancha------>
            <h4 class="text-center"><strong>Servicios disponibles por Cancha</strong></h4>
            <div class="form-group">
              <table class="table table-hover">
                <thead class="">
                  <td class="active text-left"><strong>Cancha</strong></td>
                  <td class="active text-left"><strong>Servicios Ofrecidos</strong></td>
                  <td class="active text-center"><strong>Cobro por Hora</strong></td>
                  <td class="active text-center"><strong>Obligatorio</strong></td>
                  <td class="active text-center"><strong>Precio</strong></td>
                  @if (Auth::user()->rol() == 1)
                   <td class="active text-center"><strong>Editar</strong></td>
                  @endif
                </thead>
                <tbody>
                @foreach ($canchas as $ca)
                  @php $a=1; @endphp
                  @foreach ($servicios as $servicio)
                  
                    <tr>
                      @if($ca->id == $servicio->cancha_id)
                        @if ($a)
                          @php $a=0; @endphp
                          <td class = "success text-left"><strong>{{$servicio->cancha->name}}</strong></td>
                        @else
                          <td class = "success text-left"></td>
                        @endif
                        <td class = "success text-left">{{$servicio->servicio->name}}</td>
                        @if ($servicio->xhr)
                          <td class = "success text-center">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                          </td>
                        @else
                          <td class = "success text-center">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                          </td>
                        @endif
                        @if($servicio->requerido == 1)
                          <td class = "success text-center">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                          </td>
                        @else
                          <td class = "success text-center">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                          </td>
                        @endif
                        <td class = "success text-right"><strong>$ {{$servicio->precio}}</strong></td>
                      @if (Auth::user()->rol() == 1)
                        <td class = "success text-center" title="EDITAR SERVICIO">
                      <a href="{{route('cancha.editService', $servicio->id)}}" class="btn btn-warning btn-xs">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                      </a>
                    </td>
                      @endif 
                      @endif
                    </tr>
                   
                  @endforeach
                @endforeach
                </tbody> 
              </table>
            </div>
        </div>
      </div>
    </div>
    
</form>
@endsection