<div class="custom-alert-wrapper">
	@if(count($errors) > 0)
	@foreach($errors->all() as $error)
	<div class="alert alert-danger custom-alert-box">
		{{$error}}
	</div>
	@endforeach
	@endif

	@if(session('success'))
	<div class="alert alert-success custom-alert-box" id="success">
		{{session('success')}}
	</div>
	@endif

	@if(session('error'))
	<div class="alert alert-danger custom-alert-box" id="error">
		{{session('error')}}
	</div>
	@endif
</div>
<script language="JavaScript" type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script>
	$(".alert").delay(5000).fadeOut();
	$("#success").delay(5000).fadeOut();
</script>