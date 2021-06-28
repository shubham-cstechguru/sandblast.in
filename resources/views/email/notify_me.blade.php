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
			<h2 style="font-weight: normal;">{{ $subject }}</h2>
		</div>
		<div style="background: #f9f9f9; padding: 30px 15px; color: #333; font-size: 14px;">
			<div>
				Hi Admin,
			</div>

			<div style="margin-bottom: 30px;">
				Email: {{ $post['email'] }}
			</div>

			<p>Go to link to view product details:</p>
			<p><a href="{{ url('product'.$post['product_slug']) }}">{{ url('product'.$post['product_slug']) }}</a> </p>

			<p>&nbsp;<br>&nbsp;</p>
			<p>
				Thank you<br>
				Chitrani.com
			</p>
		</div>
	</div>
</body>
</html>
