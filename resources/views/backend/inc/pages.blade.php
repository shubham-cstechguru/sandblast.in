<section class="inner-part">
	<div class="row color">
		<div class="col">
			<h3 class="pb-2">View pages</h3>
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
										<th>Title</th>
										<th>Description</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@php $sn = 0; @endphp
									@foreach($records as $rec)
									<tr>
										<td>
											<label class="animated-checkbox">
		                                        <input type="checkbox" name="check[]" class="check" value="{{ $rec->page_id }}">
		                                        <span></span>
		                                    </label>
										</td>
										<td>{{ ++$sn }}.</td>
										<td>
											<img src="{{ !empty($rec->page_image) ? url('imgs/pages/'.$rec->page_image) : url('imgs/no-image.png') }}" style="width: 100px;">
										</td>
										<td>{{ $rec->page_title }}</td>
										<td>{{ substr( strip_tags( $rec->page_description ), 0, 150 ) }}&hellip;</td>
										<td>
											<a href="{{ url('rt-admin/page/edit/'.$rec->page_id) }}" title="Edit" class="text-success">
			                                  <i class="icon-pencil"></i>
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