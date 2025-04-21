@php $a=1; $instancia = 0; @endphp
@foreach ($partidos as $partido)
	
	@if ($instancia <> $partido->instancia_id) @php $instancia = $partido->instancia_id; @endphp
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
			<div class="form-group">
				<h2><div class="alert alert-info" role="alert">FASE: {{ $partido->instancia->name }}</div></h2>
			</div>
		</div>
	</div>
	@endif
	
	@if ($partido->finalizado)
		@php $bt = 'primary' @endphp 
	@else 
		@php $bt = 'success' @endphp 
	@endif
	@if ($a) @php $a=0; $id_ins = $partido->instancia_id @endphp
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-2">
				<div class="form-group text-center">
					<a href="{{ route('partido.create', $partido->id)}}" type="button" class="btn btn-{{$bt}} btn-block btn-lg">
						<b>{{ $partido->name }}</b></a>
				</div>
			</div>
	@else @php $a=1; @endphp
			<div class="col-xs-12 col-sm-12 col-md-4">
				<div class="form-group text-center">
					<a href="{{ route('partido.create', $partido->id)}}" type="button" class="btn btn-{{$bt}} btn-block btn-lg">
						<b>{{ $partido->name }}</b></a>
				</div>
			</div>
		</div>
	@endif


@endforeach