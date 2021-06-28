@php
$session_prices = session( 'pro_price' );
@endphp

@if(!empty($session_prices))
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Qty</th>
            <th>Original Price</th>
            <th>Sale Price</th>
            <th>Remove</th>
        </tr>
        @foreach($session_prices as $key => $p)
        <tr>
            <td>{{ @$p['price_qty'] }} {{ $p['price_unit'] }}</td>
            <td>{{ $p['price_original_amount'] }}</td>
            <td>{{ $p['price_sale_amount'] }}</td>
            <td><a href="#" data-url="{{ url('rt-admin/ajax/remove_price') }}" data-key="{{ $key }}" class="remove_price">Remove</a></td>
        </tr>
        @endforeach
    </table>
</div>
@endif
