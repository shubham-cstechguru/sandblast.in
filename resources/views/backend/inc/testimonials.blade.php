<section class="inner-part">
	<div class="row color">
		<div class="col">
			<h3 class="pb-2">View Partners</h3>
			<div class="divider"></div>
			<div class="content-part">
				@if (\Session::has('success'))
				    <div class="alert alert-success">
					    {!! \Session::get('success') !!}</li>
					</div>
				@endif
				<form method="post">
					@csrf
					<div class="product">
						<div class="heading">
							<h5>{{ $records->count() }} record(s) found</h5>
							@if(!$records->isEmpty())
							<a href="" class="icon-trash-o"></a>
							@endif
						</div>
						<div class="divider"></div>
						@if(!$records->isEmpty())
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
										<th>Image</th>
										<th>Name</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@php $sn = 0; @endphp
									@foreach($records as $rec)
									<tr>
										<td>
											<label class="animated-checkbox">
		                                        <input type="checkbox" name="check[]" class="check" value="{{ $rec->testimonial_id }}">
		                                        <span></span>
		                                    </label>
										</td>
										<td>{{ ++$sn }}.</td>
										<td>
											<img src="{{ !empty($rec->testimonial_image) ? url('imgs/testimonials/'.$rec->testimonial_image) : url('imgs/no-image.png') }}" style="width: 100px;">
										</td>
										<td>{{ $rec->testimonial_name }}</td>
										<td>
											<a href="{{ url('rt-admin/partner/add/'.$rec->testimonial_id) }}" title="Edit" class="text-success">
			                                        	<i class="icon-pencil"></i>
			                                        </a>&nbsp;		
											<a href="{{ url('rt-admin/partner?status='.$rec->testimonial_is_visible.'&id='.$rec->testimonial_id) }}" class="{{ $rec->testimonial_is_visible == 'Y' ? 'text-success': 'text-danger' }}">
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