@extends('layouts.mainMenu')

@section('content')

<div class="Container">
  <section class="titulo row">
    <article class="col-xs-12 col-sm-12 col-md-12">
      <h1 class="text-center">Listado de Servicios</h1>
    </article>
    <div class="col-xs-12 col-sm-10 col-md-8 col-md-offset-2">
      @include('fragment.msg')
    </div>
  </section>
</div>
<br>
<div class="row">
	<div class=" form-group">
	  	<div class="col-xs-4 col-sm-12 col-md-4 col-xs-offset-3 col-md-offset-2">
	   		<a href="{{route('servicio.create')}}" class="btn btn-info"><b>NUEVO SERVICIO</b></a>
	  	</div>

	</div>
</div>
<br>
<!-- Aca empieza todo lo que es el formulario-->
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
	<div class="table-responsive">
	    <table class="table table-hover">
	      <thead class="">
	        <td class="active text-center"><strong>Servicio</strong></td>
	        <td class="active text-center" colspan="2"><strong>Acciones</strong></td>
	      </thead>
	      <tbody>
	        @foreach ($servicios as $se)
	          <tr>
	            <td class = "success text-center">{{$se->name}}</td>
				<!--
	            <td class = "success text-right" title="VER SERVICIO">
	              <a href=" ¨{route('servicio.show', $se->id)}}" class="btn btn-info btn-xs">
	                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
	              </a>
	            </td>
				-->
	            <td class = "success text-center" title="EDITAR SERVICIO">
	              <a href="{{ route ('servicio.edit', $se->id)}}" class="btn btn-warning btn-xs" >
	                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
	              </a>
	            </td>
	            <!-- Agregar condicion para que solo lo vea el admin-->
	            <td class = "success text-center" title="ELIMINAR SERVICIO">
	              <form action="{{ route('servicio.destroy', $se->id)}}" method="POST">
	              	{{ csrf_field() }}  	
	              	<button  class="btn btn-danger btn-xs" onclick="return confirm('Realmente desea eliminar el servicio?')">
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
      {!!$servicios->render()!!}
    </div>
  </div>
</div>
@endsection