<!DOCTYPE html>
<html>
<head>
	<meta name="_token" content="{{csrf_token()}}" />
    
	<title>Test </title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/jquery.min.js') }}"></script>
</head>
<body>
<form action="{{-- {{ URL::to('/admin/users/user_types/5') }} --}}" method="POST" role="form" id="form">
	@method('PUT')
	@csrf
	<div class="form-group">
		<label class="form-control-label" for="value">Input value : </label>
		<input type="text" name="value" class="form-control">
	</div>
	<input type="button" id="submit_btn" onclick="myfunction()" name="submit" value="Submit">
</form>
</body>
<script >
 window.url = "{{ URL::to("admin/users/user_types/1") }}";	
</script>

<script src="{{ asset('test.js') }}"></script>
</html>