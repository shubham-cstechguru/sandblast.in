<!-- city model -->
<div class="modal fade" id="add_city_post" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Add City</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="#" method="post" id="productCityForm">
				@csrf
				<div class="modal-body">
					<input type="hidden" value="" id="product_city_id" name="product_id">
					@if(!$city->isEmpty())
					@foreach($city as $ct)
					<div class="form-check form-check-inline" style="background:#ccc;padding: 10px;">
						<input class="form-check-input sub_chk" name="ids[]" type="checkbox" data-id="{{$ct->city_id}}" value="{{$ct->city_id}}">
						<label class="form-check-label" for="city{{$ct->city_id}}">{{$ct->city_name}}</label>
					</div>
					@endforeach
					@endif
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="add_city_to_post">Add City</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- city model end -->
<!-- country model -->
<div class="modal fade" id="add_country_post" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Add Country</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="#" method="post" id="productCountryForm">
				@csrf
				<div class="modal-body">
					<input type="hidden" value="" id="product_country_id" name="product_id">
					@if(!$country->isEmpty())
					@foreach($country as $ct)
					<div class="form-check form-check-inline" style="background:#ccc;padding: 10px;">
						<input class="form-check-input sub_chk" name="ids[]" type="checkbox" data-id="{{$ct->country_id}}" value="{{$ct->country_id}}">
						<label class="form-check-label" for="country{{$ct->country_id}}">{{$ct->country_name}}</label>
					</div>
					@endforeach
					@endif
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="add_country_to_post">Add Country</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- country model end -->

<section class="inner-part">
	<div class="row color">
		<div class="col">
			<h3 class="pb-2">View Products</h3>
			<div class="divider"></div>
			<div class="content-part">
				<form action="{{ route('productsearch') }}" method="POST" class="d-flex mb-2" style="width: 32%;">
					@csrf
					<input type="text" name="search" class="form-control" id="exampleInputsearch" value="{{ request('search') }}" placeholder="Search Product">
					<button type="submit" class="btn btn-primary">Search</button>
				</form>
				@if (\Session::has('success'))
				<div class="alert alert-success">
					{!! \Session::get('success') !!}</li>
				</div>
				@endif
				<form method="post">
					@csrf
					<div class="product">
						<div class="heading mb-3">
							<div class="mr-2">
								<h5>{{ $records->count() }} record(s) found</h5>
							</div>
							@if(!$records->isEmpty())
							<div class="ml-4">
								<a href="" class="icon-trash-o"></a>
							</div>
							@endif
						</div>
						<div class="divider"></div>
						@if(!$records->isEmpty())
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>
											<label class="animated-checkbox">
												<input type="checkbox" class="check_all">
												<span></span>
											</label>
										</th>
										<th>SN.</th>
										<th>Image</th>
										<th>Item Description</th>
										<th>Location</th>
										<th class="nowrap">Stock Qty</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@php $sn = $records->firstItem() - 1; @endphp
									@foreach($records as $rec)
									<tr @if(!$rec->product_is_read) class="bg-success" @endif>
										<td>
											<label class="animated-checkbox">
												<input type="checkbox" name="check[]" class="check" value="{{ $rec->product_id }}">
												<span></span>
											</label>
										</td>
										<td>{{ ++$sn }}.</td>
										<td>
											<img src="{{ !empty($rec->product_image) ? url('imgs/product/'.$rec->product_image) : url('imgs/no-image.png') }}" style="width: 100px;">
										</td>
										<td class="text-left">
											<a href="{{ url('rt-admin/product/add/'.$rec->product_id) }}" title="Edit" class="text-success nowrap">
												<i class="icon-pencil"></i> {{ $rec->product_name }}
											</a>
											<!-- <div class="row">
												<div class="col-4">
													<strong>Code</strong>
												</div>
												<div class="col-8">
													{{ @$rec->product_code }}
												</div>
											</div> -->
											<div class="row">
												<div class="col-4">
													<strong>Category</strong>
												</div>
												<div class="col-8">
													{{ @$rec->cat->category_name }}
												</div>
											</div>
											<div class="row">
												<div class="col-4">
													<strong>Subcategory</strong>
												</div>
												<div class="col-8">
													{{ @$rec->scat->category_name }}
												</div>
											</div>
										</td>
										<td class="nowrap">
											<div class="row">
												<div class="col-6">
													@if(empty($rec->product_city))
													<a class="btn btn-outline-success btn-small" onclick="select_city({{ $rec->product_id }})">
														Add City
													</a>
													@else
													{{$rec->city->city_name}}
													@endif
												</div>
												<div class="col-6">
													@if(empty($rec->product_country))
													<a class="btn btn-outline-success btn-small" onclick="select_country({{ $rec->product_id }})">
														Add Country
													</a>
													@else
													{{$rec->country->country_name}}
													@endif
												</div>
											</div>

										</td>
										<td class="text-center">
											@if($rec->product_stock > 0)
											<span class="text-success">{{ $rec->product_stock }}</span>
											@else
											<span class="text-danger">Out Of Stock</span>
											@endif
										</td>
										<td>
											<a href="{{ url('rt-admin/product?status='.$rec->product_is_visible.'&id='.$rec->product_id) }}" class="{{ $rec->product_is_visible == 'Y' ? 'text-success': 'text-danger' }}">
												<i class="icon-circle"></i>
											</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						{{ $records->links() }}
						@else
						<div class="alert alert-warning text-center"> <i class="icon-thumbs-o-down"></i> No records found.</div>
						@endif
					</div>
				</form>
			</div>
		</div>
	</div>
</section>