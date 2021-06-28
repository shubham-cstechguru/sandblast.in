
<section class="inner-part">
	<div class="row color">
		<div class="col">
			<h3  class="pb-2">Change Password</h3>
			<!-- inner part -->
			<div class="content-part">
				<h6>Basic Information</h6>
			<div class="divider"></div>

			<form class="change_pass" method="post">
				<?php echo csrf_field(); ?>
				<?php if(\Session::has('success')): ?>
				    <div class="alert alert-success">
					    <?php echo \Session::get('success'); ?></li>
					</div>
				<?php endif; ?>
				<?php if(\Session::has('failed')): ?>
				    <div class="alert alert-danger">
					    <?php echo \Session::get('failed'); ?></li>
					</div>
				<?php endif; ?>
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
</section><?php /**PATH /home/jodhpursand/public_html/resources/views/backend/inc/change_password.blade.php ENDPATH**/ ?>