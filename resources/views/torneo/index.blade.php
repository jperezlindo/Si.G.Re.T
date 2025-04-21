@extends('layouts.mainMenu')

@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-12">
      <div class="form-group">
        @include('fragment.msg')
        @include('fragment.error')
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
      <div class="alert alert-info text-center" role="alert">
      <h1 class="text-center"><strong>Torneos en {{Auth::user()->user_empresa->empresa->name}}</strong></h1>
      </div>
    </div>
  </div>

  @if ($torneos->isNotEmpty())
    @include('torneo.tablaTorneos')
  @else
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
        <div class="alert alert-info" role="alert">
          <h3 class="text-center"><strong>POR EL MOMENTO NO HAY TORNEOS ABIERTOS.</strong></h3>
        </div>
      </div>
    </div>
  @endif
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-10 col-md-offset-1">
      <hr>
      <a href="{{route('home')}}" class="btn btn-warning  btn-block"><b>SALIR</b></a>
    </div>
  </div>
@endsection