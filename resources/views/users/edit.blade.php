@extends('layouts.mainMenu')

@section('content')
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
    @include('fragment.msg')
  </div>
</div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="alert alert-info text-center" role="alert">
        <h1><strong>EDITAR DATOS DEL USUARIO</strong></h1>
      </div>
    </div>
  </div>

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
    @include('fragment.error')
  </div>
</div>

<form class="form-group" method="POST" action="{{route('users.update', $us->id)}}" enctype="multipart/form-data"> 
    <input  name="_method" type="hidden" value="PUT">
    
    <div class="row">
      <div class="col-xs-12 col-sm-4 col-md-4 col-md-offset-4">
        <img width="200px" src="{{ Storage::url ($us->foto) }}" class="center-block img-responsive img-thumbnail user-imag" alt="Responsive image" alt="User Image">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-4 col-md-4 col-md-offset-5">
        <div class="form-group">
          <label for="">Foto de Perfil</label>
          <input type="file" name="foto" id="foto" accept="image/*">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
          <div class="form-group">
            <label for="">Usuario:* </label>
            <input type="text" class="form-control" name="user" maxlength="30" value="{{$us->user}}">
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label for="">D.N.I:* </label>
            <input type="number" class="form-control" name="dni" min="5000000" max="50000000" value="{{$us->dni}}" readonly>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2" >
          <div class="form-group">
            <label for="">Apellido:* </label>
            <input type="text" class="form-control" name="apellido" value="{{$us->apellido}}" style="text-transform: uppercase;" maxlength="30">
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 ">
        <div class="form-group">
          <label for="">Nombre:* </label>
          <input type="text" class="form-control" name="name" value="{{$us->name}}" style="text-transform: uppercase;" maxlength="30">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <div class="form-group">
            <label for="">Email:* </label>
            <input type="email" class="form-control" name="email" value="{{$us->email}}" style="text-transform: lowercase;" maxlength="50">
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label for="">Fecha de Nacimiento:* </label>
            <input type="date" class="form-control" name="fecha_nacimiento" required value="{{$us->fecha_nacimiento->toDateString()}}" min="1917-01-01" max="2015-12-31" >
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <div class="form-group">
            <label for="">Direccion:* </label>
            <input type="direccion" class="form-control" name="direccion" value="{{$us->direccion}}" style="text-transform: uppercase;" maxlength="250">
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label>Cel: </label><span class="label label-danger" id="error_cel"></span>
            <input id="cel" type="text" max="15" class="form-control" name="cel" value="{{$us->cel}}" onchange="val_cel()">
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <div class="form-group">
            <label for="">Sexo:* </label>
            <select class="form-control" name="sexo" value="" >
                <option value="{{$us->sexo}}">{{$us->sexo}}</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otros">Otros</option>
            </select>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="form-group">
            <label for="">Ciudad: </label>
            <select name="ciudad_id" class="form-control">
              <option value="{{$us->ciudad_id}}"> 
                {{$us->ciudad->name}} | {{$us->ciudad->provincia->name}} | {{$us->ciudad->provincia->pais->name}}
              </option>
              <hr/>
              @foreach ($ciudades as $ciudad)
                <option value="{{$ciudad->id}}"> 
                  {{$ciudad->name}} | {{$ciudad->provincia->name}} | {{$ciudad->provincia->pais->name}} 
                </option>
              @endforeach
            </select>
            <p>En el caso de no encontrarse su CIUDAD, comunicarse con el establecimiento.</p>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <div class="form-group">
          <label class="text text-center"><strong>Categorias</strong></label>
          <select class="form-control" name="categoria_id" required>
            @if($categoria)
              <option value="{{$categoria->id}}">
                {{$categoria->c_etario->name}} | {{$categoria->c_sexo->name}} | {{$categoria->c_categoria->name}}
              </option>
            @else
              <option value="">Seleccione una categoria</option>
            @endif
            @foreach ($categorias as $cat)
              <option value="{{$cat->id}}"> 
                {{$cat->c_etario->name}} | {{$cat->c_sexo->name}} | {{$cat->c_categoria->name}}  
              </option>
            @endforeach
          </select>
        </div>
      </div>
      
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
          <label class="text text-center"><strong>Rol del Usuario</strong></label>
          <select class="form-control" name="rol_id" required>
            <option value="{{$ue->rol_id}}">{{ $ue->rol->name }}</option>
            @if (Auth::user()->rol() == 1)
            @foreach ($roles as $rol)
              @if ($ue->rol_id <> $rol->id)
                <option value="{{$rol->id}}">{{ $rol->name }}</option>
              @endif
            @endforeach
            @endif
          </select>
        </div>
      </div>
    </div> 


    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
        <a href="{{route('home')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a><br>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        {!! csrf_field()!!} <!-- funcion para el token -->
        <input type="hidden" name="ue_id" value="{{$ue->id}}">
        <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#confirmarGuardado"><b>GUARDAR</b></button>
      </div>
    </div>
    <br>
     @include('users.modals.confirmarGuardado') 
</form>

@endsection