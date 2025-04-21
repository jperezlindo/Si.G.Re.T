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
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">  
      <div class="form-group">
      <div class="alert alert-info text-center">
        <h2 class="text-center">Torneo: <strong>{{ $torneo->name }}</strong></h2>
      </div>
        </div>
    </div>
</div>


<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group text-center">
              <label for="">Desde:</label><br>
              <h4 for=""><b>{{$torneo->f_desde->format('d-m-Y')}}</b></h4>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group text-center">
              <label for="">Hasta:</label><br>
              <h4 for=""><b>{{$torneo->f_hasta->format('d-m-Y')}}</b></h4>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group text-center">
              <label for="">Inicia a las:</label><br>
              <h4 for=""><b>{{$torneo->hora}} hs. </b></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
    <h3 class="text text-center"><strong>Categorias Participantes</strong></h3>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead class="">
          <td class="active text-left"><strong>Inscrptos</strong></td>
          <td class="active text-left"><strong>Categoria</strong></td>
          <td class="active text-left"><strong>Tipo de Equipo</strong></td>
          <td class="active text-center" colspan="2"><strong>Acciones</strong></td>
        </thead>
        <tbody>
        @foreach ($categorias_t as $categoria)
          <tr>
            <td class = "success text-center">
              <span class="label label-danger"><b>{{$categoria->ins}}/{{ $categoria->cupo }}</b></span>
            </td>
            <td class = "success text-left">
              {{$categoria->categoria->c_etario->name}}-{{$categoria->categoria->c_sexo->name}}-{{$categoria->categoria->c_categoria->name}} 
            </td>
            @if ($categoria->n_ptes == 1)
              <td class = "success text-left">Single</td>
            @else
              <td class = "success text-left">Double</td>
            @endif
            <td class = "success text-right" title="VER FIXTURE">
              <a href="{{ route('fixture.show', $categoria->id) }} " class="btn btn-primary btn-xs">
                <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
              </a>
            </td>
            <td class = "success text-left" title="COMENZAR">
              <button type="button" class="btn btn-success btn-xs" data-toggle="modal" 
              data-target="#confirmacionInicio_{{$categoria->id}}">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span>
              </button>
                  @include('fixture.modals.confirmacionInicio')
            </td>
          </tr>
        @endforeach
        </tbody>  
      </table>
    </div>
  </div>
</div>

<hr>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="form-group text-center">
      <a href=" {{ route('torneo.index') }} " type="button" class="btn btn-warning btn-block"><b>Salir</b></a>
		</div>
	</div>

</div>

@endsection