<?php

namespace App\Http\Controllers;

use App\Http\Controllers\admin\Product;
use Illuminate\Routing\Controller as BaseController;
use Razorpay\Api\Api;
use App\Model\OrderModel as Order;
use App\Model\OrderProductModel as OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ThanksController extends BaseController {
   public function index(Request $request, $order_id) {
       $input   = $request->input();
       // print_r($input);
       $api     = new Api(config('custom.razor_key'), config('custom.razor_secret'));

       if(count($input)  && !empty($input['razorpay_payment_id'])) {
           $payment = $api->payment->fetch($input['razorpay_payment_id']);
           try {
               $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));

               $arr = [
                   'order_is_paid'  => 'Y',
                   'order_txn_id'   => $input['razorpay_payment_id']
               ];
               Order::where('order_id', $order_id)->update($arr);

               $oproducts = OrderProduct::join('products AS p', 'order_products.opro_pid', 'p.product_id')->where('opro_oid', $order_id)->get();

               session()->forget('cart_session');

               $order_info      = Order::where('order_id', $order_id)->first();
               $billing         = unserialize( $order_info->order_billing );
               $shipping        = unserialize( $order_info->order_shipping );

               // dd($billing);

               $to              = $billing['email'];
               $name            = $billing['name'];
               $subject         = "Order Confirmation Mail - Chitrani";
               $text            = '<h3>Thank you for placing your order.</h3>
       			<p>Your order reference no. is {{ $order_no }}.</p>
       			<p style="text-align: justify;">You\'ve successfully done your payment process. Your order is being processed and you will shortly recieve your order.</p>';

               $currency = $order_info->order_currency == 'INR' ? '₹' : '$';
               $fields   = [
                   'subject'    => $subject,
                   'billing'    => $billing,
                   'shipping'   => $shipping,
                   'oproducts'  => $oproducts,
                   'order_no'   => sprintf('#CHT%06d', $order_id),
                   'currency'   => $currency,
                   'order_info' => $order_info
               ];

               Mail::send(['html' => 'email.order_mail'], $fields, function($message) use ($to, $subject, $name) {
                    $message->to( $to, $name )->subject( $subject );
                    $message->from('orders@chitrani.com', 'Chitrani');
               });

               $to          = "orders@chitrani.com";
               $name        = "Shanky";

               Mail::send(['html' => 'email.order_mail'], $fields, function($message) use ($to, $subject, $name) {
                    $message->to($to, $name)->subject($subject);
                    $message->from('orders@chitrani.com', 'Chitrani');
               });

           } catch (\Exception $e) {
               return  $e->getMessage();

               return redirect()->back();
           }

           // Do something here for store payment details in database...
       }

       // print_r($response);

       echo '<center>
            <h1>Payment done! Thank you for your order.</h1>
            <p>Please wait, Redirecting you in few moments...</p>
       </center>
       <script>
        setTimeout(function() {
            window.location = "'.url('/').'";
        }, 5000);
       </script>
       ';
    }

    public function callback(Request $request) {
        $input = $request->input();

        $order_session = session('2checkout_payment');
        if(!empty($input['order_id']) && !empty($input['order_number'])) {
            $order_id = $input['order_id'];
            $old_order_info      = Order::where('order_id', $order_id)->first();
            session()->forget('2checkout_payment');

            $arr = [
                'order_is_paid'  => 'Y',
                'order_txn_id'   => $input['order_number']
            ];
            Order::where('order_id', $order_id)->update($arr);

            session()->forget('cart_session');

            $oproducts = OrderProduct::join('products AS p', 'order_products.opro_pid', 'p.product_id')->where('opro_oid', $order_id)->get();

            $order_info      = Order::where('order_id', $order_id)->first();
            $billing         = unserialize( $order_info->order_billing );
            $shipping        = unserialize( $order_info->order_shipping );

            if(!empty($old_order_info->order_is_paid) && $old_order_info->order_is_paid == "N") :
                $to              = $billing['email'];
                $name            = $billing['name'];
                $subject         = "Order Confirmation Mail - Chitrani";
                $text            = '<h3>Thank you for placing your order.</h3>
                 <p>Your order reference no. is {{ $order_no }}.</p>
                 <p style="text-align: justify;">You\'ve successfully done your payment process. Your order is being processed and you will shortly recieve your order.</p>';

                $currency = $order_info->order_currency == 'INR' ? '₹' : '$';
                $fields   = [
                    'subject'    => $subject,
                    'billing'    => $billing,
                    'shipping'   => $shipping,
                    'oproducts'  => $oproducts,
                    'order_no'   => sprintf('#CHT%06d', $order_id),
                    'currency'   => $currency,
                    'order_info' => $order_info
                ];

                Mail::send(['html' => 'email.order_mail'], $fields, function($message) use ($to, $subject, $name) {
                     $message->to( $to, $name )->subject( $subject );
                     $message->from('orders@chitrani.com', 'Chitrani');
                });

                $to          = "orders@chitrani.com";
                $name        = "Chitrani";

                Mail::send(['html' => 'email.order_mail'], $fields, function($message) use ($to, $subject, $name) {
                     $message->to($to, $name)->subject($subject);
                     $message->from('orders@chitrani.com', 'Chitrani');
                });

            endif;

            echo "<html>
                <head>
                    <title>Chitrani - Payment Confirmation</title>
                    <script>
                      gtag('event', 'conversion', {
                          'send_to': 'AW-970494098/jP3ACI-22LEBEJKh4s4D',
                          'transaction_id': ''
                      });
                    </script>
                </head>
                <body>
                    <center>
                         <h1>Payment done! Thank you for your order.</h1>
                         <p>Please wait, Redirecting you in few moments...</p>
                    </center>
                </body>
            </html>";

        } else {
            echo '<center>
                 <h1>Invalid Request!</h1>
                 <p>Please wait, Redirecting you in few moments...</p>
            </center>';
        }

        echo '
        <script>
         setTimeout(function() {
             window.location = "'.url('/').'";
         }, 5000);
        </script>
        ';
    }
}
