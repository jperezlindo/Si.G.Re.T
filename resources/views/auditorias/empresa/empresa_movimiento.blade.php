@extends('layouts.mainMenu')

@section('content')

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="alert alert-info text-center" role="alert">
        <h4><strong>INFORMACION DE MOVIMIENTO EN LA TABLA "EMPRESAS" POR USUARIO</strong></h4>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label><b>Usuario</b></label><br>
                <label><b>{{ $user->user }}</b></label><br>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label><b>Apellido</b></label><br>
                <label><b>{{ $user->apellido }}</b></label><br>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
              <div class="form-group text-left">
                <label><b>Nombre</b></label><br>
                <label><b>{{ $user->name }}</b></label><br>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
              <div class="form-group text-left">
                <label><b>Fecha y Hora</b></label><br>
                <label><b>{{ $auditoria->fecha_hora }}</b></label><br>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label><b>Accion</b></label><br>
                <label><b>{{ $auditoria->accion }}</b></label><br>
              </div>
            </div>
          </div>
          <hr>

          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <h5><label><b>CAMPO</b></label></h5>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <h4><label><b>DATOS ACTUALES</b></label></h4>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <h4><label><b>DATOS HISTORICO</b></label></h4>
              </div>
            </div>
          </div>
          <hr>
          
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label>Nombre</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$new_data['ID']}}</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$old_data['ID']}}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label>Razon Social</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$new_data['RAZON SOCIAL']}}</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$old_data['RAZON SOCIAL']}}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label>CUIT</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$new_data['CUIT']}}</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$old_data['CUIT']}}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label>Tel/Cel</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$new_data['TELEFONO']}}/{{$new_data['CELULAR']}}</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$old_data['TELEFONO']}}/{{$old_data['CELULAR']}}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label>email</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$new_data['EMAIL']}}</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$old_data['EMAIL']}}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label>Direccion</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$new_data['DIRECCION']}}</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$old_data['DIRECCION']}}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label>Rubro</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$new_data['RUBRO']}}</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <label>{{$old_data['RUBRO']}}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
              <div class="form-group text-left">
                <label>Logo</label>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <img width="200px" src="{{ Storage::url ($new_data['LOGO']) }}" class="left-block img-responsive img-rounded" alt="Responsive image">
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
              <div class="form-group text-left">
                <img width="200px" src="{{ Storage::url ($old_data['LOGO']) }}" class="left-block img-responsive img-rounded" alt="Responsive image">
              </div>
            </div>
          </div>
          <hr>

        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-7 col-md-offset-2">
      <a href="{{route('auditoria.empresa')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>      
    </div>
    <div class="col-xs-12 col-sm-6 col-md-1">
      <a href="{{route('auditoria.empresa.movimiento.pdf', $auditoria->id)}}" class="btn btn-danger btn-block"><b>PDF</b></a>      
    </div>
  </div>


@endsection