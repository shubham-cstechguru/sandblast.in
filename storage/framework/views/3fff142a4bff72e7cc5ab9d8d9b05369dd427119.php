<section id="product-section">
    <div class="container">
        <!-- <div class="card mb-2">
            <div class="card-body pb-1 pt-1">
                <h3 class="m-0">Browse Products</h3>
            </div>
        </div> -->
        <?php if(!$products->isEmpty()): ?>
        <div class="row">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $image = url( 'imgs/product/'.$p->product_image_medium );
            ?>
            <div class="col-sm-3 col-6">
                <div class="card product-block">
                    <a href="<?php echo e(url($p->product_slug)); ?>"><img src="<?php echo e($image); ?>" alt="<?php echo e($p->product_name); ?>" title="<?php echo e($p->product_name); ?>" class="main-image lazy"></a>
                    <div class="card-body">
                        <h5 class="card-title"><a href="<?php echo e(url($p->product_slug)); ?>" title="<?php echo e($p->product_name); ?>"><?php echo e($p->product_name); ?></a></h5>

                        <div class="mt-2">
                            <div class="row">
                                <div class="col-sm-5 mb-2">
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
                                <div class="col-sm-7 mb-2">
                                    <button type="button" class="btn btn-block btn-primary enquiry_btn" data-pid="<?php echo e($p->product_id); ?>">
                                        Enquiry Now <i class="icon-long-arrow-right"></i>
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
    </div>
</section>
<?php /**PATH /home/jodhpursand/public_html/resources/views/frontend/inc/products.blade.php ENDPATH**/ ?>