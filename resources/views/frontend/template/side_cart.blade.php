<div class="your_basket">
    <h3>Your Basket</h3>
    @if(!empty($cart_products))
        @php
            $total = 0;
        @endphp
        <div class="card-products-list">
            @foreach($cart_products as $p)
                @php
                    $subtotal = $p->price_sale_amount * $p->qty;
                    $total    += $subtotal;
                    $image    = url( 'imgs/product/'.$p->product->product_image_medium );
                @endphp
            <div class="cart-product">
                <a href="#" data-url="{{ url('ajax/remove_cart') }}" data-pid="{{ $p->price_pid }}" data-priceid="{{ $p->price_id }}" class="remove_cart"><i class="icon-times-circle"></i></a>
                <div class="row">
                    <div class="col-3">
                        <img src="{{ $image }}" alt="">
                    </div>
                    <div class="col-6">
                        <h6>{{ $p->product->product_name }}</h6>
                        <p>
                            {{ $p->price_qty }} {{ $p->price_unit }} ₹{{ $p->price_sale_amount }} x {{ $p->qty }}
                        </p>
                    </div>
                    <div class="col-3">
                        <strong>₹{{ $subtotal }}</strong>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="cart-product">
            <div class="row">
                <div class="col-9">
                    SUBTOTAL
                </div>
                <div class="col-3">
                    ₹{{ $total }}
                </div>
            </div>
        </div>
        <div class="cart-product">
            <div class="row">
                <div class="col-9">
                    DELIVERY CHARGES
                </div>
                <div class="col-3">
                    FREE
                </div>
            </div>
        </div>
        <div class="cart-product">
            <div class="row">
                <div class="col-9">
                    <strong>TOTAL</strong>
                </div>
                <div class="col-3">
                    <strong>₹{{ $total }}</strong>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <button type="button" data-toggle="modal" data-target="#orderModal" class="btn btn-primary btn-block">Order Now</button>
        </div>
    @else
        <div class="no_records_found">
            Cart is empty.
        </div>
    @endif
</div>
