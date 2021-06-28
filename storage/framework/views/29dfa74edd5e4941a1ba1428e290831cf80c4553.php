<?php
$mcategories = App\Model\Category::with(['scats' => function($q) {
$q->where('category_is_deleted', 'N');
}])->where('category_is_deleted', 'N')->where('category_parent', 0)->get();
?>

<!DOCTYPE html lang="en">

<head>
    <base href="<?php echo e(url('/').'/'); ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(empty($meta['title']) ? $site->setting_title : $meta['title']); ?></title>

    <?php if(!empty($meta)): ?>
    <meta name="keywords" content="<?php echo e(@$meta['keywords']); ?>">
    <meta name="description" content="<?php echo e(@$meta['description']); ?>">

    <meta property="og:type" content="website" />
    <meta property='og:locale' content='en_US' />
    <meta property="og:site_name" content="Sand Blast" />
    <meta property="og:title" content="<?php echo e(empty($meta['title']) ? $site->setting_title : $meta['title']); ?>" />
    <meta property="og:description" content="<?php echo e(@$meta['description']); ?>" />
    <meta property="og:image" content="<?php echo e(url('imgs/sliders/3.jpg')); ?>" />
    <link rel="canonical" href="<?php echo e(url()->current()); ?>" />

    <meta name="twitter:card" content="Sand Blasting Machine | Shot Blasting Machine" />
    <meta name="twitter:site" content="Sand Blast" />
    <meta name="twitter:title" content="<?php echo e(empty($meta['title']) ? $site->setting_title : $meta['title']); ?>" />
    <meta name="twitter:description" content="<?php echo e(@$meta['description']); ?>" />
    <meta name="twitter:image" content="<?php echo e(url('imgs/sliders/3.jpg')); ?>" />
    <?php endif; ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-FEW2E0RQ93"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-FEW2E0RQ93');
    </script>
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Manufacturer",
            "url": "https://www.sandblast.in/",
            "description": "<?php echo e(empty($meta['title']) ? $site->setting_title : $meta['title']); ?>"
            "Image": "<?php echo e(url('imgs/sliders/3.jpg')); ?>",
            "logo": "<?php echo e(url('imgs/logo.png')); ?>",
            "telephone": "+91 8003997469",
            "name": "Sand Blast",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "Jodhpur, Rajasthan",
                "addressRegion": "India",
                "postalCode": "342027",
                "streetAddress": "P.No. 324-25, 378-79-80, khasra No. 9/4, Shree Yade Gaun, Near Banar Ring Road"
            },
            "potentialAction": {
                "@type": "SearchAction",
                "target": "https://www.sandblast.in/?s={search_term}",
                "query-input": "required name=search_term"
            }



        }
    </script>

    <link rel="icon" href="<?php echo e(url('imgs/favicon.png')); ?>">

    <?php echo e(HTML::style('css/bootstrap.min.css')); ?>

    <?php echo e(HTML::style('css/owl.carousel.min.css')); ?>

    <?php echo e(HTML::style('css/owl.theme.default.min.css')); ?>

    <?php echo e(HTML::style('icomoon/style.css')); ?>

    <?php echo e(HTML::style('css/stylesheet.css')); ?>

    <?php echo e(HTML::style('css/jquery.fancybox.min.css')); ?>

    <?php echo e(HTML::style('css/style.css')); ?>


    <style>
        .sticky-container {
            /*background-color: #333;*/
            padding: 0px;
            margin: 0px;
            position: fixed;
            right: -124px;
            top: 230px;
            width: 200px;
            z-index: 99999;

        }

        /* style p when hover li */
        .sticky-first li:hover p {
            float: right;
        }

        .sticky li {
            list-style-type: none;
            background-color: #333;
            color: #efefef;
            height: 43px;
            padding: 0px;
            margin: 0px 0px 1px 0px;
            -webkit-transition: all 0.25s ease-in-out;
            -moz-transition: all 0.25s ease-in-out;
            -o-transition: all 0.25s ease-in-out;
            transition: all 0.25s ease-in-out;
            cursor: pointer;
            padding: 0px 10px;

        }

        .sticky li a {
            color: #fff;
        }

        .sticky li:hover {
            margin-left: -115px;
            /*-webkit-transform: translateX(-115px);
		-moz-transform: translateX(-115px);
		-o-transform: translateX(-115px);
		-ms-transform: translateX(-115px);
		transform:translateX(-115px);*/
            /*background-color: #8e44ad;*/

        }

        .sticky li img {
            float: left;
            margin: 5px 5px;
            margin-right: 10px;

        }

        .sticky li p {
            padding: 0px;
            margin: 0px;
            text-transform: uppercase;
            line-height: 43px;

        }

        .sticky li i {
            font-size: 24px;
            margin-top: 8px;
            display: inline-block;

        }

        .header-top a {
            color: #fff;
            transition: all .5s;
            font-weight: bold;
        }

        .header-top a i {
            color: #05c5b6;
        }

        .header-top a:hover {
            text-decoration: none;
            color: #05c5b6;

        }
    </style>
</head>

<body>
    <input type="hidden" id="base_url" value="<?php echo e(url('/')); ?>">
    <header>
        <div class="header-top" id="jp_header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-7 d-none d-sm-block">
                        <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(url('imgs/logo.png')); ?>" alt="sand blast logo"> </a>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-5 d-flex justify-content-between" style="align-items: center;">
                        <a href="tel:+917728877775"><i class="icon-call"></i> +91 7728877775</a>
                        &nbsp; &nbsp;
                        <a href="mailto:info@sandblast.in"><i class="icon-email"></i> info@sandblast.in</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-nav">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8 d-block d-sm-none" style="margin: 5px 0 0 0">
                        <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(url('imgs/logo.png')); ?>" alt="sand blast logo"> </a>
                    </div>
                    <div class="col-4 d-sm-none d-lg-none d-md-none clearfix">
                        <a href="#" class="nav-icon float-right"><i class="icon-navicon"></i></a>
                    </div>
                    <div class="col-sm-12">
                        <ul class="main-navbar">
                            <?php $__currentLoopData = $mcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(url($mc->category_slug)); ?>"><?php echo e($mc->category_name); ?></a>
                                <?php if(!empty($mc->scats->count())): ?>
                                <span class="icon-angle-down"></span>
                                <div class="clearfix"></div>
                                <?php endif; ?>
                                <?php if(!empty($mc->scats->count())): ?>
                                <ul>
                                    <?php $__currentLoopData = $mc->scats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a style="  overflow: hidden;  max-width: 45ch;  text-overflow: ellipsis;  white-space: nowrap;" href="<?php echo e(url($mc->category_slug.'/'.$sc->category_slug)); ?>"><?php echo e($sc->category_name); ?></a></li>
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
    </header><?php /**PATH D:\work\asb\web work\sandblast.in\resources\views/frontend/common/header.blade.php ENDPATH**/ ?>