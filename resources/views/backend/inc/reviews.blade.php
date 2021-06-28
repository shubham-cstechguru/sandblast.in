<section class="inner-part">
	<div class="row color">
		<div class="col">
			<h3 class="pb-2">View Reviews</h3>
			<div class="divider"></div>
			<div class="content-part">
				<form method="post">
					@csrf
					<div class="product">
						<div class="heading">
							<h5>{{ $records->total() }} record(s) found</h5><a href="" class="icon-trash-o"></a>
						</div>
						<div class="divider"></div>
						<div class="table-responsive">
							<table class="table table-bordered table-striped text-center">
								<thead>
									<tr>
										<th>
											<label class="animated-checkbox">
		                                        <input type="checkbox"  class="check_all">
		                                        <span></span>
		                                    </label>
										</th>
										<th>SN.</th>
										<th>User Name</th>
										<th>Mobile No.</th>
										<th>Rating</th>
										<th>Reviews</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $sn = $records->firstItem() - 1; @endphp
									@foreach($records as $rec)
									<tr>
										<td>
											<label class="animated-checkbox">
		                                        <input type="checkbox" name="check[]" class="check" value="{{ $rec->review_id }}">
		                                        <span></span>
		                                    </label>
										</td>
										<td>{{ ++$sn }}</td>
										<td>{{ $rec->user_name }}</td>
										<td>{{ $rec->user_mobile }}</td>
										<td>{{ $rec->review_rating }}</td>
										<td>{{ $rec->review_comment}}</td>
										<td>
													<a href="{{ url('rt-admin/reviews?status='.$rec->review_is_active.'&id='.$rec->review_id) }}" class="{{ $rec->review_is_active == 'Y' ? 'text-success': 'text-danger' }}">
														<i class="icon-circle"></i>
													</a>
												</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						@php
							$base_url  = url('rt-admin/reviews');
							$get_param = request()->input();
							if(isset($get_param['page'])) {
								unset($get_param['page']);
							}
						@endphp
						{{ $records->appends($get_param)->links() }}
					</div>
				</form>
			</div>
		</div>
</div>
</section>
