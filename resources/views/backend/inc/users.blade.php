<section class="inner-part">
	<div class="row color">
		<div class="col">
			<h3 class="pb-2">View Users</h3>
			<div class="divider"></div>
			<div class="content-part">
				<form method="post">
					<div class="product">
						<div class="heading">
							<h5> record(s) found</h5>
							
							<a href="" class="icon-trash-o"></a>
						</div>
						<div class="divider"></div>
						@if(!$records->isEmpty())
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
								<th>Email</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@php $sn = 0; @endphp
						@foreach($records as $rec)
							<tr>
								<td>
									<label class="animated-checkbox">
                                        <input type="checkbox" name="check[]" class="check" value="">
                                        <span></span>
                                    </label>
								</td>
								<td>{{ ++$sn }}.</td>
								<td>{{ $rec->user_name }}</td>
								<td>{{ $rec->user_mobile }}</td>
								<td>{{ $rec->user_email }}</td>
								<td>
									<a href="{{ url('rt-admin/user?status='.$rec->user_is_enable.'&id='.$rec->user_id ) }}" class="{{ $rec->user_is_enable == 'Y' ? 'text-success': 'text-danger' }}">
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
					<div>{{ $records->appends(request()->except('page'))->links() }}.</div>
					</div>
				</form>
			</div>
		</div>
</div>
</section>