<!DOCTYPE html>
<html>
<head>
	<title>{{ $subject }}</title>
</head>
<body>
	<div class="max-width: 800px; margin: 15px auto;">
		<h4>User Information</h4>
		<div style="overflow-x: auto; margin-bottom: 15px; padding: 15px; border: 1px solid #ccc; border-radius: 8px;">
			<table border="1" style="width: 100%;">
				<tr>
					<th>Name</th>
					<td>{{ $input['order_name'] }}</td>
				</tr>
				<tr>
					<th>Mobile No.</th>
					<td>{{ $input['order_mobile'] }}</td>
				</tr>
				<tr>
					<th>Email ID</th>
					<td>{{ $input['order_email'] }}</td>
				</tr>
				<tr>
					<th>Address</th>
					<td>{{ $input['order_address'] }}</td>
				</tr>
			</table>
		</div>

		<h4>Product Information</h4>
		<div style="overflow-x: auto; margin-bottom: 15px; padding: 15px; border: 1px solid #ccc; border-radius: 8px;">
			<table border="1" style="width: 100%;">
				<tr>
					<th>Name</th>
					<td>{{ $product->product_name }}</td>
				</tr>
				<tr>
					<th>Qty</th>
					<td>{{ $input['order_qty'] }}</td>
				</tr>
				<tr>
					<th>Image</th>
					<td><img src="{{ url('imgs/product/'.$product->product_image_medium) }}" alt="" style="width: 256px; height: 256px; object-fit: contain;"></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>
