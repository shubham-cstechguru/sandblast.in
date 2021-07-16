<?php
// Shortens a number and attaches K, M, B, etc. accordingly
function number_shorten($number, $precision = 3, $divisors = null) {

// Setup default $divisors if not provided
if (!isset($divisors)) {
$divisors = array(
pow(1000, 0) => '', // 1000^0 == 1
pow(1000, 1) => 'K', // Thousand
pow(1000, 2) => 'M', // Million
pow(1000, 3) => 'B', // Billion
pow(1000, 4) => 'T', // Trillion
pow(1000, 5) => 'Qa', // Quadrillion
pow(1000, 6) => 'Qi', // Quintillion
);
}

// Loop through each $divisor and find the
// lowest amount that matches
foreach ($divisors as $divisor => $shorthand) {
if (abs($number) < ($divisor * 1000)) { 
    // We found a match! 
    break; 
} 
} 
// We found our match, or there were no matches. 
// Either way, use the last defined value for $divisor. 
return number_format($number / $divisor, $precision) . $shorthand; } $cart_session=session('cart_session'); 
?>
<section class="product-whole-information mt-3 product-block">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bcrumb px-0">
                <li class="breadcrumb-item bcrumb-i"><a href="/">Home</a></li>
                <li class="breadcrumb-item bcrumb-i"><a href="<?php echo e(url($record->cat->category_slug)); ?>"><?php echo e(ucwords(strtolower($record->cat->category_name))); ?></a></li>
                <?php if(!empty($record->scat->category_name)): ?>
                <li class="breadcrumb-item bcrumb-i"><a href="<?php echo e(url($record->cat->category_slug.'/'.$record->scat->category_slug)); ?>"><?php echo e($record->scat->category_name); ?></a></li>
                <?php endif; ?>
                <li class="breadcrumb-item bcrumb-i active" aria-current="page"><?php echo e($record->product_name); ?></li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-sm-5">
                <div class="xzoom-container">
                    <div id="demo2" class="carousel slide" data-ride="carousel">
                        <!-- The slideshow -->
                        <div class="carousel-inner">
                            <a class="lightbox carousel-item active" data-fancybox="gallery" href="<?php echo e(url('imgs/product/'
                          .$record->product_image)); ?>">
                                <img class="xzoom x-img lazy-load" src="<?php echo e(url('imgs/ajax-loader.gif')); ?>" id="xzoom-default" data-src="<?php echo e(url('imgs/product/'.$record->product_image)); ?>"  alt="<?php echo e($record->product_name); ?>"/>
                            </a>
                            <?php $__currentLoopData = $gall; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="lightbox carousel-item" data-fancybox="gallery" href="<?php echo e(url('imgs/product/'.$record->product_id.'/'.$images->pimage_image)); ?>" data-fancybox="gallery">
                                <img class="xzoom x-im lazy-load" src="<?php echo e(url('imgs/ajax-loader.gif')); ?>"  data-src="<?php echo e(url('imgs/product/'.$record->product_id.'/'.$images->pimage_image)); ?>" alt="<?php echo e($record->product_name); ?>">
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <!-- Indicators -->
                        <div class="xzoom-thumbs carousel-indicators clearfix owl-carousel owl-carousel3 owl-theme">
                            <div data-target="#demo2" data-slide-to="0" class="active item"><img class="xzoom-gallery lazy-load" src="<?php echo e(url('imgs/ajax-loader.gif')); ?>" data-src="<?php echo e(url('imgs/product/'.$record->product_image_thumb)); ?>" xpreview="<?php echo e(url('imgs/product/'.$record->product_image_thumb)); ?>" title="<?php echo e($record->product_name); ?>" alt="<?php echo e($record->product_name); ?>">
                            </div>
                            <?php $i = 0; ?>
                            <?php $__currentLoopData = $gall; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i++; ?>
                            <div data-target="#demo2" data-slide-to="<?php echo e($i); ?>" class="item"><img class="xzoom-gallery lazy-load" src="<?php echo e(url('imgs/ajax-loader.gif')); ?>" data-src="<?php echo e(url('imgs/product/'.$record->product_id.'/'.$images->pimage_image_thumb)); ?>" xpreview="<?php echo e(url('imgs/product/'.$record->product_id.'/'.$images->pimage_image_thumb)); ?>" title="<?php echo e($record->product_name); ?>" alt="<?php echo e($record->product_name); ?>">
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="card prod-desc-card mb-3">
                    <div class="card-body">
                        <h1 class="product-name mb-3">
                            <?php echo e($record->product_name); ?>

                        </h1>

                        <div class="prod-spec">
                            <?php echo $record->product_specification; ?>

                        </div>

                        <div class="row my-3">
                            <!-- <div class="col-4"> -->
                               <!-- <label class="d-block">Qty</label> -->
                            <div class="product-qty" style="display: none;">
                                <div class="qty-input">
                                    <input type="hidden" name="" value="1" min="1" readonly disabled>
                                </div>
                                       <!-- <div class="qty-action">
                                           <button type="button" class="plus"><i class="icon-plus"></i> </button>
                                            <button type="button" class="minus"><i class="icon-minus"></i></button>
                                       </div> -->
                            </div>
                            <!-- </div> -->
                            <div class="col-xs-12 col-md-6">
                                <button type="button" class="btn btn-block btn-primary enquiry_btn" data-pid="<?php echo e($record->product_id); ?>">
                                    Enquiry Now</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card prod-desc-card mb-3">
                    <div class="card-body">
                        <div class="product-desc">
                            <?php echo $record->product_description; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="card enquiry-card">
                    <div class="card-header">
                        <h6 class="text-center">Enquiry Regarding <?php echo e($record->product_name); ?></h6>
                    </div>
                    <?php echo e(Form::open(['url' => url('ajax/save_order') ,'id' => 'orderForm'])); ?>

                    <div class="card-body">
                        <input type="hidden" name="record[order_pid]" value="<?php echo e($record->product_id); ?>">
                        <input type="hidden" name="record[order_qty]" value="1">
    
                        <div class="form-group">
                            <input type="text" name="record[order_name]" value="" class="form-control name" placeholder="Name" required>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="tel" name="record[order_mobile]" value="" class="form-control mobile" placeholder="Mobile Number" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="email" name="record[order_email]" value="" class="form-control" placeholder="Email" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="record[order_enquiry]" rows="3" class="form-control" placeholder="Message" required></textarea>
                        </div>
                        <!-- <div class="row" style="display: none;">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>State</label>
                                    <select class="form-control" name="record[order_state]" required>
                                        <option value="">Select State</option>
                                        <option value="Rajasthan">Rajasthan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>City</label>
                                    <select class="form-control" name="record[order_city]" required>
                                        <option value="">Select City</option>
                                        <option value="Jaipur">Jaipur</option>
                                        <option value="Jodhpur">Jodhpur</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->
    
                        <button type="submit" class="btn btn-primary">Send Enquiry</button>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
</section><?php /**PATH D:\work\asb\web work\sandblast.in\resources\views/frontend/inc/product-single.blade.php ENDPATH**/ ?>