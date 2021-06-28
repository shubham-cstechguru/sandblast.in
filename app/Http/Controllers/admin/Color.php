<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
use App\Query;

class Color extends BaseController {
    public function index( Request $request, $id = NULL ) {

    	$q = new Query();
        $edit = array();
        if(!empty($id)) {
            $edit = DB::table('colors')->where('color_id',$id)->first();
        }

        $fcat = DB::table('colors')->where('color_is_deleted', 'N')->get();
        if ($request->isMethod('post')) {
            $check = $request->input('check');

            if(!empty($check)) {
                $arr = array(
                    "color_is_deleted" => "Y"
                );
                DB::table('colors')->whereIn('color_id', $check)->update( $arr );

                return redirect()->back()->with('success', 'Selected record(s) deleted.');
            }
        }

        // $records  = DB::table('colors')->where('color_is_deleted', 'N')->paginate(10);
        $query = DB::table('colors')
                    ->where('color_is_deleted','N');

        $search = array();
        if(!empty($request->input('search'))) {
            $search = $request->input('search');

            if(!empty($search['name'])) {
                $query->where('color_name','LIKE', '%'.$search['name'].'%');
            }
        }

        $records = $query->paginate(10);
        $color = DB::table('colors')->where('color_is_deleted', 'N')->get();
        if ($request->isMethod('post')) {
            $input = $request->input('record');

            if(empty($id)) {
                    DB::table('colors')->insert( $input );
                    $id = DB::getPdo()->lastInsertId();
                    $mess = "Data inserted.";
                } else {
                    DB::table('colors')->where('color_id', $id)->update( $input );
                    $mess = "Data updated";
                }

            $slug = $q->create_slug($input['color_name'], "colors", "color_slug", "color_id", $id);
            DB::table('colors')->where('color_id', $id)->update( array('color_slug' => $slug) );
            return redirect()->back()->with('success', $mess);
        }

        $input = $request->input();
        if (!empty($input['id']) && is_numeric($input['id']) || !empty($input['status'])) {
            $status = $input['status'] == "Y" ? "N" : "Y" ;
            $arr = array(
                    "color_is_visible" => $status
                );
                DB::table('colors')->where('color_id', $input['id'])->update( $arr );
            return redirect('rt-admin/color');
        }

    	$page 	= "color";
    	$data 	= compact('page', 'records', 'color', 'edit', 'fcat', 'search');
    	return view('backend/layout', $data);
    }
}
