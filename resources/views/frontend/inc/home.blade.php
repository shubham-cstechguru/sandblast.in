<section id="home-slider">
    <div id="homeMainSlider" class="carousel slide" data-ride="carousel">
        <ul class="carousel-indicators">
            @foreach($sliders as $k => $s)
            <li data-target="#homeMainSlider" data-slide-to="{{ $k }}" @if($k==0) class="active" @endif></li>
            @endforeach
        </ul>

        <div class="carousel-inner">
            @foreach($sliders as $k => $s)
            <div class="carousel-item @if($k == 0) active @endif">
                <img src="{{ url('imgs/sliders/'.$s->slider_image) }}" alt="{{ $s->slider_title }}">
            </div>
            @endforeach
        </div>

        <a class="carousel-control-prev" href="#homeMainSlider" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#homeMainSlider" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</section>

<section class="home-section">
    <div class="container">
        <h3 style="padding: 10px 0px 10px 0px;padding-left: 10px; margin-top: 10px;">
            Browse by Category
        </h3>

        <div id="owl-carousel-cat" class="owl-carousel owl-theme">
            @foreach($mcategories as $c)
            <div class="item">
                <div class="category-block">

                    <div class="category-img">
                        <a href="{{ url($c->category_slug) }}" title="{{ $c->category_name }}">
                            @if($c->category_image!='')
                            <img src="{{ url('imgs/category/'.$c->category_image) }}" alt="{{ $c->category_name }}">
                            @else
                            <img src="{{ url('imgs/sandblast.jpg') }}" alt="{{ $c->category_name }}">
                            @endif
                        </a>
                    </div>
                    <div class="category-title" style="text-align:center;font-size:18px; font-weight:bold;padding:10px;">
                        <a href="{{ url($c->category_slug) }}" title="{{ $c->category_name }}">
                            {{ $c->category_name }}
                        </a>
                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

@if(!$mcategories->isEmpty())
@foreach($mcategories as $c)
<section class="home-section">
    <div class="container">
        <h3 style="margin-top:10px; ">
            {{ $c->category_name }}
        </h3>

        <div class="owl-carousel owl-theme">
            @foreach($c->products as $p)
            @php
            $image = url( 'imgs/product/'.$p->product_image_medium );
            @endphp
            <div class="item">
                <div class="card product-block">
                    <a href="{{ url('product/'.$p->product_slug) }}"><img src="{{ $image }}" alt="{{ $p->product_name }}" title="{{ $p->product_name }}" class="main-image lazy"></a>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{ url('product/'.$p->product_slug) }}" title="{{ $p->product_name }}">{{ $p->product_name }}</a></h5>

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
                                    <button type="button" class="btn btn-block btn-primary enquiry_btn" data-pid="{{ $p->product_id }}">
                                        Enquiry Now <i class="icon-long-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endforeach
@endif
<section id="home_content">
    <div class="container">
        <div class="card text-justify mb-3">
            <div class="card-body">
                <h1 class="mt-0"> Sand Blasting Machine</h1>
                Airo Shot blasting machine manufacturers are specialize in Manufacturing of Sand Blating Machine and Shot Blasting machine at affordable price. Shot Blasting machine manufacturers are customized and slandered type portable shot blasting Equipments which are used to clean the surface. Sand blasting machine manufacturers provide Portable Sand Blasting Machine with various type portable blasting equipment like Blast Hopper, Blast Rooms, Blast Cabinet etc. Airo Shot blasting manufacture wide range of portable shot blasting machine / sand blasting machine for various applications to meet the requirements of different sectors. We also manufacture vibratory finishing shot blasting machine, sand blasting chambers and automated sand & shot blasting machine.

                Sand blasting is a method used to clean, strengthen (peen) or polish metal and remove old paints. It's also called "Sand blasting graffiti removal machine". Shot blasting machine is used in almost every industry. In pneumatically operated machines, the media is accelerated by compressed air and is projected by nozzles/guns on the component to be blasted. Blasting can be dry blasting or wet blasting. The blasting task determines the choice of the abrasive media. Sand blasting machine is used in almost every industry that uses metal, including aerospace, automotive, construction, foundry, shipbuilding, rail, and many others.
                <ul class="p-0" style="list-style: inside disc;">
                    <li><a href="product/portable-sand-blasting-machine">Sand Blasting Machine Manufacturers</a> - Our teams consistent efforts and dedication enable us to carve a niche as a most trustworthy manufacturer and supplier of Sand Blasting Machine.</li>
                    <li>Buy Sand Blasting Machine - There are many different types of sand blasting machines such as Portable Sand Blasting Machine, Automatic Sand Blast, Sand Blast Cabinet, Tumblast and many more for sale.</li>
                    <li>Exporter, Suppler & Manufacturer of Heavy duty sandblasters, industrial sand blasting machine for automotive / metal / commercial usage and sale quality machines at competitive price.</li>
                    <li>Portable Shot blasting machine manufacturers - Apply the unique Process to custom design and build each grit blasting system to meet the customer's Procise application needs. Shot blasting machine price also depend on size, used material, and purpose. Mainly, Shot blasting machine price varies according to size and material.</li>
                    <li>Sand blasting machine manufacturers, Distributor of abrasive blast machines, blast hoses, couplings, media valves, breathing air systems, nozzles, R/C systems etc.</li>
                </ul>
                <h2>
                    Shot Blasting Machine Manufacturers in India
                </h2>

                We have been working in the sand blasting industry for the last 12 years. Sand blasting machine price depends on various factors. Get the sand blasting machine price & other information by contacting us. You can learn from our blogs how to make sand blasting machine. And you can know how the sand blasting machine cost varies. We are providing sand blasting machine images, sand blast machine cost, sandblasting machine pdf in our blog.
            </div>
        </div>
    </div>
</section>