<section class="inner-part">
	<div class="row color">
		<div class="col">
			<h3 class="pb-2">View Orders</h3>
			<div class="divider"></div>
			<div class="content-part">
				<!-- <form>
					@csrf
					<div class="product mb-3">
						<div class="row">
							<div class="col-sm-3">
								<label>Order Status</label>
								<select class="form-control" name="search[order_status]">
									<option value="">Order Status</option>
									<option value="processing" @if(@$search['order_status'] == "processing") selected @endif>processing</option>
									<option value="shipped" @if(@$search['order_status'] == "shipped") selected @endif>shipped</option>
									<option value="cancelled" @if(@$search['order_status'] == "cancelled") selected @endif>cancelled</option>
									<option value="refund" @if(@$search['order_status'] == "refund") selected @endif>refund</option>
									<option value="delivered" @if(@$search['order_status'] == "delivered") selected @endif>delivered</option>
								</select>
							</div>
							<div class="col-sm-3">
								<label>Pay Status</label>
								<select class="form-control" name="search[order_is_paid]">
									<option value="">Order Status</option>
									<option value="Y" @if(@$search['order_is_paid'] == "Y") selected @endif>Yes</option>
									<option value="N" @if(@$search['order_is_paid'] == "N") selected @endif>No</option>
								</select>
							</div>
							<div class="col-sm-2">
								<label>&nbsp;</label>
								<button type="submit" class="btn btn-primary btn-block">Search</button>
							</div>
						</div>
					</div>
				</form> -->

				@if (\Session::has('success'))
				    <div class="alert alert-success">
					    {!! \Session::get('success') !!}</li>
					</div>
				@endif
				<form method="post">
					@csrf
					<div class="product">
						<div class="heading d-block">
							@if(!$records->isEmpty())
							<!-- <select name="order_status" class="order_status_change float-right" style="width: 150px;">
								<option value="">Select Status</option>
								<option value="processing">processing</option>
								<option value="shipped">shipped</option>
								<option value="cancelled">cancelled</option>
								<option value="refund">refund</option>
								<option value="delivered">delivered</option>
							</select> -->
							@endif
							<h5>{{ $records->total() }} record(s) found</h5>
						</div>
						<div class="divider"></div>
						@if(!$records->isEmpty())
						<div class="table-responsive">
							<table class="table table-bordered table-striped text-center">
								<thead>
									<tr>
										<th>
											<label class="animated-checkbox">
												<input type="checkbox" class="check_all">
												<span></span>
											</label>
										</th>
										<th>SN.</th>
										<th>Order Id</th>
										<th>Name</th>
										<th>Mobile</th>
										<th>Email</th>
										<th>Message</th>
										<th>Status</th>

									</tr>
								</thead>
								<tbody>
									@php $sn = $records->firstItem() - 1; @endphp
									@foreach($records as $rec)
										@php

										$billing  = @unserialize( html_entity_decode( $rec->order_billing ) );
										$shipping = @unserialize( html_entity_decode( $rec->order_shipping ) );

										@endphp
									<tr>
										<td>
											<label class="animated-checkbox">
												<input type="checkbox" name="check[]" class="check" value="{{ $rec->order_id }}">
												<span></span>
											</label>
										</td>
										<td>{{ ++$sn }}.</td>
										<td><a href="{{ url('rt-admin/order/single/'.$rec->order_id) }}" class="">{{ sprintf("#BURG%06d",$rec->order_id) }}</a></td>
										<td>{{ $rec->order_name }}</td>
										<td><a href="tel: {{ $rec->order_mobile }}">{{ $rec->order_mobile }}</a></td>
										<td><a href="mailto: {{ $rec->order_email }}">{{ $rec->order_email }}</a></td>
										<td style="white-space: nowrap;  overflow: hidden; min-width: 5ch;  max-width: 25ch; text-overflow: ellipsis; text-align: left;">{{ $rec->order_enquiry }}</td>
										<td><a class="@if($rec->order_status == 'pending') text-danger @elseif($rec->order_status == 'complete') text-success @endif" href="javascript:void(0)" onclick=changestatus({{ $rec->order_id }})> <i class="icon-circle"></i> </a></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						@php
							$base_url  = url('rt-admin/orders');
							$get_param = request()->input();
							if(isset($get_param['page'])) {
								unset($get_param['page']);
							}
						@endphp
						{{ $records->appends($get_param)->links() }}
						@else
						<div class="alert alert-warning text-center"> <i class="icon-thumbs-o-down"></i> No records found.</div>
						@endif
					</div>
				</form>
			</div>
		</div>
</div>
</section>
