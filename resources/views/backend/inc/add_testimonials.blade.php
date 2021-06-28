
<section class="inner-part">
	<h3  class="pb-2">Add Partner</h3>
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
								<label style="font-weight: bold">Name *</label>
								<input type="text" name="record[testimonial_name]" value="{{ @$edit->testimonial_name }}" placeholder="Title" class="form-control" required>
							</div>
						<!-- <div class="form-group">
							<label style="font-weight: bold">Reviews *</label>
							<textarea rows="10" name="record[testimonial_reviews]" placeholder="Description" class="form-control">{{ @$edit->testimonial_reviews }}</textarea>
						</div> -->
						<div class="category form-group">
							<input type="submit" value="{{ empty($edit->testimonial_id) ? 'Save': 'Update' }}" class="form-control btn btn-primary">
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="content-part">
					<div class="category category-inner">
						<h4>Upload Image</h4>
							<div class="divider"></div>
						<div class="file-upload">

						  <div class="col image-upload-wrap">
				           <label class="file-upload form-group" style="padding: 0px; border: 1px solid #ccc;">
				            <img class="file-upload-image"  src="{{ !empty($edit->testimonial_image) ? url('imgs/testimonials/'.$edit->testimonial_image) : url('imgs/no-image.png') }}">
				            <input type="file" class="file-upload-input" name="testimonial_image" accept="image/*" id="testimonials_image" >
				            </label>
			            </div>
						  <label for="testimonials_image" class="file-upload-btn btn btn-info btn-block">Select Image</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</section>