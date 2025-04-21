@extends('layouts.mainMenu')

@section('content')

<div class="Container">
  <section class="titulo row">
    <article class="col-xs-12 col-sm-12 col-md-12">
      <h1 class="text-center">Listado de canchas</h1>
    </article>
    <div class="col-xs-12 col-sm-10 col-md-10 col-md-offset-1">
      @include('fragment.msg')
    </div>
  </section>
</div>
<br>
<div class="row">
	<div class=" form-group">
	  	<div class="col-xs-4 col-sm-12 col-md-4 col-xs-offset-3 col-md-offset-1">
	   		<a href="{{route('cancha.create')}}" class="btn btn-info"><b>NUEVA CANCHA</b></a>
	  	</div>
		<!-- Aca empieza todo lo que es el formulario de busqueda-->
		<form class="" method="GET" action="{{route('cancha.index')}}" role="search" >
			@include('fragment.searchForm')
		</form>
	</div>
</div>
<br>
<!-- Aca empieza la tabla-->
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
	<div class="table-responsive">
	    <table class="table table-hover">
	      <thead class="">
	        <td class="active text-center"><strong>Codigo</strong></td>
	        <td class="active text-center"><strong>Nombre</strong></td>
	        <td class="active text-center"><strong>Para</strong></td>
	        <td class="active text-center"><strong>Largo</strong></td>
	        <td class="active text-center"><strong>Ancho</strong></td>
	        <td class="active text-center" colspan="3"><strong>Acciones</strong></td>
	      </thead>
	      <tbody>
	        @foreach ($canchas as $ca)
	          <tr>
	          	<td class = "success text-center">{{$ca->cod}}</td>
	            <td class = "success text-center">{{$ca->name}}</td>
	            <td class = "success text-center">{{$ca->tipo}}</td>
	            <td class = "success text-center">{{$ca->largo_cm}}</td>
	            <td class = "success text-center">{{$ca->ancho_cm}}</td>
	            <td class = "success text-right">
	              <a href="{{ route('cancha.show', $ca->id)}}" class="btn btn-info btn-xs">
	                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
	              </a>
	            </td>
	            <td class = "success text-center">
	              <a href="{{ route ('cancha.edit', $ca->id)}}" class="btn btn-warning btn-xs" onclick="return confirm('Vamos a Editar?')")>
	                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
	              </a>
	            </td>
	            <td class = "success text-left">
	              <form action="{{ route('cancha.destroy', $ca->id)}}" method="POST">
	              	{{ csrf_field() }}  	
	              	<button  class="btn btn-danger btn-xs" onclick="return confirm('Realmente desea eliminar la cancha?')">
	                <span class=" glyphicon glyphicon-remove" aria-hidden="true"></span>
	                <input type="hidden" name="_method" value="DELETE">
	              	</button>
	              </form>
	            </td>
	          </tr>
	        @endforeach
	      </tbody>
	    </table>
	</div>
    <div class="text-center">
      {!!$canchas->render()!!}
    </div>
  </div>
</div>

@endsection