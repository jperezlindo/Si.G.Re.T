
@extends('layouts.mainMenu')

@section('content')
  
	<div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">  
        	<div class="form-group">
		        <div class="alert alert-info text-center">
		          <h1><b>RESERVA EN   
					<span class="success">{{$empresa->name}}</span></b></h1>
		        </div>
          	</div>
     	 </div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-md-4 col-md-offset-4">
			@include('fragment.msg')
			@include('fragment.error')
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
			<a href="{{route('reserva.index')}}" type="button" class="btn btn-primary btn-lg btn-block"><b>INICIAR RESERVA</b></a>
		</div>
	</div>
	<hr>
    <div class="row">
      	<div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2">
			@include('servicio.tableServicios')
		</div>
	</div>

@endsection
