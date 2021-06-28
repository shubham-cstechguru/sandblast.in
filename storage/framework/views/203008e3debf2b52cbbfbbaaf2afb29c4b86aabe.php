<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo e($site->setting_title); ?> | Admin Panel</title>
	<?php echo e(HTML::style('css/bootstrap.min.css')); ?>

	<?php echo e(HTML::style('icomoon/style.css')); ?>

	<?php echo e(HTML::style('admin/css/jquery.multiselect.css')); ?>

	<?php echo e(HTML::style('admin/css/style.css')); ?>


</head>
<body>
	<input type="hidden" id="base_url" value="<?php echo e(url('rt-admin/')); ?>">
	<input type="hidden" id="wbase_url" value="<?php echo e(url('/')); ?>">
	<header>
			<div class="top-bar">
				<nav class="navbar-nav">
					<ul>
						<div class="navbar-brand nav-item float-left">
							<span><?php echo e(strtoupper($site->setting_title)); ?></span>
						</div>
						<li class="nav-item float-right">
							<span class="icon-user"><i class="icon-angle-down"></i></span>
						</li>
						<ul class="inner-ul">
	                        <li><a href="<?php echo e(url('rt-admin/setting')); ?>"><i class="icon-gear"></i> Settings</a>
	                        </li>
	                        <li><a href="<?php echo e(url('rt-admin/change-password')); ?>"><i class="icon-lock"></i> Change Password</a>
	                        </li>
	                        <div class="divider"></div>
	                        <li><a href="<?php echo e(url('rt-admin/logout')); ?>"><i class="icon-sign-out"></i> Logout</a>
	                        </li>
	                    </ul>
					</ul>
				</nav>
			</div>
	</header>
	<div style="width:100%; overflow: hidden;">
	<div class="row">
		<?php echo $__env->make('backend.common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<div class="col-sm-10">
			<div class="page-content">
<?php /**PATH /home/jodhpursand/public_html/resources/views/backend/common/header.blade.php ENDPATH**/ ?>