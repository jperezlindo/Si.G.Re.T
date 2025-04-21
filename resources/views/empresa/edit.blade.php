@extends('layouts.mainMenu')

@section('content')
  <!-- Aca empieza LA VALIDACION-->
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <h2 class="text-center"><strong>Editar datos de la Empresa</strong></h2>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
      <div class="form-group">
        @include('fragment.error')
      </div>
    </div>
  </div>
  
  <!-- Aca termina la validacion-->
  <!-- Aca empieza el formulario-->
  <form class="form-group" method="POST" action="{{ route('empresa.update', $emp->id)}}" enctype="multipart/form-data"> 
    <input  name="_method" type="hidden" value="PUT">
      <hr>
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
            <div class="form-group">
              <label for="">Nomre:* </label>
              <input type="text" class="form-control" name="name" placeholder="" value="{{$emp->name}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="form-group">
              <label for="">Razon Social:* </label>
              <input type="text" readonly class="form-control" name="razon_social" maxlength="36" value="{{$emp->razon_social}}">
            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2" >
            <div class="form-group">
              <label for="">CUIT:* </label>
              <input type="text" maxlength="13" class="form-control" name="cuit" value="{{$emp->cuit}}" readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4 ">
          <div class="form-group">
            <label for="">Email:* </label>
            <input type="text" class="form-control" name="email" placeholder="" value="{{$emp->email}}">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
          <div class="form-group">
            <label>Telefono: </label><span class="label label-danger" id="error_tel"></span>
            <input id="tel" type="text" max="15" class="form-control" name="tel" value="{{$emp->tel}}" onchange="val_tel()">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label>Celular: </label><span class="label label-danger" id="error_cel"></span>
            <input id="cel" type="text" max="15" class="form-control" name="cel" value="{{$emp->cel}}" onchange="val_cel()">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
          <div class="form-group">
              <label for="">Direccion:* </label>
              <input type="direccion" class="form-control" name="direccion" value="{{$emp->direccion}}" maxlength="145">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="form-group">
              <label for="">Rubro:* </label>
              <input type="text" class="form-control" name="rubro" value="{{$emp->rubro}}" maxlength="40">
            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
          <div class="form-group">
              <label for="">Ciudad: </label>
              <select class="form-control" name="ciudad_id" placeholder="Seleccionar la Ciudad" value="">
                @foreach ($ciudades as $ciudad)
                  <option value="{{$ciudad->id}}">{{$ciudad->name}}</option>
                @endforeach
              </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label for="">Logo</label>
            <input type="file" name="logo" id="logo" accept="image/*">
          </div>
        </div>
      </div>
      <hr>

      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
          <a href="{{route('home')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a><br>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
          <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#confirmarEmpresa"><b>GUARDAR</b></button>
          @include('empresa.confirmarEmpresa')
        </div>
      </div>
      <br>
  </form>
@endsection