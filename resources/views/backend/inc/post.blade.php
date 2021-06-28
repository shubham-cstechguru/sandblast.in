<div class="container-fluid">
		<div class="">
</div>
<section class="inner-part">

	<div class="row color">
		<div class="col">
			<!-- inner part -->
			<div class="row">
				<div class="col-sm-12">
					<h3  class="pb-2"> View Posts</h3>
					<div class="divider"></div>
				</div>
			</div>
			<div class="setting">
					<form method="post">
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
		                                    <th>Description</th>
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
				                                        <input type="checkbox" name="check[]" class="check" value="{{ $rec->post_id }}">
				                                        <span></span>
				                                    </label>
												</td>
												<td>{{ ++$sn }}</td>
												<td>{{ $rec->post_title }}</td>
												<td>{{ $rec->post_description }}</td>
												<td>
												<a href="{{ url('rt-admin/post/add/'.$rec->post_id) }}" title="Edit" class="text-success">
				                                        	<i class="icon-pencil"></i>
				                                        </a>&nbsp;		
												<a href="{{ url('rt-admin/post?status='.$rec->post_is_visible.'&id='.$rec->post_id) }}" class="{{ $rec->post_is_visible == 'Y' ? 'text-success': 'text-danger' }}">
													<i class="icon-circle"></i>
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
				</form>
			</div>
		</div>
	</div>
</section>
	</div>
