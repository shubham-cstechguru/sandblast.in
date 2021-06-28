
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
				<label style="font-weight: bold">Your Question *</label>
				<div class="form-group">
					<input type="text" name="record[faq_question]" value="{{ @$edit->faq_question }}" placeholder="Question" class="form-control">
				</div>
				<label style="font-weight: bold">Your Answer *</label>
				<div class="form-group">
					<textarea rows="5" name="record[faq_answer]" placeholder="Your Answer" class="form-control editor">{{ @$edit->faq_answer }}</textarea>
				</div>
				<div class="form-group">
					<input type="submit" value="{{ empty($edit->faq_id) ? 'Save': 'Update' }}" class="form-control btn btn-primary">
				</div>
			</form>
				</div>

			</div>
		</div>
</div>
</section>