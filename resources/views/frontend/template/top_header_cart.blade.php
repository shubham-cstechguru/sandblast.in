@php
    $cartArr = [];
    if(!empty($cart_session)) {
        foreach($cart_session as $pid => $qty) {
            $cartduct = DB::table('products')->where('product_id', $pid)->first();
            $cartduct->qty = $qty;
            $cartArr[] = $cartduct;
        }
    }
@endphp
<div class="minicart_head clearfix">
    <div class="mini_arrow"></div>
    <div class="minicart_head_title float-left">
        Your Product
    </div>
    <div class="minicart_head_title float-right">
        Price
    </div>
</div>

<div class="minicart_body">
    @php $total = 0; @endphp
    @if(empty($cartArr))
    <div class="alert alert-danger text-center">
     <i class="icon-thumb_down_alt"></i> Your cart is empty.
    </div>
    @else
        @foreach($cartArr as $cart)
        @php
          $total += $country_code == 'IN' ? $cart->product_sell_price * $cart->qty : $cart->product_sell_price_dollar * $cart->qty;
        @endphp
        <div class="row pb-2 mb-2">
            <div class="col-3">
                <img src="{{ url('imgs/product/'.$cart->product_image) }}" title="Product" alt="Product">
                <i class="icon-close1 remove_item_from_cart" data-url="{{ url('ajax/remove-to-cart')
           }}" data-id="{{ $cart->product_id }}"></i>
            </div>

            <div class="col-6">
                <span class="minicart_pro_name">{{ $cart->product_name }}</span><br>
                <span class="minicart_pro_qty">Quantity: {{ $cart->qty }}</span>
            </div>

            <div class="col-3 pl-0">
                <div class="minicart_pro_price" style="white-space: nowrap;">
                    {{ $country_code == 'IN' ? '₹ '.round($cart->product_sell_price) : '$ '.round($cart->product_sell_price_dollar) }}
                </div>
            </div>
        </div>
        @endforeach

        <div class="minicart_total">
            <div class="row">
                <div class="col-6 ">
                    <strong>Total :</strong>
                </div>

                <div class="col-6   text-right">
                    {{ $country_code == 'IN' ? '₹ ' : '$ ' }}{{ $total }}
                </div>
            </div>
        </div>
    @endif
</div>
@if(!empty($cartArr))
<div class="minicart_footer">
    <div class="row">
        <div class="col-6">
            <a href="{{ url('cart') }}" class="minicart_btn btn-block text-center">Go To Cart</a>
        </div>

        <div class="col-6">
            <a href="{{ url('checkout') }}" class="minicart_btn btn-block text-center">Checkout</a>
        </div>
    </div>
</div>
@endif
