<div class="container-fluid">
		<div class="">
</div>
<section class="inner-part">

	<div class="row color">
		<div class="col">
			<!-- inner part -->
			<div class="row">
				<div class="col-sm-12">
					<h3  class="pb-2"> Categories</h3>
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
							<select name="search[cat]" id="category" class="form-control">
		                        <option value="">Select Category</option>
								@foreach($fcat as $cate)
		                            <option @if(@$search['cat'] == $cate->category_id ) selected @endif value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
		                        @endforeach
		                        </select>
							<input type="text" value="{{ @$search['name'] }}" class="form-control" name="search[name]" placeholder="Search . . .">
							<input type="submit" class="form-control btn btn-primary" name="" value="Search">
						</div>
					</form>
						</div>
					</div>
				</form>
					<div class="row">
						<div class="col-sm-6">
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
										<label>Category Name *</label>
										<input type="text" name="record[category_name]" value="{{ @$edit->category_name }}" placeholder="Category Name" class="form-control">
									</div>
									<div class="form-group">
										<label>Parent</label>
										<select name="record[category_parent]" class="form-control">
				                            <option value="ROOT">ROOT</option>
				                            @foreach($category as $cat)
				                            <option {{ @$edit->category_parent == $cat->category_id ? 'selected' : "" }} value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
				                            @endforeach
				                        </select>
									</div>
								</div>
                                <div class="content-part">
            						<div class="category">
            							<div class="form-group">
            								<label>Top Description</label>
            								<textarea rows="10" name="record[top_content]" placeholder="Description" class="form-control editor">{{ @$edit->top_content }}</textarea>
            							</div>
            						</div>
            					</div>
            					<div class="content-part">
            						<div class="category">
            							<div class="form-group">
            								<label>Bottom Description</label>
            								<textarea rows="10" name="record[bottom_content]" placeholder="Description" class="form-control editor">{{ @$edit->bottom_content }}</textarea>
            							</div>
            						</div>
            					</div>
								<div class="category mt-3">
										<h4>Upload Image</h4>
										<label class="file-upload">
											<img src="{{ !empty(@$edit->category_image) ? url('imgs/category/'.$edit->category_image) : url('imgs/no-image.png') }}">
											<input type="file" name="category_image" accept="image/*" id="category_image">
										</label>
										<label for="category_image" class="btn btn-primary btn-block">Select Image</label>
									<div class="form-group">
										<input type="submit" value=" @if(!empty($edit)) Update @else Save @endif" class="form-control btn btn-primary">
									</div>
									</div>
									<div class="form-group" style="margin-top:10px">
										<label>Seo title </label>
										<input type="text" name="record[seo_title]" value="{{ @$edit->seo_title }}" placeholder="Seo title" class="form-control">
									</div>
									<div class="form-group">
										<label>Seo keywords </label>
										<textarea rows="3" name="record[seo_keyword]" class="form-control" plcaehlder="Seo keywords">{{ @$edit->seo_keyword }}</textarea>
									</div>
									<div class="form-group">
                                        <label for="seo_description">Seo Description</label>
                                        <textarea class="form-control" id="seo_description" rows="3" name="record[seo_description]" placeholder="Seo description...">{{ @$edit->seo_description }}</textarea>
                                  </div>
							</form>
							
						</div>
						<div class="col-sm-6">
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
		                                    <th>Image</th>
		                                    <th>Name</th>
		                                    <!--<th>Parent</th>-->
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
				                                        <input type="checkbox" name="check[]" class="check" value="{{ $rec->category_id }}">
				                                        <span></span>
				                                    </label>
												</td>
												<td>{{ ++$sn }}</td>
												<td class="text-center">
													<img style="width: 70px;" src="{{ url('imgs/category/'.$rec->category_image) }}">
												</td>
												<td>{{ $rec->category_name }}</td>
												<!--<td>{{ !empty($rec->parent) ? $rec->parent : 'ROOT' }}</td>-->
												<td>
												<a href="{{ url('rt-admin/category/'.$rec->category_id) }}" title="Edit" class="text-success">
				                                        	<i class="icon-pencil"></i>
				                                        </a>&nbsp;		
												<a href="{{ url('rt-admin/category?status='.$rec->category_is_visible.'&id='.$rec->category_id) }}" class="{{ $rec->category_is_visible == 'Y' ? 'text-success': 'text-danger' }}">
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
