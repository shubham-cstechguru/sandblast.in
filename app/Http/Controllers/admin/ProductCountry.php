<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Model\ProductModel as Product;
use App\Model\CountryModel as Country;
use App\Model\CountryModel;

class ProductCountry extends BaseController {

  public function index(Request $request){
      $ids = $request->ids;

      $productInfo = Product::findOrFail( $request->product_id )->toArray();

      foreach ($ids as $id) {
        $countryInfo = Country::select('country_slug', 'country_name')->find($id);
        $arr = $productInfo;
        unset( $arr['product_id'] );

        $slug = $arr['product_slug']."-in-".$countryInfo->country_slug;

        $is_exists = Product::where('product_slug', 'LIKE', $slug)->count();

        if(!$is_exists):

          $arr['product_country'] = $id;
          $arr['product_slug'] .= "-in-".$countryInfo->country_slug;
          $arr['product_name'] .= " in ".$countryInfo->country_name;
          $arr['product_is_read'] = 0;
          $pid = Product::insertGetId( $arr );

        endif;
      }
  }

}
