<section id="product-section">
    <div class="container">
       <div class="card mb-2">
            <div class="card-body pb-1 pt-3" id="my_content">
                <h1>{{ $category[0]['category_name'] }}</h1>
                {!! $category[0]['top_content'] !!}
            </div>
        </div>
        @if(!$products->isEmpty())
        <div class="row">
            @foreach($products as $p)
            @php
                $image = url( 'imgs/product/'.$p->product_image_medium );
            @endphp
            <div class="col-sm-3 col-6">
                <div class="card product-block">
                    <a href="{{ url($p->product_slug) }}"><img src="{{ $image }}" alt="{{ $p->product_name }}" title="{{ $p->product_name }}" class="main-image lazy"></a>
                    <div class="card-body">
                        <h2 class="card-title"><a href="{{ url($p->product_slug) }}" title="{{ $p->product_name }}">{{ $p->product_name }}</a></h2>

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
        @else
            <div class="no_records_found">
                No product(s) found.
            </div>
        @endif
        <div class="card mb-3">
            <div class="card-body pb-1 pt-3" id="my_content">
                {!! $category[0]['bottom_content'] !!}
            </div>
        </div>
    </div>
</section>
