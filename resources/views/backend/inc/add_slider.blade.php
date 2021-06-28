
<section class="inner-part">
	<h3  class="pb-2">Slider</h3>
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
						<label style="font-weight: bold">Slider Title *</label>
						<input type="text" name="record[slider_title]" value="{{ @$edit->slider_title }}" placeholder="Title" class="form-control" required>
					</div>
					<div class="form-group">

					</div>
					</div>

				</div>
			</div>
			<div class="col-sm-4">
				<div class="content-part">
					<div class="category form-group">
						<h4>Save & Update</h4>
						<input type="submit" value="{{ empty($edit->slider_id) ? 'Save': 'Update' }}" class="form-control btn btn-primary">
					</div>
					<div class="category">
						<h4>Upload Image</h4>
						<label class="file-upload">
							<img src="{{ !empty($edit->slider_image) ? url('imgs/sliders/'.$edit->slider_image) : url('imgs/no-image.png') }}">
							<input type="file" name="slider_image" accept="image/*" id="slider_image">
						</label>
						<label for="slider_image" class="btn btn-primary btn-block">Select Image</label>
					</div>
				</div>
			</div>
		</div>
	</form>
</section>
