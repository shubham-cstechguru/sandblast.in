@php
$title = DB::table('settings')->get();
$name = $title[0]->setting_title;
$fav = $title[0]->setting_favicon;
$logo = $title[0]->setting_logo;
@endphp

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<title>Admin Login | {{ $site->setting_title }}</title>

		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('icomoon/style.css') }}
		{{ HTML::style('admin/css/style.css') }}

		<link rel="icon" href="{{ url('imgs/'. $fav) }}">
	</head>
	<body>
		<section class="full-section">
			<div class="part_up"></div>
			<div class="part_down"></div>
			<div class="half-section"></div>
			<div class="login-form">
				<form id="loginForm" action="{{ url('rt-admin/ajax/user_login') }}" method="post">
					@csrf
					<div class="text-center form-group">
						<img class="login_img" src="{{ url('imgs/'. $logo) }}">
					</div>
					<div class="form-msg"></div>
					<div class="form-group">
						<input type="text" name="record[user_login]" class="form-control" placeholder="Username" required autofocus autocomplete="off">
					</div>
					<div class="form-group">
						<input type="password" name="record[user_password]" class="form-control" placeholder="Password" required autocomplete="new-password">
					</div>
					<div class="form-group">
						<button class="btn btn-success btn-block">Log Me In</button>
					</div>
				</form>
			</div>
		</section>

		{{ HTML::script('js/jquery.min.js') }}
		{{ HTML::script('js/popper.min.js') }}
	    {{ HTML::script('js/bootstrap.min.js') }}
	    {{ HTML::script('js/sweetalert.min.js') }}
	    {{ HTML::script('js/validation.js') }}
	    {{ HTML::script('admin/tinymce/js/tinymce/tinymce.min.js') }}
	    {{ HTML::script('admin/js/main.js') }}
	</body>
</html>