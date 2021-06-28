<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Model\ProductModel as Prod;

use DB;

class ProductController extends BaseController {
    public function index(Request $request, $cat = null, $scat = null) {
        $query      = Prod::with(['prices', 'cat', 'scat']);

        $isCity = \Request::segment(1);
        $cat_City = \Request::segment(2);
        if($isCity == "city") {
          $city_slug = $cat;
          $cat       = null;
        }

        if(!empty($city_slug)) {
            $query->whereHas('city', function($q) use($city_slug) {
                $q->where('city_is_deleted', 'N')->where('city_slug', 'LIKE', $city_slug);
            });
        }

        if(!empty($cat)) {
            $query->whereHas('cat', function($q) use($cat) {
                $q->where('category_is_deleted', 'N')->where('category_slug', 'LIKE', $cat);
            });
        }

        if(!empty($scat)) {
            $query->whereHas('scat', function($q) use($scat) {
                $q->where('category_is_deleted', 'N')->where('category_slug', 'LIKE', $scat);
            });
        }
        $products   = $query->where('product_is_visible','Y' )->where('product_is_deleted','N')->get();

        // create url according cat 
        foreach( $products as $i => $p ) {
            $products[$i]['product_slug'] = $isCity == "city" ? $isCity.'/'.$cat_City.'/'.$p['product_slug'] : 'product/'.$p['product_slug'];;
        }


        // $mcat_name = ucwords( strtolower($mcat_name) );
        
        $category = Category::where('category_is_deleted', 'N')->where('category_slug', 'LIKE', $cat)->get()->toArray();
        // dd($category);
       $meta        = [
            'title'         => $category[0]['seo_title'],
            'keywords'      => $category[0]['seo_keyword'],
            'description'   => $category[0]['seo_description']
        ];
        // dd($category);
        $title 	= 'Products';

        $page   = "products";
        $data   = compact('page', 'title', 'products', 'category', 'meta');

        return view('frontend/layout', $data);
    }

    public function single(Request $request, $city, $slug = null) {
        if(empty($slug)) {
          $slug = $city;
          $city = null;
        }
        $record = Prod::with(['cat', 'scat','city'])->where('product_slug', $slug)->where('product_is_deleted', 'N')->first();
        $title       = $record->product_meta_title;
        $meta        = [
            'title'         => $record->product_meta_title,
            'keywords'      => $record->product_meta_keywords,
            'description'   => $record->product_meta_description
        ];

        $gall = DB::table('product_images')->where('pimage_pid', $record->product_id)->get();
        $related = prod::where('product_subcategory', $record->product_subcategory)
                       ->where('product_id', '!=' , $record->product_id)
                       ->get();


        $page         = "product-single";

        $data = compact('page', 'title' ,'record', 'gall', 'slug', 'meta');
        return view('frontend/layout', $data);
    }
}
