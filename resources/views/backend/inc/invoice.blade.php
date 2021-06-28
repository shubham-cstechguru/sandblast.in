@php
    function convert_number_to_words($number, $currency) {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred','thousand','lakh', 'crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        return ($Rupees ?  $currency . ' ' . strtoupper($Rupees . ' Only') : '');
    }
@endphp
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Invoice No. {{ $order_info->order_invoice_no }} | Chitrani</title>
        <style>
        body {
            font-family: Arial;
            background: #ebebeb;
            margin: 0;
            font-size: 12px;
            color: #000;
        }
        * {
            box-sizing: border-box;
            font-size: 10px;
        }
        h1 {
            margin: 0;
            margin-bottom: 10px;
        }
        .text-center {
            text-align: center!important;
        }
        .mb-1 {
            margin-bottom: 10px;
        }
        .p10 {
            padding: 10px;
        }
        .paper {
            width: 210mm;
            margin: 10px auto;
            background: #fff;
            padding: 10px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th {
            font-weight: bolder;
            white-space: nowrap;
        }
        .table th, .table td {
            padding: 3px;
            text-align: left;
        }
        .table, .table th, .table td {
            border: 1px solid #000;
        }

        @media print {
            body {
                background: #fff;
            }
            @page {
                margin: 10px;
            }
        }
        </style>
    </head>
    <body>
        <div class="paper">
            <div class="text-center mb-1">
                <strong>TAX INVOICE</strong>
            </div>
            <table class="table">
                <tr>
                    <td colspan="2" rowspan="5" style="width: 30%;">
                        <img src="{{ url('imgs/Chitrani-Logo.png') }}" alt="">
                    </td>
                    <td colspan="4" rowspan="5" class="text-center">
                        <h1 style="font-size: 22px;">CHITRANI HANDICRAFT</h1>
                        <div class="">
                            Plot #353 Street 9th Mohan B, BJS Colony<br>
                            Jodhpur, Rajasthan 342006, India<br><br>
                            <strong>Mob No.:</strong> 7733012342<br>
                            <strong>Email:</strong> info@chitrani.com
                        </div>
                    </td>
                    <th>GSTIN</th>
                    <td colspan="2">08BPDPS3658M1Z7</td>
                </tr>
                <tr>
                    <th>Order No.</th>
                    <td colspan="2">{{ sprintf('#CHT%06d', $order_info->order_id) }}</td>
                </tr>
                <tr>
                    <th>Order Date</th>
                    <td colspan="2">{{ date('d / m / Y', strtotime($order_info->order_created_on)) }}</td>
                </tr>
                <tr>
                    <th>Invoice No.</th>
                    <td colspan="2">{{ $order_info->order_invoice_no }}</td>
                </tr>
                <tr>
                    <th>Invoice Date</th>
                    <td colspan="2">{{ date('d / m / Y', strtotime($order_info->order_invoice_date)) }}</td>
                </tr>
                <tr>
                    <th colspan="4" style="width: 50%; background: #ebebeb;">BILLING ADDRESS</th>
                    <th colspan="5" style="width: 50%; background: #ebebeb;">SHIPPING ADDRESS</th>
                </tr>
                @php
                    $billing    = @unserialize( html_entity_decode( $order_info->order_billing ) );
                    $oproipping   = @unserialize( html_entity_decode( $order_info->order_shipping ) );

                    $sn = $total = 0;
                @endphp
                <tr>
                    <td colspan="4">
                        <strong>{{ @$billing['name'] }}</strong><br>
                        {{ @$billing['phone'] }}<br>
                        {{ @$billing['email'] }}<br><br>

                        <strong>{{ @$billing['company'] }}</strong><br>
                        {{ @$billing['address1'] }}<br>
                        {{ @$billing['address2'] }}<br>
                        {{ @$billing['city'].' '.@$billing['state'].' '.@$billing['country'].' '.@$billing['postcode'] }}
                    </td>
                    <td colspan="5">
                        <strong>{{ @$oproipping['name'] }}</strong><br>
                        {{ @$oproipping['phone'] }}<br>
                        {{ @$oproipping['email'] }}<br><br>

                        <strong>{{ @$oproipping['company'] }}</strong><br>
                        {{ @$oproipping['address1'] }}<br>
                        {{ @$oproipping['address2'] }}<br>
                        {{ @$oproipping['city'].' '.@$oproipping['state'].' '.@$oproipping['country'].' '.@$oproipping['postcode'] }}
                    </td>
                </tr>
                <tr>
                    <th class="text-center" style="width: 10px;">SN</th>
                    <th class="text-center" colspan="2">ITEM DESCRIPTION</th>
                    <th class="text-center">ITEM CODE</th>
                    <th class="text-center">PRICE</th>
                    <th class="text-center">QTY</th>
                    <th class="text-center">AMOUNT</th>
                    <th class="text-center">DISCOUNT @if(!empty($order_info->order_coupon)) <small>( {{ $order_info->coupon_discount }}% )</small> @endif</th>
                    <th class="text-center">SUBTOTAL</th>
                </tr>
                @php  $sn = $grandtotal = $totSubtotal = $totDiscount = 0; @endphp
                @foreach($order_info->order_products as $opro)
                    @php
                        $subtotal   = $opro->opro_price * $opro->opro_qty;
                        $total     += $subtotal;

                        $sn++;
                        $rate   	= $opro->opro_price;
                        $total 		= $rate * $opro->opro_qty;
                        $discount 	= !empty($order_info->coupon_discount) ? round($total * $order_info->coupon_discount / 100, 2) : 0;
                        $total 	   -= $discount;

                        $totSubtotal    += $rate * $opro->opro_qty;
                        $grandtotal 	+= $total;
                        $totDiscount 	+= $discount;
                    @endphp
                <tr>
                    <td>{{ $sn }}.</td>
                    <td colspan="2">{{ $opro->product->product_name }}</td>
                    <td>{{ $opro->product->product_code }}</td>
                    <td>{{ $order_info->order_currency == 'INR' ? '₹' : '$' }} {{ $rate }}</td>
                    <td>{{ $opro->opro_qty }}</td>
                    <td>{{ $order_info->order_currency == 'INR' ? '₹' : '$' }} {{ $rate * $opro->opro_qty }}</td>
                    <td>{{ $order_info->order_currency == 'INR' ? '₹' : '$' }} {{ $discount }}</td>
                    <td>{{ $order_info->order_currency == 'INR' ? '₹' : '$' }} {{ $total }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="6" style="background: #ebebeb;">
                        <strong style=" font-size: 16px;">TOTAL</strong>
                        @if($order_info->order_currency == 'INR' && @$oproipping['state'] == "Rajasthan")
                            (Includes (CGST @ 6%) ₹ {{ round($grandtotal / 106 * 6, 2) }} (SGST @ 6%) ₹ {{ round($grandtotal / 106 * 6, 2) }})
                        @elseif($order_info->order_currency == 'INR' && @$oproipping['state'] != "Rajasthan")
                            (Includes (IGST @ 12%) ₹ {{ round($grandtotal / 112 * 12, 2) }})
                        @endif
                    </td>
                    <td style="background: #ebebeb; font-size: 16px;"><strong>{{ $order_info->order_currency == 'INR' ? '₹' : '$' }} {{ $totSubtotal }}</strong></td>
                    <td style="background: #ebebeb; font-size: 16px;"><strong>{{ $order_info->order_currency == 'INR' ? '₹' : '$' }} {{ $totDiscount }}</strong></td>
                    <td style="background: #ebebeb; font-size: 16px;"><strong style=" font-size: 16px;">{{ $order_info->order_currency == 'INR' ? '₹' : '$' }} {{ round($grandtotal) }}</strong></td>
                </tr>
                <!-- <tr>
                    <td colspan="6"><strong>Subtotal</strong>
                        @if($order_info->order_currency == 'INR' && @$oproipping['state'] == "Rajasthan")
                            (Includes (CGST @ 6%) ₹ {{ round($total / 106 * 6, 2) }} (SGST @ 6%) ₹ {{ round($total / 106 * 6, 2) }})
                        @elseif($order_info->order_currency == 'INR' && @$oproipping['state'] != "Rajasthan")
                            (Includes (IGST @ 12%) ₹ {{ round($total / 112 * 12, 2) }})
                        @endif
                    </td>
                    <th>{{ $order_info->order_currency == 'INR' ? '₹' : '$' }} {{ $total }}</th>
                </tr> -->

                <!-- <tr>
                    <th colspan="6">Discount</th>
                    <td>{{ $order_info->order_currency == 'INR' ? '₹' : '$' }} {{ $order_info->order_discount }}</td>
                </tr> -->
                @php
                    $currency = $order_info->order_currency == 'INR' ? 'RUPEES' : 'DOLLAR';
                @endphp
                <tr>
                    <th><strong>IN WORDS</strong></th>
                    <td colspan="8"><strong>{{ convert_number_to_words(round($grandtotal), $currency) }}</strong></td>
                </tr>

                <tr>
                    <th colspan="4" class="text-center">Notes</th>
                    <th colspan="5" rowspan="2" class="text-center">
                        For Chitrani Handicraft<br><br>
                        <img src="{{ url('imgs/signature.png') }}" alt="" style="max-width: 100%;"><br><br>
                        Authorized Signatory
                    </th>
                </tr>

                <tr>
                    <td colspan="4" valign="top" style="height: 120px;">{!! nl2br($order_info->order_notes) !!}</td>
                </tr>
            </table>
        </div>
    </body>
</html>
