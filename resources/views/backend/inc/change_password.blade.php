
<section class="inner-part">
	<div class="row color">
		<div class="col">
			<h3  class="pb-2">Change Password</h3>
			<!-- inner part -->
			<div class="content-part">
				<h6>Basic Information</h6>
			<div class="divider"></div>

			<form class="change_pass" method="post">
				@csrf
				@if (\Session::has('success'))
				    <div class="alert alert-success">
					    {!! \Session::get('success') !!}</li>
					</div>
				@endif
				@if (\Session::has('failed'))
				    <div class="alert alert-danger">
					    {!! \Session::get('failed') !!}</li>
					</div>
				@endif
				<div class="form-group">
					<input type="password" name="password[current]" placeholder="*Current Password" class="form-control">
				</div>
				<div class="form-group">
					<input type="password" name="password[new]" placeholder="*New Password" class="form-control">
				</div>
				<div class="form-group">
					<input type="password" name="password[confirm]" placeholder="*Confirm Password" class="form-control">
				</div>
				<div class="form-group">
					<input type="submit" value="Change Password" class="form-control btn btn-primary">
				</div>
			</form>

			</div>
		</div>
</div>
</section>