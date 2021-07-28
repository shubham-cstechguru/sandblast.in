<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Model\WishlistModel as Wishlist;
use App\Query;
use Illuminate\Support\Facades\Mail;

use App\Model\ProductPrice;
use App\Model\OrderModel as Order;
use App\Model\OrderProductModel as OrderProduct;
use App\Model\ProductModel;
use DB;

class Ajax extends BaseController
{
    public function index(Request $request, $action = NULL)
    {
        // dd($request->all());
        $post   = $request->input();

        $param  = compact('post');
        $re     = call_user_func_array(array($this, $action), $param);

        return response()->json($re);
    }

    public function save_order($post = [])
    {

        $input      = $post['record'];
        $orderId    = Order::insertGetId($input);

        // $product    = Product::find( $input['order_pid'] );

        // $to          = $input['order_email'];
        // $from        = "sudarshandubaga@gmail.com";
        // $sender      = $input['order_name'];
        // $subject     = $input['order_name']." has put new enquiry for ".$product->product_name." on Sandblast";

        // $fields   = [
        //     'subject'    => $subject,
        //     'input'      => $input,
        //     'product'    => $product
        // ];

        // Mail::send(['html' => 'email.order_enquiry'], $fields, function($message) use ($to, $from, $subject, $sender) {
        //      $message->from($from, $sender);
        //      $message->to($to, 'Sandblast')
        //             ->subject($subject)
        //             ->replyTo($from, $sender);
        // });

        $re = [
            'status'    => TRUE,
            'message'   => 'Your order has been placed, we\'ll contact you shortly.',
        ];

        return $re;
    }

    public function search(Request $request)
    {
        if (!empty(request('search'))) {
            if ($request->search != '') {
                $products = ProductModel::where('product_is_deleted', 'N')->where('product_name', 'LIKE', '%' . $request->search . '%')->paginate(5);
                $li = '';
                foreach ($products as $product) {
                    $li .= '<li class="list-group-item"><a style="  overflow: hidden;  max-width: 45ch;  text-overflow: ellipsis;  white-space: nowrap;" href="' . url('product/'.$product->product_slug) . '">' . $product->product_name . '</a></li>';
                }
            } else {
                $li = '';
            }
        } else {
            $li = '';
        }

        return response()->json($li, 200);
    }
}
