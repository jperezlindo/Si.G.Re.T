@if(Session::has('success'))
	<b><div class="alert alert-success text-center">
		<button type="button" class="close" data-dismiss="alert">
			&times;
		</button>
		{{ Session::get('success') }}
	</div></b>
@endif

@if(Session::has('info'))
	<b><div class="alert alert-info text-center">
		<button type="button" class="close" data-dismiss="alert">
			&times;
		</button>
		{{ Session::get('info') }}
	</div></b>
@endif

@if(Session::has('warning'))
	<b><div class="alert alert-warning text-center">
		<button type="button" class="close" data-dismiss="alert">
			&times;
		</button>
		{{ Session::get('warning') }}
	</div></b>
@endif

@if(Session::has('danger'))
	<b><div class="alert alert-danger text-center">
		<button type="button" class="close" data-dismiss="alert">
			&times;
		</button>
		{{ Session::get('danger') }}
	</div></b>
@endif