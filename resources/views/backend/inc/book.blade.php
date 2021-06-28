<section class="inner-part">
	<div class="row color">
		<div class="col">
			<h3 class="pb-2">View Books</h3>
			<div class="divider"></div>
			<div class="content-part">
				<form>
					<div class="search-box form-group product">
						<input type="text" class="form-control" name="search" placeholder="Search . . .">
						<input type="submit" class="form-control btn btn-primary" name="" value="Search">
					</div>
				</form>
				<form method="post">
					@csrf
					<div class="product">
						<div class="heading">
							<h5> record(s) found</h5>
							
							<a href="" class="icon-trash-o"></a>
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
										<th>Details</th>	
										<th>Extra info.</th>
										<th>Description</th>
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
		                                        <input type="checkbox" name="check[]" class="check" value="{{ $rec->book_id }}">
		                                        <span></span>
		                                    </label>
										</td>
										<td>{{ ++$sn }}</td>
										<td>
											<img class="product-image" title="Image" alt="Image" src="{{ url('imgs/books/'.$rec->book_image) }}">
										</td>
										<td class="detail">
											<span><b>Book Name</b></span>
											<span>{{ $rec->book_name }}</span>
											<span><b>Author</b></span>
											<span>{{ $rec->book_author }}</span>
											<span><b>Edition</b></span>
											<span>{{ $rec->book_edition }}</span>
											<span><b>Category</b></span>
											<span>{{ $rec->category_name }}</span>
											<span><b>Subcategory</b></span>
											<span>{{ $rec->category_subcategory }}</span>
										</td>
										<td class="detail">
											<span><b>Rating</b></span>
											<span>{{ $rec->book_rating }}</span>
											<span><b>Downloads</b></span>
											<span>{{ $rec->book_downloads }}</span>
											<span><b>Listner</b></span>
											<span>{{ $rec->book_listening }}</span>
										</td>
										<td>
											{!! substr(strip_tags($rec->book_description), 0, 400).' &hellip; ' !!}
										</td>
										<td>
												<a href="{{ url('rt-admin/book/add/'.$rec->book_id) }}" title="Edit" class="text-success">
				                                        	<i class="icon-pencil"></i>
				                                        </a>&nbsp;		
												<a href="{{ url('rt-admin/book?status='.$rec->book_status.'&id='.$rec->book_id) }}" class="{{ $rec->book_status == 'Y' ? 'text-success': 'text-danger' }}">
													<i class="icon-circle"></i>
												</a><br>
												<a href="{{ url('imgs/books/'.$rec->book_pdf) }}" target="_blank" class="icon-picture_as_pdf"></a><br>
												<a href="{{ url('imgs/books/'.$rec->book_mp3) }}" target="_blank" class="icon-music"></a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
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