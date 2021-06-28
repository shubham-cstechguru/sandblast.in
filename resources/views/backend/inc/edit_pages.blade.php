
<section class="inner-part">
	<h3  class="pb-2">Update Page</h3>
	<div class="divider"></div>
	@if (\Session::has('success'))
	    <div class="alert alert-success">
		    {!! \Session::get('success') !!}</li>
		</div>
	@endif
	<!-- inner part -->
	<form class="change_pass" method="post" enctype="multipart/form-data">
			@csrf
		<div class="row">
			<div class="col-sm-8">
				<div class="content-part">
					<div class="category">
						<h4>Basic Information</h4>
						<div class="divider"></div>						
							<div class="form-group">
								<label style="font-weight: bold">Title *</label>
								<input type="text" name="record[page_title]" value="{{ @$edit->page_title }}" placeholder="Title" class="form-control" required>
							</div>

							<div class="form-group">
								<label style="font-weight: bold">Description *</label>
								<textarea rows="10" name="record[page_description]" placeholder="Description" class="form-control editor">{{ @$edit->page_description }}</textarea>
							</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="content-part">
					<div class="category form-group">
						<h4>Save & Update</h4>
						<input type="submit" value="{{ empty($edit->page_id) ? 'Save': 'Update' }}" class="form-control btn btn-primary">
					</div>
					<div class="category category-inner">
						<h4>Upload Image</h4>
							<div class="divider"></div>
						<div class="file-upload">

						  <div class="col image-upload-wrap">
				           <label class="file-upload form-group" style="padding: 0px; border: 1px solid #ccc;">
				            <img class="file-upload-image"  src="{{ !empty($edit->page_image) ? url('imgs/pages/'.$edit->page_image) : url('imgs/no-image.png') }}">
				            <input type="file" class="file-upload-input" name="page_image" accept="image/*" id="page_image" >
				            </label>
			            </div>
						  <label for="page_image" class="file-upload-btn btn btn-info btn-block">Select Image</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</section>