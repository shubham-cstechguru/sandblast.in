<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Query;
use DB;
use Hash;

class Review extends BaseController {
    public function index( Request $request, $id = NULL  ) {

    	$records = DB::table('reviews as rev')
                  ->join('users as us', 'rev.review_uid', '=', 'us.user_id')
                  ->where('review_is_deleted', 'N')
    			  ->paginate(10);

      if ($request->isMethod('post')) {
            $check = $request->input('check');

            if(!empty($check)) {
                $arr = array(
                    "review_is_deleted" => "Y"
                );
                DB::table('reviews')->whereIn('review_id', $check)->update( $arr );

                return redirect()->back()->with('success', 'Selected record(s) deleted.');
            }
        }

	    $input = $request->input();
        if (!empty($input['id']) && is_numeric($input['id']) || !empty($input['status'])) {
            $status = $input['status'] == "Y" ? "N" : "Y" ;
            $arr = array(
                "review_is_active" => $status
            );
            DB::table('reviews')->where('review_id', $input['id'])->update( $arr );

            $review = DB::table('reviews')->where('review_id', $input['id'])->first();

            $rat_average    = DB::table('reviews')
                    ->where('review_is_active', 'Y')
                    ->where('review_pid', $review->review_pid )
                    ->avg('review_rating');

            DB::table('products')
                    ->where('product_id', $review->review_pid)
                    ->update(['product_by_rating' => $rat_average]);


            return redirect('rt-admin/reviews');
        }
    	
    	$page 	 = "reviews";
    	$data 	 = compact('page', 'records');
    	return view('backend/layout', $data);
    }
}
