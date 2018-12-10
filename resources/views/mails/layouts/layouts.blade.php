<html>
<head>
	<title>@yield('title')NoReply</title>
	
	<script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
	<style>
		a.website_logo_link{
			color:inherit;

		}
		a.website_logo_link:hover{
			text-decoration: none;
			
		}
	</style>
		<nav class="navbar navbar-expand-md navbar-light navbar-laravel" align="center"><img class="img-responsive mr-2" src="{{ asset('img/system/website_logo_2.png') }}" width="100"><div class="nav-item float-right" ><a class="website_logo_link" href="{{ url('/') }}"><h1 class="h1" align="center">{{ config('app.name') }}</h1></a></div></nav>
		<div class="m-5 "width="50%">
			@yield('center')
		</div>
	<style>
	.footer {
		position: fixed;
		left: 0;
		bottom: 0;
		width: 100%;		
		text-align: center;
	}
</style>

<div class="alert-info mt-3" align="center">
	<div >Created By : {{ config('app.name') }}</div>
	<div >Website : <a class="color-" href="{{ url('/') }}">{{ url('/') }}</a></div>
</div>

</body>
{{-- bootstrap theme for laravel --}}
{{-- css for the mail --}}
<style>
	@include('mails/assets/app_css');
</style>
</html>