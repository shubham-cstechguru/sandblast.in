<section class="inner-part">
	<div class="row color">
		<div class="col">
			<h3 class="pb-2">View FAQ</h3>
			<div class="divider"></div>
			<div class="content-part">
				<form>
					<div class="search-box form-group product">
						<select name="" id="category" class="form-control">
	                            <option value="">Select Category</option></select>
                        <select name="searchcat" class="form-control" id="response">
                                <option value="">Select Subcategory</option>
                        </select>
						<input type="text" class="form-control" name="search" placeholder="Search . . .">
						<input type="submit" class="form-control btn btn-primary" name="" value="Search">
					</div>
				</form>
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
								<th>Question</th>
								<th>Answer</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@php
								$sn = $offset;
							@endphp

							@foreach($records as $rec)
							<tr>
								<td>
									<label class="animated-checkbox">
                                        <input type="checkbox" name="check[]" class="check" value="">
                                        <span></span>
                                    </label>
								</td>
								<td>{{ ++$sn }}</td>
								<td>{!! substr(strip_tags($rec->faq_question), 0, 400).' &hellip; ' !!}</td>
								<td>{!! substr(strip_tags($rec->faq_answer), 0, 400).' &hellip; ' !!}</td>

								<td>
										<a href="{{ url('rt-admin/faq/add/'.$rec->faq_id) }}" title="Edit" class="text-success">
		                                        	<i class="icon-pencil"></i>
		                                        </a>&nbsp;		
										<a href="product?status_id=" class="">
											<i class="icon-circle"></i>
										</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ $records->links() }}
							@else
							<div class="no_records_found">
								No record(s) found.
							</div>
							@endif
					<div></div>
					</div>
				</form>
			</div>
		</div>
</div>
</section>