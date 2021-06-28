<section class="inner-part">
	<h3  class="pb-2">Order Details</h3>
	<div class="divider"></div>
	@if (\Session::has('success'))
	    <div class="alert alert-success">
		    {!! \Session::get('success') !!}</li>
		</div>
	@endif
	<!-- inner part -->
	<form method="post">
		@csrf
		<div class="product">
			<!-- <div class="divider"></div> -->
			<div style="overflow-x: unset;" class="table-responsive">
				<table class="table table-bordered table-striped ">
					<thead>
						<tr>
							<th colspan="2">Order Info</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="row">
									<div class="col-sm-4">Name<span class="float-right">:</span></div>
									<div class="col-sm-8 overflow">{{ $record->order_name }}</div>
								</div>
								<div class="row">
									<div class="col-sm-4">Mobile<span class="float-right">:</span></div>
									<div class="col-sm-8 overflow">{{ $record->order_mobile }}</div>
								</div>
								<div class="row">
									<div class="col-sm-4">Email ID<span class="float-right">:</span></div>
									<div class="col-sm-8 overflow">{{ $record->order_email }}</div>
								</div>
								<div class="row">
									<div class="col-sm-4">Address<span class="float-right">:</span></div>
									<div class="col-sm-8 overflow">{{ $record->order_address }}</div>
								</div>
								<div class="row">
									<div class="col-sm-4">State<span class="float-right">:</span></div>
									<div class="col-sm-4 overflow">{{ $record->order_state }}</div>
									<div class="col-sm-2">City<span class="float-right">:</span></div>
									<div class="col-sm-2 overflow">{{ $record->order_city }}</div>
								</div>
							</td>
							<td>
								<div class="row">
									<div class="col-sm-4">Order ID<span class="float-right">:</span></div>
									<div class="col-sm-8 overflow">#{{ sprintf('BURG%06d', $record->order_id) }}</div>
								</div>
								<div class="row">
									<div class="col-sm-4">Order Date<span class="float-right">:</span></div>
									<div class="col-sm-8 overflow">{{ date('d / m / Y', strtotime($record->order_created_on)) }}</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>

				<h5 class="float-left mt-3">Products</h5>
				<table class="table table-bordered table-striped text-center">
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Image</th>
							<th>Item Description</th>
							<th>Price</th>
							<th>Qty</th>
							<th>Subtotal</th>
						</tr>
					</thead>
					<tbody>
						@php  $sn = $grandtotal = $totSubtotal = $totDiscount = 0; @endphp
						@foreach($record->order_products as $sh)
							@php
								$sn++;
								$rate   	= $sh->opro_price;
								$total 		= $rate * $sh->opro_qty;

								$totSubtotal    += $rate * $sh->opro_qty;
								$grandtotal 	+= $total;
							@endphp
						<tr>
							<td>{{ $sn }}</td>
							<td>
								<a href="javascript: return void()">
									<img style="width:60px;" src="{{ url('imgs/product/'.$sh->product->product_image_thumb) }}">
								</a>
							</td>
							<td>
								<a style="color:black;" href="{{ url('product-single/'.$sh->product_slug) }}">
									{{ $sh->product->product_name }} ({{ $sh->opro_price_qty }} {{ $sh->opro_unit }})
								</a>
							</td>
							<td>₹ {{ $rate }}</td>
							<td>{{ $sh->opro_qty }}</td>
							<td>₹ {{ $rate * $sh->opro_qty }}</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th colspan="5">TOTAL</th>
							<th>₹ {{ $totSubtotal }}</th>
						</tr>
					</tfoot>
				</table>

			</div>

		</div>
	</form>
</section>
