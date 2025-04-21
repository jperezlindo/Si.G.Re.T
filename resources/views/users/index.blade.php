@extends('layouts.mainMenu')

@section('content')


<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">	
    <div class="form-group">
    	<div class="alert alert-info text-center">
			<h1 class="text-center">Listado de Usuarios</h1>
		</div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-10 col-md-12">
    @include('fragment.msg')
  </div>
</div>

<br>
<div class="row">
	<div class=" form-group">
	  	<div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-1">
	   		<a href="{{route('users.create')}}" class="btn btn-primary btn-block"><b>NUEVO USUARIO</b></a><br>
	  	</div>
		<!-- Aca empieza todo lo que es el formulario de busqueda-->
		<form class="" method="GET" action="{{route('users.index')}}" role="search" >
			@include('fragment.searchForm')
		</form>
	</div>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
	<div class="table-responsive">
		<table class="table table-hover">
			<thead class="">
				<td class="active text-center"><strong>DNI</strong></td>
				<td class="active text-center"><strong>Apellido</strong></td>
				<td class="active text-center"><strong>Nombre</strong></td>
				<td class="active text-center" colspan="3"><strong>Acciones</strong></td>
			</thead>
			<tbody>
			@foreach ($usuarios as $us)
			
			  <tr>
			    <td class = "success text-center">{{$us->dni}}</td>
			    <td class = "success text-center">{{$us->apellido}}</td>
			    <td class = "success text-center">{{$us->name}}</td>
			    <td class = "success text-right" title="VER USUARIO">
			      <a href="{{route('users.show', $us->id)}}" class="btn btn-info btn-xs">
			        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
			      </a>
			    </td>
			    <td class = "success text-center" title="EDITAR USUARIO">
			      <a href="{{route('users.edit', $us->id)}}" class="btn btn-warning btn-xs">
			        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
			      </a>
			    </td>
			    <td class = "success text-left" title="DAR DE BAJA EL USUARIO">
			      <form action="{{route('users.destroy', $us->id)}}" method="POST">
			      	{{ csrf_field() }}
			 		<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" 
		            	data-target="#confirmarBaja_{{$us->id}}"><span class="glyphicon glyphicon-remove" aria-hidden="true" ></span></button>
		                @include('users.modals.confirmarBaja')  	
			      </form>
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
		<p>Total de Usuarios Registrados: <b>{{$total}}</b></p>
	</div>
</div>

@endsection