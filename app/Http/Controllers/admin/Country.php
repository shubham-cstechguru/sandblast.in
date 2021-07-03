<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
use App\Query;

class country extends BaseController {
    public function index( Request $request, $id = NULL ) {

    	$q = new Query();
        $edit = array();
        if(!empty($id)) {
            $edit = DB::table('countries')->where('country_id',$id)->first();
        }

        if ($request->isMethod('post')) {
            $check = $request->input('check');

            if(!empty($check)) {
                $arr = array(
                    "country_is_deleted" => "Y"
                );
                DB::table('countries')->whereIn('country_id', $check)->update( $arr );

                return redirect()->back()->with('success', 'Selected record(s) deleted.');
            }
        }

        // $records  = DB::table('categories')->where('category_is_deleted', 'N')->paginate(10);
        $query = DB::table('countries')
                    ->where('countries.country_is_deleted','N');

        $search = array();
        if(!empty($request->input('search'))) {
            $search = $request->input('search');

            if(!empty($search['name'])) {
                $query->where('countries.country_name','LIKE', '%'.$search['name'].'%');
            }
        }

        $records = $query->paginate(10);
        if ($request->isMethod('post')) {
            $input = $request->input('record');

            if(empty($id)) {
                    DB::table('countries')->insert( $input );
                    $id = DB::getPdo()->lastInsertId();
                    $mess = "Data inserted.";
                } else {
                    DB::table('countries')->where('country_id', $id)->update( $input );
                    $mess = "Data updated";
                }

            $slug = $q->create_slug($input['country_name'], "countries", "country_slug", "country_id", $id);
            DB::table('countries')->where('country_id', $id)->update( array('country_slug' => $slug) );
            return redirect()->back()->with('success', $mess);
        }




    	$page 	= "add_country";
    	$data 	= compact('page', 'records', 'edit', 'search');
    	return view('backend/layout', $data);
    }
}
