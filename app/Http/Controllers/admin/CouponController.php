<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Model\Coupon;
use App\Model\ProductModel as Product;
use App\Query;

class CouponController extends BaseController {
    public function index( Request $request, $id = NULL ) {

    	$q = new Query();
        $edit = array();
        if(!empty($id)) {
            $edit = Coupon::where('coupon_id',$id)->first();
        }

        if ($request->isMethod('post')) {
            $check = $request->input('check');

            if(!empty($check)) {
                $arr = array(
                    "coupon_is_deleted" => "Y"
                );
                Coupon::whereIn('coupon_id', $check)->update( $arr );

                return redirect()->back()->with('success', 'Selected record(s) deleted.');
            }
        }

        // $records  = Coupon::where('coupon_is_deleted', 'N')->paginate(10);
        $query = Coupon::where('coupon_is_deleted','N');

        $search = array();
        if(!empty($request->input('search'))) {
            $search = $request->input('search');

            if(!empty($search['name'])) {
                $query->where('coupon_name','LIKE', '%'.$search['name'].'%');
            }
        }

        $records    = $query->paginate(10);
        $products   = Product::where('product_is_deleted', 'N')->get();

        if ($request->isMethod('post')) {
            $input = $request->input('record');
            
            $input['coupon_include_products'] = !empty($input['coupon_include_products']) ? implode(",", $input['coupon_include_products']) : "";
            $input['coupon_exclude_products'] = !empty($input['coupon_exclude_products']) ? implode(",", $input['coupon_exclude_products']) : "";

            if(empty($id)) {
                $id = Coupon::insertGetId( $input );
                $mess = "Data inserted.";
            } else {
                Coupon::where('coupon_id', $id)->update( $input );
                $mess = "Data updated";
            }

            return redirect(url('rt-admin/coupon'))->with('success', $mess);
        }

        $input = $request->input();
        if (!empty($input['id']) && is_numeric($input['id']) || !empty($input['status'])) {
            $status = $input['status'] == "Y" ? "N" : "Y" ;

            if($status == 'Y') {
                Coupon::whereRaw('1=1')->update( ['coupon_is_public' => 'N'] );
            }

            $arr = array(
                "coupon_is_public" => $status
            );
            Coupon::where('coupon_id', $input['id'])->update( $arr );

            return redirect('rt-admin/coupon');
        }

    	$page 	= "coupons";
    	$data 	= compact('page', 'records', 'products', 'edit', 'search');
    	return view('backend/layout', $data);
    }
}
