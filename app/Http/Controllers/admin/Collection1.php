<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Query;
use DB;
use Hash;

class Collection extends BaseController {
    public function index( Request $request, $id = NULL ) {

        $collection_no = $request->input('collection');
        $offset  = !empty($collection_no) ? $collection_no - 1 : 0;
        $records = DB::table('collection')
                    ->where('collection_is_deleted','N')
                    ->paginate(10);

        $input = $request->input();
        if (!empty($input['id']) && is_numeric($input['id']) || !empty($input['status'])) {
            $status = $input['status'] == "Y" ? "N" : "Y" ;
            $arr = array(
                "collection_is_visible" => $status
            );
            DB::table('collection')->where('collection_id', $input['id'])->update( $arr );
            return redirect('rt-admin/collection');
        }

        if ($request->isMethod('post')) {
            $check = $request->input('check');

            foreach($check as $id) {
            	DB::table('collection')->where('collection_id', $id)->update( array('collection_is_deleted' => 'Y') );
            }
            $mess = "Selected record(s) deleted successfully.";
            return redirect()->back()->with('success', $mess);
        }
    	
    	$page 	= "collection";
    	$data 	= compact('page','records', 'offset');
    	return view('backend/layout', $data);
    }

    public function add( Request $request, $id = NULL ) {
        $q     = new Query();
        $input = $request->input('record');

        $edit = array();
        if(!empty($id)) {
            $edit = DB::table('collection')->where('collection_id', $id)->first();
        }

        if ($request->isMethod('post')) {

            if(empty($id)) {
                DB::table('collection')->insert( $input );
                $id = DB::getPdo()->lastInsertId();
                $mess = "Data inserted.";
            } else {
                DB::table('collection')->where('collection_id', $id)->update( $input );
                $mess = "Data updated";
            }

            if ($request->hasFile('collection_image')) {
                if(!empty($edit->collection_image) && file_exists(public_path().'/imgs/collections/'.$edit->collection_image)) {
                    unlink(public_path().'/imgs/collections/'.$edit->collection_image);
                }
                $image           = $request->file('collection_image');
                $name            = ''.$id.'.'.$image->getClientOriginalExtension();
                $destinationPath = 'public/imgs/collections';
                $image->move($destinationPath, $name);

                if(!empty($edit->collection_image)) {
                    $name .= "?v=".uniqid();
                }

                DB::table('collection')->where('collection_id', $id)->update( array('collection_image' => $name) );
            }

            // $mess = "New record inserted";
            return redirect('rt-admin/slider');
        }
       
        $page   = "add_collection";
        $data   = compact('page', 'edit');
        return view('backend/layout', $data);
    }
}