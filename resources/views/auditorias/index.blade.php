@extends('layouts.mainMenu')

@section('content')
  
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="alert alert-info text-center" role="alert">
			<h3><b>Si.G.Re.T AUDITORIA</b></h3>
		</div>
		<hr>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
	<form class="" method="GET" action="{{route('auditoria.index')}}" role="search" >
		<div class="col-xs-12 col-sm-12 col-md-4 input-group col-md-offset-8">
			<input class="form-control" type="text" name="buscar" placeholder="Busquemos..." aria-describedby= "search" autofocus>
			<span class="input-group-btn"><button type="submit" class="btn btn-info" ><span class="glyphicon glyphicon-search"></span></button></span> 
		</div>
	</form>
	</div>
</div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="table-responsive">
        <table class="table table-hover">
	        <thead class="">
	            <td class="active text-center"><strong>Nro.</strong></td>
	            <td class="active text-center"><strong>Nro. Mov.</strong></td>
	            <td class="active text-left"><strong>Tabla</strong></td>
				<td class="active text-left"><strong>Accion</strong></td>
				<td class="active text-left"><strong>Fecha y Hora</strong></td>
				<td class="active text-center"><strong>Ver</strong></td>
	        </thead>
	        <tbody>
	        @foreach ($movimientos as $i => $m)
	            <tr>
	            	<td class = "success text-center">{{$i + 1}}</td>
	            	<td class = "success text-center">{{$m->id}}</td>
	            	<td class = "success text-left">{{$m->tabla}}</td>
	            	<td class = "success text-left">{{$m->accion}}</td>
	            	<td class = "success text-left">{{$m->fecha_hora}}</td>
		            <td class = "success text-center" title="VER ACCION">
				      <a href="{{route('auditoria.show', $m->id)}}" class="btn btn-info btn-xs">
				        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
				      </a>
				    </td>
				</tr>
			@endforeach
			</tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
	<div class="text-center">
		{{$movimientos->render()}}
	</div>
</div>

@endsection