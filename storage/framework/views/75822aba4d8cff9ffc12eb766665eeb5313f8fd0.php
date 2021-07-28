<section id="home-slider">
    <div id="homeMainSlider" class="carousel slide" data-ride="carousel">
        <ul class="carousel-indicators">
            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li data-target="#homeMainSlider" data-slide-to="<?php echo e($k); ?>" <?php if($k==0): ?> class="active" <?php endif; ?>></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <div class="carousel-inner">
            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item <?php if($k == 0): ?> active <?php endif; ?>" style="text-align: center;">
                <img src="" data-src="<?php echo e(url('imgs/sliders/'.$s->slider_image)); ?>" class="lazy-load" alt="<?php echo e($s->slider_title); ?>">
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <a class="carousel-control-prev" href="#homeMainSlider" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#homeMainSlider" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</section>

<section class="home-section category-section">
    <div class="container">
        <h3 style="padding: 10px 0px 10px 0px;padding-left: 10px; margin-top: 10px;">
            Browse by Category
        </h3>

        <div id="owl-carousel-cat" class="owl-carousel owl-theme">
            <?php $__currentLoopData = $mcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item">
                <div class="category-block">

                    <div class="category-img">
                        <a href="<?php echo e(url($c->category_slug)); ?>" title="<?php echo e($c->category_name); ?>">
                            <?php if($c->category_image!=''): ?>
                            <img src="<?php echo e(url('imgs/ajax-loader.gif')); ?>" data-src="<?php echo e(url('imgs/category/'.$c->category_image)); ?>" class="lazy-load"  alt="<?php echo e($c->category_name); ?>">
                            <?php else: ?>
                            <img src="<?php echo e(url('imgs/ajax-loader.gif')); ?>" data-src="<?php echo e(url('imgs/sandblast.jpg')); ?>" class="lazy-load"  alt="<?php echo e($c->category_name); ?>">
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="category-title">
                        <a href="<?php echo e(url($c->category_slug)); ?>" title="<?php echo e($c->category_name); ?>">
                            <?php echo e($c->category_name); ?>

                        </a>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</section>

<?php if(!$mcategories->isEmpty()): ?>
<?php $__currentLoopData = $mcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<section class="home-section">
    <div class="container">
        <h3 style="margin-top:10px; ">
            <?php echo e($c->category_name); ?>

        </h3>

        <div class="owl-carousel owl-theme">
            <?php $__currentLoopData = $c->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $image = url( 'imgs/product/'.$p->product_image_medium );
            ?>
            <div class="item">
                <div class="card product-block product-card">
                    <a href="<?php echo e(url('product/'.$p->product_slug)); ?>"><img src="<?php echo e(url('imgs/ajax-loader.gif')); ?>" data-src="<?php echo e($image); ?>" class="main-image lazy lazy-load"  alt="<?php echo e($p->product_name); ?>" title="<?php echo e($p->product_name); ?>"></a>
                    <div class="card-body">
                        <h5 class="card-title" style="text-align: center;"><a href="<?php echo e(url('product/'.$p->product_slug)); ?>" title="<?php echo e($p->product_name); ?>"><?php echo e($p->product_name); ?></a></h5>

                        <div class="mt-2">
                            <div class="row">
                                <div class="col-sm-5 mb-2" style="display: none;">
                                    <div class="product-qty">
                                        <!-- <div class="qty-input">
                                            <input type="text" name="" value="1" min="1" readonly disabled>
                                        </div> -->
                                        <!-- <div class="qty-action">
                                            <button type="button" class="plus"><i class="icon-plus"></i> </button>
                                            <button type="button" class="minus"><i class="icon-minus"></i></button>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-2">
                                    <button type="button" class="btn btn-block btn-primary enquiry_btn" data-pid="<?php echo e($p->product_id); ?>">
                                        Enquiry Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<section id="home_content">
    <div class="container pt-2">
        <div class="card text-justify">
            <div class="card-body m-0 p-3">
                <h1 class="mt-0">Sand Blasting Machine</h1>
                Sand Blast manufacturers are specialize in Manufacturing of Sand Blating Machine and <a href="https://www.sandblast.in/product/shot-blasting-machine-1">Shot Blasting machine</a> at affordable price. Shot Blasting machine manufacturers are customized and slandered type portable shot blasting Equipments which are used to clean the surface. Sand blasting machine manufacturers provide Portable Sand Blasting Machine with various type portable blasting equipment like Blast Hopper, Blast Rooms, Blast Cabinet etc. Sand Blast manufacture wide range of portable shot blasting machine / sand blasting machine for various applications to meet the requirements of different sectors. We also manufacture vibratory finishing shot blasting machine, sand blasting chambers and automated sand & shot blasting machine.

                Sand blasting is a method used to clean, strengthen (peen) or polish metal and remove old paints. It's also called "Sand blasting graffiti removal machine". Shot blasting machine is used in almost every industry. In pneumatically operated machines, the media is accelerated by compressed air and is projected by nozzles/guns on the component to be blasted. Blasting can be dry blasting or wet blasting. The blasting task determines the choice of the abrasive media. Sand blasting machine is used in almost every industry that uses metal, including aerospace, automotive, construction, foundry, shipbuilding, rail, and many others.
                <ul class="p-0" style="list-style: inside disc;">
                    <li><a href="product/portable-sand-blasting-machine">Sand Blasting Machine Manufacturers</a> - Our teams consistent efforts and dedication enable us to carve a niche as a most trustworthy manufacturer and supplier of Sand Blasting Machine.</li>
                    <li>Buy Sand Blasting Machine - There are many different types of sand blasting machines such as Portable Sand Blasting Machine, Automatic Sand Blast, Sand Blast Cabinet, Tumblast and many more for sale.</li>
                    <li>Exporter, Suppler & Manufacturer of Heavy duty sandblasters, industrial sand blasting machine for automotive / metal / commercial usage and sale quality machines at competitive price.</li>
                    <li>Portable Shot blasting machine manufacturers - Apply the unique Process to custom design and build each grit blasting system to meet the customer's Procise application needs. Shot blasting machine price also depend on size, used material, and purpose. Mainly, <strong>Shot blasting machine price</strong> varies according to size and material.</li>
                    <li>Sand blasting machine manufacturers, Distributor of abrasive blast machines, blast hoses, couplings, media valves, breathing air systems, nozzles, R/C systems etc.</li>
                </ul>
                <h2 style="font-size: 20px;">
                    Shot Blasting Machine Manufacturers in India
                </h2>

                We have been working in the shot blasting industry for the last 12 years. Shot blasting machine price depends on various factors. Get the shot blasting machine price & other information by contacting us. You can learn from our blogs how to make shot blasting machine. And you can know how the shot blasting machine cost varies. We are providing shot blasting machine images, shot blast machine cost, shotblasting machine pdf in our blog.
            </div>
        </div>
    </div>
</section><?php /**PATH D:\work\asb\web work\sandblast.in\resources\views/frontend/inc/home.blade.php ENDPATH**/ ?>