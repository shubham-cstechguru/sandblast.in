<?php

namespace App\Http\Controllers;

use App\Http\Controllers\admin\Product;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Model\Slider;
use App\Model\Category;
use App\Model\ProductModel as Prod;

class HomeController extends BaseController {
    public function index(Request $request, $cat = NULL, $scat = NULL) {
     	$meta 	       = [
        'title'=>"Sand Blasting Machine Price | Shot Blasting Machine Manufacturers ",
        'keywords'=>'sand blasting machine price, sand blasting machine Manufacturers, sand blasting machine, shot blasting machine, shot blasting machine price, shot blasting machine manufacturers',
        'description'=>'Sand Blasting Machine Price, Shot Blasting Machine Manufacturers in India. Get free sand blasting machine price, shot blasting machine price from leading sand blasting machine manufacturers in India.'
      ];
     	$page 	       = "home";

     	$sliders       = Slider::where('slider_is_deleted', 'N')->get();

     $mcategories   = Category::with(['products' => function($q) {
         $q->where('product_is_deleted', 'N')->where('product_city', 0);
     }])->has('products')->where('category_is_deleted', 'N')->where('category_parent', 0)->get();


     	$data 	    = compact('page', 'meta', 'sliders', 'mcategories');
     	return view('frontend/layout', $data);
     }
}
