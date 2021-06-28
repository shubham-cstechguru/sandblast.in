<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class Cart extends BaseController
{
    public function index() {
        $cart_session = session('cart_session');
        $cart_session = !empty($cart_session) ? $cart_session : array();
//        print_r($cart_session);

        $cartArr = [];
        foreach($cart_session as $pid => $qty) {
            $product = DB::table('products')->where('product_id', $pid)->first();
            $product->qty = $qty;
            $cartArr[] = $product;
        }

//        echo '<pre>';
//        print_r($cartArr);
//        echo '</pre>';

        $title 	= "Chitrani | Cart";
        $page   = "cart";
        $data   = compact('page', 'title', 'cartArr');
        return view('frontend/layout', $data);
    }
}
