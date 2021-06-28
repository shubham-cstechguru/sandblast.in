
<section class="inner-part">
	<div class="row color">
		<div class="col">
			<h3  class="pb-2">FAQ</h3>
			<div class="divider"></div>
			@if (\Session::has('success'))
							    <div class="alert alert-success">
								    {!! \Session::get('success') !!}</li>
								</div>
							@endif
			<!-- inner part -->
			<div class="content-part">
				<div class="category">
					<h6>Basic Information</h6>
			<div class="divider"></div>

			<form class="change_pass" method="post">
				@csrf
				<label style="font-weight: bold">Page Title *</label>
				<div class="form-group">
					<input type="text" name="record[page_title]" value="{{ @$edit->page_title }}" placeholder="Title" class="form-control">
				</div>
				<label style="font-weight: bold">Page Description *</label>
				<div class="form-group">
					<textarea rows="5" name="record[page_description]" placeholder="Description" class="form-control editor">{{ @$edit->page_description }}</textarea>
				</div>
				<div class="form-group">
					<input type="submit" value="{{ empty($edit->page_id) ? 'Save': 'Update' }}" class="form-control btn btn-primary">
				</div>
			</form>
				</div>

			</div>
		</div>
</div>
</section>