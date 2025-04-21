@extends('layouts.mainMenu')

@section('content')

<div class="Container">
  <section class="titulo row">
    <article class="col-xs-12 col-sm-12 col-md-12">
      <h1 class="text-center">Listado de Localidades</h1>
    </article>
    <div class="col-xs-12 col-sm-10 col-md-10 col-md-offset-1">
      @include('flash::message')
    </div>
  </section>
</div>
<br>
<div class="row">
	<div class=" form-group">
	  	<div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-1">
	   		<a href="{{route('main.createCiudad')}}" class="btn btn-info">Agregar nueva Localidad</a>
	  	</div>
		<!-- Aca empieza el formulario de busqueda-->
		<form class="" method="GET" action="{{route('main.indexLocalidades')}}" role="search" >
			@include('fragment.searchForm')
		</form>
	</div>
</div>
<br>
<!-- Aca empieza todo lo que es el formulario-->
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
	<div class="table-responsive">
	    <table class="table table-hover">
	      <thead class="">
	        <td class="active text-center"><strong>Cod. Pos.</strong></td>
	        <td class="active text-center"><strong>Nombre</strong></td>
	        <td class="active text-center"><strong>Provincia</strong></td>
	        <td class="active text-center"><strong>Pais</strong></td>
	        
	      </thead>
	      <tbody>
	        @foreach ($ciudades as $ciudad)
	          <tr>
	          	<td class = "success text-center">{{$ciudad->cp}}</td>
	            <td class = "success text-center">{{$ciudad->name}}</td>
	            <td class = "success text-center">{{$ciudad->provincia->name}}</td>
	            <td class = "success text-center">{{$ciudad->provincia->pais->name}}</td>
				<!--
	            <td class = "success text-right" title="VER LOCALIDAD">
	              <a href="#" class="btn btn-info btn-xs">
	                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
	              </a>
	            </td>
	            <td class = "success text-center" title="EDITAR LOCALIDAD">
	              <a href="#" class="btn btn-warning btn-xs" onclick="return confirm('Vamos a Editar?')">
	                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
	              </a>
	            </td>
	        	
	            <td class = "success text-center" title="ELIMINAR LOCALIDAD">
	              <form action="#" method="">
	              	{{ csrf_field() }}  	
	              	<button  class="btn btn-danger btn-xs" onclick="return confirm('Realmente desea eliminar la cancha?')">
	                <span class=" glyphicon glyphicon-remove" aria-hidden="true"></span>
	                <input type="hidden" name="_method" value="DELETE">
	              	</button>
	              </form>
	            </td>
	            -->
	          </tr>
	        @endforeach
	      </tbody>
	    </table>
	</div>
    <div class="text-center">
      {!!$ciudades->render()!!}
    </div>
  </div>
</div>

@endsection