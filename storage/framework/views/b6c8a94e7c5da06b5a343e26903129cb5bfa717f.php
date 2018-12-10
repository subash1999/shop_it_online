<!DOCTYPE html>
<html>
<head>
	<title>Hello there</title>
	<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
	<link rel="stylesheet" type="text/css" href="css/app.css">
	<script src="<?php echo e(asset('js/app.js')); ?>"></script>
</head>
<body>
	<form action="<?php echo e(url('practice_controller')); ?>">
		<div name="option_group[1]" class="form-group">
			Name : 
			<input type="text" name="option_group[1][name]">
			Class : 
			<input type="text" name="option_group[1][class]">			
		</div>
		<div name="option_group[3]" class="form-group">
			Name : 
			<input type="text" name="option_group[3][name]">
			Class : 
			<input type="text" name="option_group[3][class]">			
		</div>
		<div name="option_group[2]" class="form-group">
			Name : 
			<input type="text" name="option_group[2][name]">
			Class : 
			<input type="text" name="option_group[2][class]">			
		</div>	
		<div class="form-group">
			<input type="text" name="form" class="form-control is-invalid" required value="apple">
		</div>
		<div class="form-group">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#home">Home</a></li>
				<li><a href="#menu1">Menu 1</a></li>
				<li><a href="#menu2">Menu 2</a></li>
				<li><a href="#menu3">Menu 3</a></li>
			</ul>

			<div class="tab-content">
				<div id="home" class="tab-pane fade show active">
					<h3>HOME</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				</div>
				<div id="menu1" class="tab-pane fade">
					<h3>Menu 1</h3>
					<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				</div>
				<div id="menu2" class="tab-pane fade">
					<h3>Menu 2</h3>
					<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
				</div>
				<div id="menu3" class="tab-pane fade">
					<h3>Menu 3</h3>
					<p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
				</div>
			</div>

		</div>
		<input type="submit" name="submit">		
	</form>
	<hr>
	<input type="radio" name="name" class="m-3 form-check" value="1" id="input">

	<input type="radio" name="name" class="m-3 form-check" value="2">

	<input type="radio" name="name" class="m-3 form-check" value="3">

	<input type="radio" name="name" class="m-3 form-check" value="4">
	<script type="text/javascript">
		$('input[name="name"]').change(function () {
			// var val = $('input:radio[name="name"]').filter(":checked");
			alert($('#input').val());
		});
		console.log($('input').filter('[required]').val());
		$(".nav-tabs a").click(function(){
			$(this).tab('show');
		});
	</script>
</body>
</html>