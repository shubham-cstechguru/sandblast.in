<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Model\OrderModel as Order;
use App\Query;

class InvoiceController extends BaseController {
    public function create( Request $request, $id ) {
        $order_info = Order::find( $id );

        if(empty($order_info->order_id)) {
            return redirect( url('rt-admin/orders') );
        }

        if($request->isMethod('post')) {
            $post = $request->input('record');
            $check = Order::where('order_invoice_no', $post['order_invoice_no'])->count();

            if(!$check) :
                $post['order_invoice_date'] = date('Y-m-d', time());

                Order::where('order_id', $id)->update( $post );

                return redirect( url('rt-admin/orders/') );
            else:
                return redirect()->back()->with('danger', 'Invoice no. already exists.');
            endif;
        }

        $invoice_max = Order::max('order_invoice_no');
        $invoice_no  = $invoice_max + 1;

        $page 	= "create_invoice";
    	$data 	= compact('page', 'order_info', 'invoice_no');
    	return view('backend/layout', $data);
    }
    public function index( Request $request, $id ) {
        $order_info = Order::with(['order_products', 'order_products.product'])->leftJoin('coupons AS c', 'orders.order_coupon', '=', 'c.coupon_code')->find( $id );

        if(empty($order_info->order_id)) {
            return redirect( url('rt-admin/orders') );
        }

    	$data 	= compact('order_info');
    	return view('backend/inc/invoice', $data);
    }
}
