@php
$cart_session = session('cart_session');
$cart_session = !empty($cart_session) ? $cart_session : array();

$cartArr = [];
foreach($cart_session as $pid => $qty) {
    $product = DB::table('products')->where('product_id', $pid)->first();
    $product->qty = $qty;
    $cartArr[] = $product;
}

$total = 0;
foreach($cartArr as $orders) {
    $total += $orders->product_sell_price * $orders->qty;
}

$coupon_code = session('coupon_code');
$discount    = 0;
@endphp
<div class="col-lg-5">
    <table class="table">
        @php $total = 0; @endphp
        @foreach($cartArr as $cart)
            @php
                $subtotal = $country_code == 'IN' ? $cart->product_sell_price * $cart->qty : $cart->product_sell_price_dollar * $cart->qty;
                $total   += $subtotal;
            @endphp
            <tr>
                <td>{{ $cart->product_name }}</td>
                <td>x {{ $cart->qty }}</td>
                <td class="text-right">{{ $country_code == 'IN' ? '₹ '.$subtotal : '$ '.$subtotal }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2">Subtotal</td>
            <th class="text-right">{{ $country_code == 'IN' ? '₹ '.round($total,2) : '$ '.round($total,2) }}</th>
        </tr>
    </table>
</div>
@php
    $gtotal = $total;
@endphp
<div class="col-lg-5 offset-lg-1">
    @if(empty($coupon_code))
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <input type="text" id="order_coupon_code" value="" class="form-control" placeholder="Gift cart or discount code">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <button type="button" class="btn btn-dark btn-block coupon_apply_btn">Apply</button>
                </div>
            </div>
        </div>
    @else
        @php
            $coupon_info = DB::table('coupons')->where('coupon_code', $coupon_code)->first();

            if(empty($coupon_info->coupon_include_products) && empty($coupon_info->coupon_exclude_products)) {
                $discount    = round($total * $coupon_info->coupon_discount / 100);
            } else {
                $discount    = 0;
            }

            if(!empty($coupon_info->coupon_include_products) && !empty($coupon_info->coupon_exclude_products)) {
                $inc_pros = explode(",", $coupon_info->coupon_include_products);
                $exl_pros = explode(",", $coupon_info->coupon_exclude_products);

                foreach($cartArr as $cart) {
                    $subtotal = $country_code == 'IN' ? $cart->product_sell_price * $cart->qty : $cart->product_sell_price_dollar * $cart->qty;
                    if(in_array($cart->product_id, $inc_pros) && !in_array($cart->product_id, $exl_pros)) {
                        $discount += $subtotal * $coupon_info->coupon_discount / 100;
                    }
                }
            } elseif(!empty($coupon_info->coupon_include_products)) {
                $inc_pros = explode(",", $coupon_info->coupon_include_products);

                foreach($cartArr as $cart) {
                    $subtotal = $country_code == 'IN' ? $cart->product_sell_price * $cart->qty : $cart->product_sell_price_dollar * $cart->qty;
                    if(in_array($cart->product_id, $inc_pros)) {
                        $discount += $subtotal * $coupon_info->coupon_discount / 100;
                    }
                }
            } elseif(!empty($coupon_info->coupon_exclude_products)) {
                $exl_pros = explode(",", $coupon_info->coupon_exclude_products);

                foreach($cartArr as $cart) {
                    $subtotal = $country_code == 'IN' ? $cart->product_sell_price * $cart->qty : $cart->product_sell_price_dollar * $cart->qty;
                    if(!in_array($cart->product_id, $exl_pros)) {
                        $discount += $subtotal * $coupon_info->coupon_discount / 100;
                    }
                }
            }

            $gtotal -= $discount;
        @endphp
        <div class="row mb-2">
            <div class="col-8">
                Coupon Code <strong>{{ $coupon_code }}</strong> Applied
            </div>
            <div class="col-4 text-right">
                <a href="#remove_coupon_code"><i class="icon-times"></i> Remove</a>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-8">
                Discount ({{ $coupon_info->coupon_discount }}%)
            </div>
            <div class="col-4 text-right">
                {{ $country_code == 'IN' ? '₹ '.$discount : '$ '.$discount }}
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-8">
            Shipping
        </div>
        <div class="col-4 text-right">
            Free shipping
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-4">
            Total
        </div>
        <div class="col-8 text-right subtotal">
            @if($country_code == "IN")
                (includes ₹ {{ round($gtotal / 112 * 12, 2) }} IGST)
                <span>₹ {{ round($gtotal,2) }}</span>
            @else
                <span>$ {{ round($gtotal,2) }}</span>
            @endif
        </div>
    </div>
    <p class="text-center" style="font-size: 12px;">
        Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.
    </p>

    <input type="hidden" name="record[order_total]" value="{{ $total }}">
    <input type="hidden" name="record[order_discount]" value="{{ $discount }}">
    <input type="hidden" name="record[order_amount]" value="{{ $gtotal }}">
    <input type="hidden" name="record[order_coupon]" value="{{ $coupon_code }}">

    <div class="text-center">
        <label class="xbox">
            <input type="checkbox" id="checkAgree" checked required>
            <span class="checkmark"></span>
            <span class="name">I have read and agree to the website terms and conditions</span>
        </label>
        <button type="submit" class="btn minicart_btn">Place order</button>
    </div>
</div>
