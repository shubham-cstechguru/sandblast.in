<section class="inner-part">

	<div class="row color">
		<div class="col">
			<!-- inner part -->
			<div class="row">
				<div class="col-sm-12">
					<h3  class="pb-2"> Coupons</h3>
						<div class="divider"></div>
				</div>
			</div>
			<div class="setting">
					<div class="row">
						<div class="col-sm-4">
							<form method="post" enctype="multipart/form-data">
								@csrf
								@if (\Session::has('success'))
								    <div class="alert alert-success">
									{!! \Session::get('success') !!}
									</div>
								@endif
								<div class="category">
									<h5>Basic Information</h5>
									<div class="divider mb-3"></div>
									<div class="form-group">
										<label>Coupon Code *</label>
										<input type="text" name="record[coupon_code]" value="{{ @$edit->coupon_code }}" placeholder="Coupon Code" class="form-control" autofocus="" required>
									</div>
									<div class="form-group">
										<label>Coupon Discount (in %) *</label>
										<input type="number" min="0" max="100" name="record[coupon_discount]" value="{{ @$edit->coupon_discount }}" placeholder="Coupon Discount" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Coupon Description</label>
										<input type="text" name="record[coupon_description]" value="{{ @$edit->coupon_description }}" placeholder="Coupon Description" class="form-control">
									</div>

									@php
										$inc_pros = $exl_pros = [];
										if(!empty($edit->coupon_include_products)) {
											$inc_pros = explode(",", $edit->coupon_include_products);
										}
										if(!empty($edit->coupon_exclude_products)) {
											$exl_pros = explode(",", $edit->coupon_exclude_products);
										}
									@endphp

									<div class="form-group">
										<label>Include Products</label>
										<select class="form-control active product" name="record[coupon_include_products][]" multiple>
											@foreach($products as $p)
											<option value="{{ $p->product_id }}" @if(in_array($p->product_id, $inc_pros)) selected @endif>{{ $p->product_name }}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<label>Exclude Products</label>
										<select class="form-control active product" name="record[coupon_exclude_products][]" multiple>
											@foreach($products as $p)
											<option value="{{ $p->product_id }}" @if(in_array($p->product_id, $exl_pros)) selected @endif>{{ $p->product_name }}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<input type="submit" value="Save" class="form-control btn btn-primary">
									</div>
								</div>
							</form>

						</div>
						<div class="col-sm-8">
					<form method="post" class="">
						@csrf
							<div class="category-list">
								<div class="heading">
									<h5>{{ $records->count() }} record(s) found</h5><a href="" class="icon-trash-o"></a>
								</div>
								<div class="divider"></div>
								@if(!$records->isEmpty())
								<table class="table table-bordered">
		                            <thead>
		                                <tr>
		                                    <th>
		                                        <label class="animated-checkbox">
		                                            <input type="checkbox" class="check_all">
		                                            <span></span>
		                                        </label>
		                                    </th>
		                                    <th>SN.</th>
											<th>Name</th>
											<th>Discount</th>
		                                    <th>Description</th>
											<th>Public</th>
		                                    <th>Actions</th>
		                                </tr>
		                            </thead>
		                            <tbody>
		                            	@php
		                            	 $sn = 0;
		                            	 @endphp
		                            	@foreach($records as $rec)
		                            		<tr>
		                            			<td>
													<label class="animated-checkbox">
				                                        <input type="checkbox" name="check[]" class="check" value="{{ $rec->coupon_id }}">
				                                        <span></span>
				                                    </label>
												</td>
												<td>{{ ++$sn }}</td>
												<td>{{ $rec->coupon_code }}</td>
												<td>{{ $rec->coupon_discount }} %</td>
												<td>{!! $rec->coupon_description !!}</td>
												<td>
													<a href="{{ url('rt-admin/coupon?status='.$rec->coupon_is_public.'&id='.$rec->coupon_id) }}" class="{{ $rec->coupon_is_public == 'Y' ? 'text-success': 'text-danger' }}">
														<i class="icon-circle"></i>
													</a>
												</td>
												<td>
													<a href="{{ url('rt-admin/coupon/'.$rec->coupon_id) }}" title="Edit" class="text-success">
			                                        	<i class="icon-pencil"></i>
			                                        </a>
												</td>
		                            		</tr>
		                            	@endforeach
		                            </tbody>
		                        </table>
		                        @else
								<div class="alert alert-danger text-center">
								  <i class="icon-thumb_down_alt"></i> No records found.
								</div>
								@endif
		                        <div>{{ $records->links() }}</div>
							</div>
				</form>
						</div>
					</div>

			</div>
		</div>
	</div>
</section>
	</div>
