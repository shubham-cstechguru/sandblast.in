<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
use App\Query;

class city extends BaseController {
    public function index( Request $request, $id = NULL ) {

    	$q = new Query();
        $edit = array();
        if(!empty($id)) {
            $edit = DB::table('cities')->where('city_id',$id)->first();
        }

        $fcat = DB::table('cities')->where('city_is_deleted', 'N')->get();
        if ($request->isMethod('post')) {
            $check = $request->input('check');

            if(!empty($check)) {
                $arr = array(
                    "city_is_deleted" => "Y"
                );
                DB::table('cities')->whereIn('city_id', $check)->update( $arr );

                return redirect()->back()->with('success', 'Selected record(s) deleted.');
            }
        }

        // $records  = DB::table('categories')->where('category_is_deleted', 'N')->paginate(10);
        $query = DB::table('cities')
                    ->leftJoin('categories AS c2', 'categories.category_parent', '=', 'c2.category_id')
                    ->select('categories.*', 'c2.category_name AS parent')
                    ->where('categories.category_is_deleted','N');

        $search = array();
        if(!empty($request->input('search'))) {
            $search = $request->input('search');
            if(!empty($search['cat'])) {
                $query->where('categories.category_parent', $search['cat']);
            }

            if(!empty($search['name'])) {
                $query->where('categories.category_name','LIKE', '%'.$search['name'].'%');
            }
        }

        $records = $query->paginate(10);
        $category = DB::table('categories')->where('category_parent', '0')->where('category_is_deleted', 'N')->get();
        if ($request->isMethod('post')) {
            $input = $request->input('record');

            if(empty($id)) {
                    DB::table('categories')->insert( $input );
                    $id = DB::getPdo()->lastInsertId();
                    $mess = "Data inserted.";
                } else {
                    DB::table('categories')->where('category_id', $id)->update( $input );
                    $mess = "Data updated";
                }

            $slug = $q->create_slug($input['category_name'], "categories", "category_slug", "category_id", $id);
            DB::table('categories')->where('category_id', $id)->update( array('category_slug' => $slug) );
            return redirect()->back()->with('success', $mess);
        }

        $input = $request->input();
        if (!empty($input['id']) && is_numeric($input['id']) || !empty($input['status'])) {
            $status = $input['status'] == "Y" ? "N" : "Y" ;
            $arr = array(
                    "category_is_visible" => $status
                );
                DB::table('categories')->where('category_id', $input['id'])->update( $arr );
            return redirect('rt-admin/category');
        }



    	$page 	= "add_city";
    	$data 	= compact('page', 'records', 'category', 'edit', 'fcat', 'search');
    	return view('backend/layout', $data);
    }
}
