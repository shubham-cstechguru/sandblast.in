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
			<h2 style="font-weight: normal;">Thank you for your order.</h2>
		</div>
		<div style="background: #f9f9f9; padding: 30px 15px; color: #333; font-size: 14px;">
			<div>
				Hi {{ $billing['name'] }},
			</div>
			<p style="text-align: justify;">Just to let you know — we've received your order {{ $order_no }}, and it is now being processed. Your order summary as follows:</p>
			<p style="font-size: 18px; color: #79e6cf;"><strong>Order <mark style="background: transparent; color: #79e6cf;">{{ $order_no }}</mark> (<mark style="background: transparent; color: #79e6cf;">{{ date('l F d, Y', time()) }}</mark>)</strong></p>

			<div style="background: #fff; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px;">
				<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-color: #ccc;">
					<thead>
						<tr>
							<th style="text-align: left;">Product Details</th>
							<th style="text-align: left;">Qty</th>
							<th style="text-align: left;">Price</th>
						</tr>
					</thead>
					<tbody>
						@php
							$total = 0;
						@endphp
						@foreach($oproducts as $opro)
							@php
								$subtotal = $opro->opro_price * $opro->opro_qty;
								$total 	 += $subtotal;
							@endphp
							<tr>
								<td>{{ $opro->product_name }}</td>
								<td>{{ $opro->opro_qty }}</td>
								<td>{{ $currency.' '.$subtotal }}</td>
							</tr>
						@endforeach
						<tr>
							<th style="text-align: left;" colspan="2">Subtotal</th>
							<td>{{ $currency.' '.$total }}</td>
						</tr>
						@if(!empty($order_info->order_discount))
							@php
								$total -= $order_info->order_discount;
							@endphp
						<tr>
							<th style="text-align: left;" colspan="2">Discount</th>
							<td>- {{ $currency.' '.$order_info->order_discount }}</td>
						</tr>
						@endif
						<tr>
							<th style="text-align: left;" colspan="2">Shipping</th>
							<td>Free shipping</td>
						</tr>
						<tr>
							<th style="text-align: left;" colspan="2">Payment Method</th>
							<td>{{ $order_info->order_currency == "INR" ? 'Razorpay' : '2Checkout Pay' }}</td>
						</tr>
						<tr>
							<th style="text-align: left;" colspan="2">Total</th>
							<td>{{ $currency.' '.$total }}</td>
						</tr>
						@if(!empty($order_info->order_message))
						<tr>
							<td colspan="2"><strong>Customer Notes</strong><br>{!! $order_info->order_message !!}</td>
						</tr>
						@endif
					</tbody>
				</table>
			</div>
			<div style="background: #fff; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px;">
				<table border="1" cellspacing="0" cellpadding="10" style="width: 100%; border-color: #ddd;">
					<tr>
						<th style="text-align: left;">Billing Address</th>
						<th style="text-align: left;">Shipping Address</th>
					</tr>
					<tr>
						<td>
							{{ $billing['name'] }}<br>
							{{ $billing['address1'] }}<br>
							{{ $billing['address2'].' '.$billing['city'].' '.$billing['state'].' '.$billing['postcode'] }}<br>
							{{ $billing['country'] }}<br>
							{{ $billing['phone'] }}<br>
							{{ $billing['email'] }}
						</td>
						<td>
							{{ $shipping['name'] }}<br>
							{{ $shipping['address1'] }}<br>
							{{ $shipping['address2'].' '.$shipping['city'].' '.$shipping['state'].' '.$shipping['postcode'] }}<br>
							{{ $shipping['country'] }}<br>
							{{ $shipping['phone'] }}<br>
							{{ $shipping['email'] }}
						</td>
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
