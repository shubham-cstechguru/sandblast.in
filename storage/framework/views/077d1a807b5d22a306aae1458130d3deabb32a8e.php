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
     return number_format($number / $divisor, $precision) . $shorthand;
     }
     $cart_session = session('cart_session');
?>
<section class="product-whole-information mt-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(url($record->cat->category_slug)); ?>"><?php echo e(ucwords(strtolower($record->cat->category_name))); ?></a></li>
                <?php if(!empty($record->scat->category_name)): ?>
                <li class="breadcrumb-item"><a href="<?php echo e(url($record->cat->category_slug.'/'.$record->scat->category_slug)); ?>"><?php echo e($record->scat->category_name); ?></a></li>
                <?php endif; ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e($record->product_name); ?></li>
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
                              <img class="xzoom x-img" id="xzoom-default" src="<?php echo e(url('imgs/product/'
                              .$record->product_image)); ?>" />
                          </a>
                          <?php $__currentLoopData = $gall; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <a class="lightbox carousel-item" data-fancybox="gallery" href="<?php echo e(url('imgs/product/'.$record->product_id.'/'.$images->pimage_image)); ?>" data-fancybox="gallery">
                              <img class="xzoom x-img" src="<?php echo e(url('imgs/product/'.$record->product_id.'/'.$images->pimage_image)); ?>">
                          </a>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                        <!-- Indicators -->
                        <div class="xzoom-thumbs carousel-indicators clearfix owl-carousel owl-carousel3 owl-theme">
                          <div data-target="#demo2" data-slide-to="0" class="active item"><img
                                      class="xzoom-gallery" src="<?php echo e(url('imgs/product/'.$record->product_image_thumb)); ?>"  xpreview="<?php echo e(url
                                      ('imgs/product/'.$record->product_image_thumb)); ?>" title="">
                          </div>
                          <?php $i = 0; ?>
                          <?php $__currentLoopData = $gall; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <?php $i++; ?>
                          <div data-target="#demo2" data-slide-to="<?php echo e($i); ?>" class="item"><img
                                     class="xzoom-gallery" src="<?php echo e(url('imgs/product/'.$record->product_id.'/'.$images->pimage_image_thumb)); ?>"  xpreview="<?php echo e(url
                                     ('imgs/product/'.$record->product_id.'/'.$images->pimage_image_thumb)); ?>" title="">
                          </div>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>

                    </div>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="card">
                    <div class="card-body">
                        <h1 class="product-name mb-5">
                            <?php echo e($record->product_name); ?>

                        </h1>

                        <div class="row mb-3">
                            <div class="col-4">
                                <label class="d-block">Qty</label>
                                <div class="product-qty">
                                    <div class="qty-input">
                                        <input type="text" name="" value="1" min="1" readonly>
                                    </div>
                                    <div class="qty-action">
                                        <button type="button" class="plus"><i class="icon-plus"></i> </button>
                                        <button type="button" class="minus"><i class="icon-minus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-block btn-primary enquiry_btn" data-pid="<?php echo e($record->product_id); ?>">
                                    Enquiry Now <i class="icon-long-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="product-desc">
                            <?php echo $record->product_description; ?>

                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\sandblast\resources\views/frontend/inc/product-single.blade.php ENDPATH**/ ?>