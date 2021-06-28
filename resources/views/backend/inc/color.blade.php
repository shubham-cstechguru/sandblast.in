<div class="container-fluid">
		<div class="">
</div>
<section class="inner-part">

	<div class="row color">
		<div class="col">
			<!-- inner part -->
			<div class="row">
				<div class="col-sm-12">
					<h3  class="pb-2"> Colors</h3>
						<div class="divider"></div>
				</div>
			</div>
			<div class="setting">
				<form>
						@csrf
					<div class="row">
						<div class="col-sm-12">
							<form>
						<div class="search-box form-group product">
							<input type="text" value="{{ @$search['name'] }}" class="form-control" name="search[name]" placeholder="Search . . .">
							<input type="submit" class="form-control btn btn-primary" name="" value="Search">
						</div>
					</form>
						</div>
					</div>
				</form>
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
									<div class="divider"></div>
									<div class="form-group">
										<label>Color Name *</label>
										<input type="text" name="record[color_name]" value="{{ @$edit->color_name }}" placeholder="Color Name" class="form-control" autofocus="">
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
				                                        <input type="checkbox" name="check[]" class="check" value="{{ $rec->color_id }}">
				                                        <span></span>
				                                    </label>
												</td>
												<td>{{ ++$sn }}</td>
												<td>{{ $rec->color_name }}</td>												<td>
												<a href="{{ url('rt-admin/color/'.$rec->color_id) }}" title="Edit" class="text-success">
				                                        	<i class="icon-pencil"></i>
				                                        </a>&nbsp;		
												<a href="{{ url('rt-admin/color?status='.$rec->color_is_visible.'&id='.$rec->color_id) }}" class="{{ $rec->color_is_visible == 'Y' ? 'text-success': 'text-danger' }}">
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

			</div>
		</div>
	</div>
</section>
	</div>
