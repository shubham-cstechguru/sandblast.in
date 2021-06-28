<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Model\OrderModel as Order;
use App\Model\UserModel as User;
use App\Model\OrderProductModel as OrderProduct;
use App\Model\ProductModel as Product;
use App\Model\CountryModel as Country;
use Razorpay\Api\Api;
use DB;

class Checkout extends BaseController {
   public function index( Request $request ) {

       // try {
       //     Mail::send(['html' => 'emails.test'], ['text' => ''], function($message) {
       //          $message->to( 'sudarshandubaga@gmail.com', 'Sudarshan Dubaga' )->subject( 'Testing from Chitrani' );
       //          $message->from('sudarshandubaga@gmail.com', 'Chitrani');
       //     });
       //     echo 'Mail is sent.';
       // } catch (Exception $ex) {
       //     $err = $ex->getMessage();
       //     var_dump( $err );
       // }


    	$title 		  = "Checkout | Chitrani";
        $user         = session('user_auth');

        $cart_session = session('cart_session');
        $cart_session = !empty($cart_session) ? $cart_session : array();

        $cartArr = [];
        foreach($cart_session as $pid => $qty) {
            $product = Product::where('product_id', $pid)->first();
            $product->qty = $qty;
            $cartArr[] = $product;
        }

        $total = '0';
        foreach($cartArr as $orders) {
            $total += $orders->product_sell_price * $orders->qty;
        }

        if ($request->isMethod('post')) {
    		$input   = $request->input('record');

            $arr     = $input;
            $input['order_shipping']['name'] = trim( $input['order_shipping']['fname']." ".$input['order_shipping']['lname'] );
            $input['order_billing']['name']  = trim( $input['order_billing']['fname']." ".$input['order_billing']['lname'] );
            $arr['order_shipping'] = serialize( $input['order_shipping'] );
            $arr['order_billing']  = serialize( $input['order_billing'] );
            $arr['order_currency'] = $input['order_shipping']['country'] == "IN" ? "INR" : "USD";

            $user_id = session('user_auth');

            if(!empty($user_id))
            $arr['order_uid']      = $user_id;

            $id = Order::insertGetId($arr);

            $post = $request->input();
            if(!empty($post['create_an_account']) && !empty($post['user_password']) && $post['create_an_account'] == "yes") {
                $user_arr = [
                    'user_name'     => $input['order_shipping']['name'],
                    'user_email'    => $input['order_shipping']['email'],
                    'user_email'    => $input['order_shipping']['email'],
                    'user_password' => password_hash($post['user_password'], PASSWORD_BCRYPT, ['cost' => 10]),
                    'user_address1' => $input['order_shipping']['address1'],
                    'user_address2' => $input['order_shipping']['address2'],
                    'user_country'  => $input['order_shipping']['country'],
                    'user_state'    => $input['order_shipping']['state'],
                    'user_city'     => $input['order_shipping']['city'],
                    'user_pincode'  => $input['order_shipping']['postcode'],
                    'user_role'     => 'user',
                    'user_is_enable'=> 'Y'
                ];

                $arr['order_uid'] = User::insertGetId( $user_arr );
            }
            // if($input['order_shipping']['country'] != "IN") session(['order_id' => $id]);

            foreach($cartArr as $orders) {
                $oprice = $input['order_shipping']['country'] == "IN" ? $orders->product_sell_price : $orders->product_sell_price_dollar;
                $arr    = array(
                    'opro_oid'          =>  $id,
                    'opro_pid'          =>  $orders->product_id,
                    'opro_price'        =>  $oprice,
                    'opro_qty'          =>  $orders->qty,
                );

                $order_id = OrderProduct::insertGetId($arr);

                // return redirect('my-orders');
            }

            if($input['order_shipping']['country'] == "IN") {
                $api = new Api(config('custom.razor_key'), config('custom.razor_secret'));

                $amount = $input['order_amount'] * 100;
                echo '
                <style>
                .razorpay-payment-button {
                    opacity: 0;
                }
                </style>
                <form id="payForm" action="'.url('thank-you/'.$id).'" method="POST">
                    <script
                        src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="'.config('custom.razor_key').'"
                        data-amount="'.$amount.'"
                        data-currency="INR"
                        data-buttontext="Pay with Razorpay"
                        data-name="Chitrani"
                        data-description="We are a small workshop dedicated to creating exceptional natural wooden products for children."
                        data-image="'.url('imgs/Chitrani-Logo.png').'"
                        data-prefill.name="'.$input['order_billing']['name'].'"
                        data-prefill.email="'.$input['order_billing']['email'].'"
                        data-prefill.contact="'.$input['order_billing']['phone'].'"
                        data-theme.color="#05d6ac"
                    ></script>
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    </form>
                    <script>
                        window.onload = function() {
                            // document.getElementById(\'payForm\').submit();
                            document.querySelector(\'.razorpay-payment-button\').click();
                        }
                    </script>';
                die;
            } else {

                session(['2checkout_payment' => 'yes']);

                $amount = $input['order_amount'];
                $form = "<form id='payForm2checkout' action='https://www.2checkout.com/checkout/purchase' method='post'>
                        <input type='hidden' name='sid' value='203864612' >
                        <input type='hidden' name='mode' value='2CO' >";

                $i = 0;
                // foreach($cartArr as $pro) {
                //     $form .= "<input type='hidden' name='li_".$i."_type' value='product' >
                //         <input type='hidden' name='li_".$i."_name' value='".$pro->product_name."' >
                //         <input type='hidden' name='li_".$i."_product_id' value='".$pro->product_code."' >
                //         <input type='hidden' name='li_".$i."__description' value='".strip_tags($pro->product_description)."' >
                //         <input type='hidden' name='li_".$i."_price' value='".$pro->product_sell_price_dollar."' >
                //         <input type='hidden' name='li_".$i."_quantity' value='".$pro->qty."' >
                //         <input type='hidden' name='li_".$i."_tangible' value='N' >";
                //
                //     $i++;
                // }
                //
                // if(!empty($input['order_discount'])) {
                //     $form .= "<input type='hidden' name='li_".$i."_type' value='coupon' >
                //         <input type='hidden' name='li_".$i."_name' value='".$input['order_coupon']."' >
                //         <input type='hidden' name='li_".$i."_price' value='".$input['order_discount']."' >";
                //
                //     $i++;
                // }

                $form .= "<input type='hidden' name='li_".$i."_type' value='product' >
                    <input type='hidden' name='li_".$i."_name' value='".sprintf("#CHT%06d", $order_id)."' >
                    <input type='hidden' name='li_".$i."_product_id' value='".$order_id."' >
                    <input type='hidden' name='li_".$i."_description' value='' >
                    <input type='hidden' name='li_".$i."_price' value='".round($input['order_amount'], 2)."' >
                    <input type='hidden' name='li_".$i."_quantity' value='1' >
                    <input type='hidden' name='li_".$i."_tangible' value='N' >";

                $form .= "<input type='hidden' name='card_holder_name' value='".$input['order_billing']['name']."' />
                        <input type='hidden' name='street_address' value='".$input['order_billing']['address1']."' >
                        <input type='hidden' name='street_address2' value='".$input['order_billing']['address2']."' >
                        <input type='hidden' name='city' value='".$input['order_billing']['city']."' >
                        <input type='hidden' name='state' value='".$input['order_billing']['state']."' >
                        <input type='hidden' name='zip' value='".$input['order_billing']['postcode']."' >
                        <input type='hidden' name='country' value='".$input['order_billing']['country']."' >
                        <input type='hidden' name='email' value='".$input['order_billing']['email']."' >
                        <input type='hidden' name='phone' value='".$input['order_billing']['phone']."' >
                        <input type='hidden' name='order_id' value='".$id."' >
                    </form>

                    <script>
                        document.getElementById('payForm2checkout').submit();
                    </script>";
                echo $form;
                die;
            }
        }
        $record    = [];
        if(!empty($user)) {
            $record    = DB::table('users')->where('user_id', $user)->first();
        }
        // $addresses = DB::table('addresses')->where('add_uid', $user)->get();
        $countries = Country::get();


    	$page      = "checkout";
        // $page2     = "checkout";
    	$data      = compact('page', 'title', 'cartArr', 'record', 'total', 'countries');
    	return view('frontend/layout', $data);
    }
}
