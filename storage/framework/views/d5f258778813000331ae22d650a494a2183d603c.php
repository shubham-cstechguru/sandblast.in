<?php
    $mcategories = App\Model\Category::with(['scats' => function($q) {
        $q->where('category_is_deleted', 'N');
    }])->where('category_is_deleted', 'N')->where('category_parent', 0)->get();
?>

<html>
  <head>
      <base href="<?php echo e(url('/').'/'); ?>">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
      <title><?php echo e(empty($meta['title']) ? $site->setting_title : $meta['title']); ?></title>

      <?php if(!empty($meta)): ?>
      <meta name="keywords" content="<?php echo e(@$meta['keywords']); ?>">
      <meta name="description" content="<?php echo e(@$meta['description']); ?>">
      <?php endif; ?>

      <link rel="icon" href="<?php echo e(url('imgs/favicon.png')); ?>">

      <?php echo e(HTML::style('css/bootstrap.min.css')); ?>

      <?php echo e(HTML::style('css/owl.carousel.min.css')); ?>

      <?php echo e(HTML::style('icomoon/style.css')); ?>

      <?php echo e(HTML::style('css/stylesheet.css')); ?>

      <?php echo e(HTML::style('css/jquery.fancybox.min.css')); ?>

      <?php echo e(HTML::style('css/style.css')); ?>

      
      <style>
          .sticky-container{
		/*background-color: #333;*/
		padding: 0px;
		margin: 0px;
		position: fixed;
		right: -124px;
		top:230px;
		width: 200px;

	}
/* style p when hover li */
.sticky-first li:hover p {
    float: right;
}
	.sticky li{
		list-style-type: none;
		background-color: #333;
		color: #efefef;
		height: 43px;
		padding: 0px;
		margin: 0px 0px 1px 0px;
		-webkit-transition:all 0.25s ease-in-out;
		-moz-transition:all 0.25s ease-in-out;
		-o-transition:all 0.25s ease-in-out;
		transition:all 0.25s ease-in-out;
		cursor: pointer;
	padding:0px 10px;

	}

	.sticky li:hover{
		margin-left: -115px;
		/*-webkit-transform: translateX(-115px);
		-moz-transform: translateX(-115px);
		-o-transform: translateX(-115px);
		-ms-transform: translateX(-115px);
		transform:translateX(-115px);*/
		/*background-color: #8e44ad;*/
	
	}

	.sticky li img{
		float: left;
		margin: 5px 5px;
		margin-right: 10px;

	}

	.sticky li p{
		padding: 0px;
		margin: 0px;
		text-transform: uppercase;
		line-height: 43px;

	}
	
	.sticky li i{
	font-size:24px;
    margin-top: 8px;
    display: inline-block;

	}
      </style>
  </head>
<body>
<input type="hidden" id="base_url" value="<?php echo e(url('/')); ?>">
<header>
    <!-- <div class="header-top">
        <div class="container">
            <i class="icon-call"></i> +91 9468554176
            &nbsp; &nbsp;
            <i class="icon-email"></i> burgking.info@gmail.com
        </div>
    </div> -->
    <div class="header-nav">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-8">
                    <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(url('imgs/logo.png')); ?>" alt=""> </a>
                </div>
                <div class="col-4 d-sm-none d-lg-none d-md-none clearfix">
                    <a href="#" class="nav-icon float-right"><i class="icon-navicon"></i></a>
                </div>
                <div class="col-sm-9">
                    <ul class="main-navbar">
                        <?php $__currentLoopData = $mcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(url($mc->category_slug)); ?>"><?php echo e($mc->category_name); ?></a> <?php if(!empty($mc->scats->count())): ?> <span class="icon-angle-down"></span> <div class="clearfix"></div> <?php endif; ?>
                            <?php if(!empty($mc->scats->count())): ?>
                            <ul>
                                <?php $__currentLoopData = $mc->scats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(url($mc->category_slug.'/'.$sc->category_slug)); ?>"><?php echo e($sc->category_name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<?php /**PATH /home/jodhpursand/public_html/resources/views/frontend/common/header.blade.php ENDPATH**/ ?>