<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
use App\Query;

class Collection extends BaseController {
    public function index( Request $request, $id = NULL, $edit = NULL ) {
        if ($request->isMethod('post')) {
            $check = $request->input('check');

            if(!empty($check)) {
                $arr = array(
                    "collection_is_deleted" => "Y"
                );
                DB::table('collection')->whereIn('collection_id', $check)->update( $arr );

                return redirect()->back()->with('success', 'Selected record(s) deleted.');
            }
        }
        if (!empty($id)) {
            $edit = DB::table('collection')->where('collection_id', $id)->first();
        }

        $records = DB::table('collection')
                    ->where('collection_is_deleted','N')
                    ->paginate(10);

        if ($request->isMethod('post')) {
            $input = $request->input('record');

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

                    if(!empty($edit->slider_image)) {
                        $name .= "?v=".uniqid();
                    }

                    DB::table('collection')->where('collection_id', $id)->update( array('collection_image' => $name) );
                }

            return redirect()->back()->with('success', $mess);
        }

        $input = $request->input();
        if (!empty($input['id']) && is_numeric($input['id']) || !empty($input['status'])) {
            $status = $input['status'] == "Y" ? "N" : "Y" ;
            $arr = array(
                    "collection_is_visible" => $status
                );
                DB::table('collection')->where('collection_id', $input['id'])->update( $arr );
            return redirect('rt-admin/collection');
        }



        
        
    	$page 	= "collection";
    	$data 	= compact('page', 'records', 'category', 'edit');
    	return view('backend/layout', $data);
    }
}
