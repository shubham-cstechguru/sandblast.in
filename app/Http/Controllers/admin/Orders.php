<?php

namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Query;
use App\Model\OrderModel as Order;
use DB;
use Hash;

class Orders extends BaseController
{
    public function index(Request $request, $id = NULL)
    {

        $product_no = $request->input('products');
        $offset  = !empty($product_no) ? $product_no - 1 : 0;

        $query   = Order::orderBy('order_id', 'DESC');

        $search  = $request->input('search');
        // if(!empty($search['order_status'])) {
        //     $query->where('order_status', $search['order_status']);
        // }
        // if(!empty($search['order_is_paid'])) {
        //     $query->where('order_is_paid', $search['order_is_paid']);
        // }

        $records   = $query->paginate(20);

        if ($request->isMethod('post')) {
            $post = $request->input();

            // dd($post);

            if (!empty($post['check']) && !empty($post['order_status'])) {
                Order::whereIn('order_id', $post['check'])->update(['order_status' => $post['order_status']]);
                return redirect()->back()->with('success', 'Order status changed');
            }
        }


        $page     = "orders";
        $data     = compact('page', 'records', 'offset', 'search');
        return view('backend/layout', $data);
    }

    public function view(Request $request, $id = NULL)
    {
        $q     = new Query();
        $input = $request->input();

        $record  =   Order::with(['order_products', 'order_products.product'])->find($id);

        $page   = "single_orders";
        $data   = compact('page', 'record');
        return view('backend/layout', $data);
    }

    public function changestatus($id)
    {
        $order = Order::findorFail($id);
        if ($order->order_status == "pending") {
            $order->order_status = "complete";
            $order->update();
        } elseif ($order->order_status == "complete") {
            $order->order_status = "pending";
            $order->update();
        }
        return redirect()->back();
    }

    public function shiprocket_shipment(Request $request, $id = NULL)
    {
        $input = $request->input();

        $record    =   DB::table('orders as order')
            ->leftJoin('users as user', 'order.order_uid', '=', 'user.user_id')
            ->leftJoin('coupons AS c', 'order.order_coupon', '=', 'c.coupon_code')
            ->where('order_id', $id)->first();

        $ship    =   DB::table('order_products as op')
            ->where('op.opro_oid', $id)
            ->join('products as p', 'op.opro_pid', '=', 'p.product_id')
            ->get();

        $billing     = unserialize(html_entity_decode($record->order_billing));
        $shipping     = unserialize(html_entity_decode($record->order_shipping));


        // Create Shipment - Ship Rocket
        $api_base = "https://apiv2.shiprocket.in";
        $arr = [
            'email'     => "sudarshandubaga@gmail.com",
            'password'  => "sudarshan123"
        ];
        $response = Query::exe_post_curl("{$api_base}/v1/external/auth/login", $arr);

        if (!empty($response->token)) :
            $token    = $response->token;

            $headers  = [
                "Authorization: Bearer {$token}"
            ];
            $order_items = [];

            if (!$ship->isEmpty()) {
                foreach ($ship as $p) :
                    $order_items[] = [
                        'name'          => $p->product_name,
                        'sku'           => $p->product_code,
                        'tax'           => 0,
                        'custom_field'  => '',
                        'units'         => $p->opro_qty,
                        'selling_price' => $p->opro_price,
                        'discount'      => 0,
                        'hsn'           => "9503"
                    ];
                endforeach;
            }

            $billingNameArr = explode(" ", $billing['name']);
            $shippingNameArr = explode(" ", $shipping['name']);

            $billingNameArr[1] = !empty($billingNameArr[1])   ? $billingNameArr[1] : "";
            $shippingNameArr[1] = !empty($shippingNameArr[1]) ? $shippingNameArr[1] : "";

            if (!empty($billing['fname'])) {
                $billingNameArr[0] = $billing['fname'];
                $billingNameArr[1] = !empty($billing['lname']) ? $billing['lname'] : "";
            }

            if (!empty($shipping['fname'])) {
                $shippingNameArr[0] = $shipping['fname'];
                $shippingNameArr[1] = !empty($shipping['lname']) ? $shipping['lname'] : "";
            }

            $billingAddr1 = $billing['address1'];
            $billingAddr2 = $billing['address2'];
            if (empty($billing['address2'])) {
                $billingAddr2 = substr($billingAddr1, 80, 160);
                $billingAddr1 = substr($billingAddr1, 0, 80);
            }

            $shippingAddr1 = $shipping['address1'];
            $shippingAddr2 = $shipping['address2'];
            if (empty($billing['address2'])) {
                $shippingAddr2 = substr($shippingAddr1, 80, 160);
                $shippingAddr1 = substr($shippingAddr1, 0, 80);
            }

            $arr = [
                "order_id"               => $record->order_id,
                "order_date"             => $record->order_created_on,
                "channel_id"             => "37410",
                "billing_customer_name"  => $billingNameArr[0],
                "billing_last_name"      => @$billingNameArr[1],
                "billing_address"        => $billingAddr1,
                "billing_address_2"      => $billingAddr2,
                "billing_city"           => $billing['city'],
                "billing_state"          => $billing['state'],
                "billing_country"        => $billing['country'],
                "billing_pincode"        => $billing['postcode'],
                "billing_email"          => $billing['email'],
                "billing_phone"          => $billing['phone'],
                "shipping_is_billing"    => 1,
                "shipping_customer_name" => $shippingNameArr[0],
                "shipping_last_name"     => @$shippingNameArr[1],
                "shipping_address"       => $shippingAddr1,
                "shipping_address_2"     => $shippingAddr2,
                "shipping_city"          => $shipping['city'],
                "shipping_state"         => $shipping['state'],
                "shipping_country"       => $shipping['country'],
                "shipping_state"         => $shipping['postcode'],
                "shipping_email"         => $shipping['email'],
                "shipping_phone"         => $shipping['phone'],
                "order_items"            => $order_items,
                "payment_method"         => "Prepaid",
                "shipping_charges"       => "",
                "giftwrap_charges"       => "",
                "transaction_charges"    => "",
                "total_discount"         => $record->order_discount,
                "sub_total"              => $record->order_total,
                "length"                 => 1,
                "breadth"                => 1,
                "height"                 => 1,
                "weight"                 => 1,
            ];

            // print_r($arr); die;

            $response = Query::exe_post_curl("{$api_base}/v1/external/orders/create/adhoc", $arr, $headers);

            echo "<pre>";
            print_r($response);
        endif;

        if (!empty($response->status_code) && $response->status_code == 1) {
            return redirect()->back()->with('success', "Shipment created successfully.");
        }
    }
}
