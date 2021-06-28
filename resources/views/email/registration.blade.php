<!DOCTYPE html>
<html>
<head>
	<title>{{ $subject }}</title>
</head>
<body>
	<div style="max-width: 500px; margin: 15px auto; border: 1px solid #ccc; font-family: Arial;">
		<div style="background: #fff; padding: 20px 15px; text-align: center">
			<img src="{{ url('imgs/Chitrani-Logo.png') }}" alt="">
		</div>
		<div style="background: #79e6cf; padding: 15px;">
			<h2 style="font-weight: normal;">Thank you for joining us.</h2>
		</div>
		<div style="background: #f9f9f9; padding: 30px 15px; color: #333; font-size: 14px;">
			<div>
				Hi {{ $input['user_name'] }},
			</div>
			<p style="text-align: justify;">You're about to complete your registration process, please click on verify button or go through the verification link to verify your email address.</p>

			<div style="margin: 30px 0;">
				<a href="{{ url('user/verification/?key='.md5($id)) }}" style="display: inline-block; color: #fff; background: #05d6ac; text-decoration: none; padding: 10px 40px;">Verify Email</a>
			</div>

			<p>Or go to below verification link</p>

			<p><a href="{{ url('user/verification/?key='.md5($id)) }}" style=" color: #05d6ac; text-decoration: none;">{{ url('user/verification/?key='.md5($id)) }}</a></p>

			<p>&nbsp;<br>&nbsp;</p>
			<p>
				Thank you<br>
				Chitrani.com
			</p>
		</div>
	</div>
</body>
</html>
