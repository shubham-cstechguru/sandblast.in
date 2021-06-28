<div class="container-fluid">
		<div class="">
</div>
<section class="inner-part">

	<div class="row color">
		<div class="col">
			<!-- inner part -->
			<div class="row">
				<div class="col-sm-12">
					<h3  class="pb-2"> Collection</h3>
						<div class="divider"></div>
				</div>
			</div>
			<div class="setting">
				<div class="row">
					<div class="col-sm-12">
						<form>
					<div class="search-box form-group product">
						<input type="text" class="form-control" name="search" placeholder="Search . . .">
						<input type="submit" class="form-control btn btn-primary" name="" value="Search">
					</div>
				</form>
					</div>
				</div>
					<div class="row">
						<div class="col-sm-4">
				<form method="post" enctype="multipart/form-data">
					@csrf
					@if (\Session::has('success'))
							    <div class="alert alert-success">
								    {!! \Session::get('success') !!}</li>
								</div>
							@endif
							<div class="category">
								<h5>Basic Information</h5>
								<div class="divider"></div>
								<div class="form-group">
									<label>Collection Name *</label>
									<input type="text" name="record[collection_title]" value="{{ @$edit->collection_title }}" placeholder="Collection Name" class="form-control">
								</div>
								<h4>Upload Image</h4>
									<div class="divider"></div>
								<div class="file-upload">

								  <div class="col image-upload-wrap">
						           <label class="file-upload form-group" style="padding: 0px; border: 1px solid #ccc;">
						            <img class="file-upload-image"  src="{{ !empty($edit->collection_image) ? url('imgs/collections/'.$edit->collection_image) : url('imgs/no-image.png') }}">
						            <input type="file" class="file-upload-input" name="collection_image" accept="image/*" id="collectionImage" >
						            </label>
					            </div>
								  <label for="collectionImage" class="file-upload-btn btn btn-primary btn-block">Select Image</label>
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
								@if(!$records->isEmpty())
								<div class="heading">
									<h5>{{ $records->count() }} record(s) found</h5><a href="" class="icon-trash-o"></a>
								</div>
								<div class="divider"></div>
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
		                                    <th>Image</th>
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
				                                        <input type="checkbox" name="check[]" class="check" value="{{ $rec->collection_id }}">
				                                        <span></span>
				                                    </label>
												</td>
												<td>{{ ++$sn }}</td>
												<td>{{ $rec->collection_title }}</td>
												<td>
													<img style="width: 100px;" src="{{ url('imgs/collections/'.$rec->collection_image) }}">
												</td>
												<td>
												<a href="{{ url('rt-admin/collection/'.$rec->collection_id) }}" title="Edit" class="text-success">
				                                        	<i class="icon-pencil"></i>
				                                        </a>&nbsp;		
												<a href="{{ url('rt-admin/collection?status='.$rec->collection_is_visible.'&id='.$rec->collection_id) }}" class="{{ $rec->collection_is_visible == 'Y' ? 'text-success': 'text-danger' }}">
													<i class="icon-circle"></i>
												</a>
										</td>
		                            		</tr>
		                            	@endforeach
		                            </tbody>
		                        </table>
		                        @else
		                        	<div class="alert alert-warning text-center"> <i class="icon-thumbs-o-down"></i> 0 records found.</div>
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
