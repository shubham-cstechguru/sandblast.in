<div class="container-fluid">
		<div class="">
</div>
<section class="inner-part">

	<div class="row color">
		<div class="col">
			<!-- inner part -->
			<div class="row">
				<div class="col-sm-12">
					<h3  class="pb-2"> Add Post</h3>
						<div class="divider"></div>
				</div>
			</div>
			<div class="setting">
					<div class="row">
						<div class="col-sm-8">
							<form method="post" enctype="multipart/form-data">
							@csrf
							@if (\Session::has('success'))
							    <div class="alert alert-success">
								{!! \Session::get('success') !!}
								</div>
							@endif
								<div class="category">
									<h3 class="card-title">Basic Information</h3>
									<div class="divider"></div>
									<div class="form-group">
										<label>Post Name *</label>
										<input type="text" name="record[post_title]" value="{{ @$edit->post_title }}" placeholder="Post Name" class="form-control">
									</div>

									<div class="form-group">
										<label>Description *</label>
										<textarea name="record[post_description]" rows="10" placeholder="Post Name" class="form-control editor">{{ @$edit->post_description }}</textarea>
									</div>
								</div>
								</div>
								<div class="col-sm-4">
									<div class="category">
										<div class="form-group">
											<input type="submit" value="@if(!empty(@$edit->post_image)) Update @else Save @endif" class="form-control btn btn-primary">
										</div>
										<hr>
										<h4>Upload Image</h4>
										<label class="file-upload">
											<img src="{{ !empty(@$edit->post_image) ? url('imgs/posts/'.$edit->post_image) : url('imgs/no-image.png') }}">
											<input type="file" name="post_image" accept="image/*" id="category_image">
										</label>
										<label for="category_image" class="btn btn-primary btn-block">Select Image</label>

									</div>
							</form>
						</div>
					</div>

			</div>
		</div>
	</div>
</section>
	</div>
