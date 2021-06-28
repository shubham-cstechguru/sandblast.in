<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Model\ProductModel as Product;
use App\Model\CityModel as City;
class ProductCity extends BaseController {

  public function index(Request $request){
      $ids = $request->ids;

      $productInfo = Product::findOrFail( $request->product_id )->toArray();

      foreach ($ids as $id) {
        $cityInfo = City::select('city_slug', 'city_name')->find($id);
        $arr = $productInfo;
        unset( $arr['product_id'] );

        $slug = $arr['product_slug']."-in-".$cityInfo->city_slug;

        $is_exists = Product::where('product_slug', 'LIKE', $slug)->count();

        if(!$is_exists):

          $arr['product_city'] = $id;
          $arr['product_slug'] .= "-in-".$cityInfo->city_slug;
          $arr['product_name'] .= " in ".$cityInfo->city_name;
          $arr['product_is_read'] = 0;
          $pid = Product::insertGetId( $arr );

        endif;
      }
  }

}
