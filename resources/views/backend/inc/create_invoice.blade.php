<div class="container-fluid">
		<div class="">
</div>
<section class="inner-part">
	<div class="row color">
		<div class="col">
			<!-- inner part -->
			<div class="row">
				<div class="col-sm-12">
					<h3  class="pb-2">Create Invoice</h3>
					<div class="divider"></div>
				</div>
			</div>
			<div class="setting">
					<div class="row">
						<div class="col-sm-8">
							<form method="post" enctype="multipart/form-data">
							@csrf
								@if (\Session::has('success'))
								    <div class="alert alert-success">
									{!! \Session::get('success') !!}
									</div>
								@endif
								@if (\Session::has('danger'))
								    <div class="alert alert-danger">
									{!! \Session::get('danger') !!}
									</div>
								@endif
								<div class="category">
									<h3 class="card-title">Basic Information</h3>
									<div class="divider mb-3"></div>
									<div class="form-group">
										<label>Invoice No. *</label>
										<input type="text" name="record[order_invoice_no]" value="{{ $invoice_no }}" class="form-control">
									</div>

									<div class="form-group">
										<label>Notes *</label>
										<textarea name="record[order_notes]" rows="10" class="form-control">@php
											echo "WE INTEND TO CLAIM REWARDS UNDER MERCHANDISE EXPORT FROM INDIA SCHEME (MIES).".PHP_EOL;
											echo "SUPPLY MEANT FOR EXPORT UNDER BOND OR LETTER OF UNDERTAKING WITHOUT PAYMENT OF INTEGRATED TAX".PHP_EOL;
										@endphp</textarea>
									</div>
								</div>
								</div>
								<div class="col-sm-4">
									<div class="category">
										<div class="form-group">
											<input type="submit" value="@if(!empty(@$edit->post_image)) Update @else Save @endif" class="form-control btn btn-primary">
										</div>
										<hr>
										<h4>Order Info</h4>
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<th>Order ID</th>
													<td>{{ sprintf('#CHT%06d', $order_info->order_id) }}</td>
												</tr>
												<tr>
													<th>Amount</th>
													<td>{{ $order_info->order_amount }}</td>
												</tr>
												<tr>
													<th>Date</th>
													<td>{{ date('d / m / Y', strtotime( $order_info->order_created_on ) ) }}</td>
												</tr>
												<tr>
													<th>Order Status</th>
													<td>{{ $order_info->order_status }}</td>
												</tr>
												<tr>
													<th>Order Pay Status</th>
													<td>{{ $order_info->order_is_paid }}</td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</form>
					</div>

			</div>
		</div>
	</div>
</section>
	</div>
