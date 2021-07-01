<section id="product-section">
    <div class="container">
       <div class="card mb-2">
            <div class="card-body pb-1 pt-3" id="my_content">
                <h1><?php echo e($category[0]['category_name']); ?></h1>
                <?php echo $category[0]['top_content']; ?>

            </div>
        </div>
        <?php if(!$products->isEmpty()): ?>
        <div class="row">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $image = url( 'imgs/product/'.$p->product_image_medium );
            ?>
            <div class="col-sm-3 col-6">
                <div class="card product-block">
                    <a href="<?php echo e(url($p->product_slug)); ?>"><img data-src="<?php echo e($image); ?>" class="lazy-load" src="<?php echo e(url('imgs/ajax-loader.gif')); ?>" alt="<?php echo e($p->product_name); ?>" title="<?php echo e($p->product_name); ?>" class="main-image lazy"></a>
                    <div class="card-body">
                        <h2 class="card-title" style="text-align: center;"><a href="<?php echo e(url($p->product_slug)); ?>" title="<?php echo e($p->product_name); ?>"><?php echo e($p->product_name); ?></a></h2>

                        <div class="mt-2">
                            <div class="row">
                                <div class="col-sm-5 mb-2" style="display: none;">
                                    <div class="product-qty">
                                        <div class="qty-input">
                                            <input type="text" name="" value="1" min="1" readonly disabled>
                                        </div>
                                        <!-- <div class="qty-action">
                                            <button type="button" class="plus"><i class="icon-plus"></i> </button>
                                            <button type="button" class="minus"><i class="icon-minus"></i></button>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-2"> 
                                    <button type="button" class="btn btn-block btn-primary enquiry_btn" data-pid="<?php echo e($p->product_id); ?>">
                                        Enquiry Now</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
            <div class="no_records_found">
                No product(s) found.
            </div>
        <?php endif; ?>
        <div class="card mb-3">
            <div class="card-body pb-1 pt-3" id="my_content">
                <?php echo $category[0]['bottom_content']; ?>

            </div>
        </div>
    </div>
</section>
<?php /**PATH D:\work\asb\web work\sandblast.in\resources\views/frontend/inc/products.blade.php ENDPATH**/ ?>