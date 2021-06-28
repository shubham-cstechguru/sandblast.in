<?php
	$site = DB::table('settings')->first();
?>

<?php if(session()->has('user_auth')): ?>

	<?php
		$profile = DB::table('users')->where('user_id', session('user_auth'))->first();
	?>

	<?php echo $__env->make('backend.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('backend.inc.'.$page, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('backend.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php else: ?>

	<?php echo $__env->make('backend.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php endif; ?><?php /**PATH /home/jodhpursand/public_html/resources/views/backend/layout.blade.php ENDPATH**/ ?>