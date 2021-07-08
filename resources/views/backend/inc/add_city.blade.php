<div class="container-fluid">
	<div class="">
	</div>
	<section class="inner-part">

		<div class="row color">
			<div class="col">
				<!-- inner part -->
				<div class="row">
					<div class="col-sm-12">
						<h3 class="pb-2"> Cities</h3>
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

								@if($errors->any())
								<div class="alert alert-danger">
									<ul class="list-group">
										@foreach($errors->all() as $error)
										<li class="list-group-item text-danger">
											{{ $error }}
										</li>
										@endforeach
									</ul>
								</div>
								@endif
								<div class="category">
									<h5>Basic Information</h5>
									<div class="divider"></div>
									<div class="form-group">
										<label>City Name *</label>
										<input type="text" name="record[city_name]" value="{{ @$edit->city_name }}" placeholder="City Name" class="form-control">
									</div>

									<div class="form-group">
										<label>City Short Name *</label>
										<input type="text" name="record[city_short_name]" value="{{ @$edit->city_short_name }}" placeholder="City Short Name" class="form-control">
									</div>

								</div>

								<div class="category mt-3">
									<div class="form-group">
										<input type="submit" value=" @if(!empty($edit)) Update @else Save @endif" class="form-control btn btn-primary">
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
												<th>Short Name</th>
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
														<input type="checkbox" name="check[]" class="check" value="{{ $rec->city_id }}">
														<span></span>
													</label>
												</td>
												<td>{{ ++$sn }}</td>
												<td>{{ $rec->city_name }}</td>
												<td>{{ $rec->city_short_name }}</td>
												<td>
													<a href="{{ url('rt-admin/city/'.$rec->city_id) }}" title="Edit" class="text-success">
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