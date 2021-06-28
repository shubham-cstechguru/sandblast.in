<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
		<title>Admin Login | <?php echo e($site->setting_title); ?></title>

		<?php echo e(HTML::style('css/bootstrap.min.css')); ?>

		<?php echo e(HTML::style('icomoon/style.css')); ?>

		<?php echo e(HTML::style('admin/css/style.css')); ?>


		<link rel="icon" href="<?php echo e(url('imgs/ea_logo.ico')); ?>">
	</head>
	<body>
		<section class="full-section">
			<div class="part_up"></div>
			<div class="part_down"></div>
			<div class="half-section"></div>
			<div class="login-form">
				<form id="loginForm" action="<?php echo e(url('rt-admin/ajax/user_login')); ?>" method="post">
					<?php echo csrf_field(); ?>
					<div class="text-center form-group">
						<img class="login_img" src="<?php echo e(url('imgs/logo.png')); ?>">
					</div>
					<div class="form-msg"></div>
					<div class="form-group">
						<input type="text" name="record[user_login]" class="form-control" placeholder="Username" required autofocus autocomplete="off">
					</div>
					<div class="form-group">
						<input type="password" name="record[user_password]" class="form-control" placeholder="Password" required autocomplete="new-password">
					</div>
					<div class="form-group">
						<button class="btn btn-success btn-block">Log Me In</button>
					</div>
				</form>
			</div>
		</section>

		<?php echo e(HTML::script('js/jquery.min.js')); ?>

		<?php echo e(HTML::script('js/popper.min.js')); ?>

	    <?php echo e(HTML::script('js/bootstrap.min.js')); ?>

	    <?php echo e(HTML::script('js/sweetalert.min.js')); ?>

	    <?php echo e(HTML::script('js/validation.js')); ?>

	    <?php echo e(HTML::script('admin/tinymce/js/tinymce/tinymce.min.js')); ?>

	    <?php echo e(HTML::script('admin/js/main.js')); ?>

	</body>
</html><?php /**PATH /home/jodhpursand/public_html/resources/views/backend/login.blade.php ENDPATH**/ ?>