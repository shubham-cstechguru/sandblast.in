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
			<h2 style="font-weight: normal;">A new wholesale enquiry recieved.</h2>
		</div>
		<div style="background: #f9f9f9; padding: 30px 15px; color: #333; font-size: 14px;">
			<div>
				Hi Admin,
			</div>
			<p style="text-align: justify;">Please find details as below.</p>

			<div style="margin: 30px 0; background: #fff; padding: 15px; border-radius: 5px;">
				<table border="1" cellspacing="0" cellpadding="10" style="border-color: #ccc; width: 100%;">
					<tr>
						<th style="text-align: left;">Name</th>
						<td>{{ $input['name'] }}</td>
					</tr>
					<tr>
						<th style="text-align: left;">Store Name</th>
						<td>{{ $input['store_name'] }}</td>
					</tr>
					<tr>
						<th style="text-align: left;">Phone No.</th>
						<td>{{ $input['phone'] }}</td>
					</tr>
					<tr>
						<th style="text-align: left;">Email</th>
						<td>{{ $input['email'] }}</td>
					</tr>
					<tr>
						<th style="text-align: left;">Country</th>
						<td>{{ $input['country'] }}</td>
					</tr>
					<tr>
						<th style="text-align: left;">Message</th>
						<td>{!! $input['message'] !!}</td>
					</tr>
				</table>
			</div>

			<p>&nbsp;<br>&nbsp;</p>
			<p>
				Thank you<br>
				Chitrani.com
			</p>
		</div>
	</div>
</body>
</html>
