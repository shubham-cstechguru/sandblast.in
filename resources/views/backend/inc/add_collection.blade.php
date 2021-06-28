
<section class="inner-part">
	<h3  class="pb-2">Collections</h3>
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
						<label style="font-weight: bold">Collection Title *</label>
						<input type="text" name="record[collection_title]" value="{{ @$edit->collection_title }}" placeholder="Collection Title" class="form-control" required>
					</div>
					<div class="category form-group">
						<input type="submit" value="{{ empty($edit->slider_id) ? 'Save': 'Update' }}" class="form-control btn btn-primary">
					</div>
					</div>

				</div>
			</div>
			<div class="col-sm-4">
				<div class="content-part">
					<div class="category">
						<h4>Upload Image</h4>
						<label class="upload_image">
							<img src="{{ !empty($edit->collection_image) ? url('imgs/collections/'.$edit->collection_image) : url('imgs/no-image.png') }}">
							<input type="file" name="collection_image" accept="image/*" id="collection_image">
						</label>
						<label for="collection_image" class="btn btn-primary btn-block">Select Image</label>
					</div>
				</div>
			</div>
		</div>
	</form>
</section>