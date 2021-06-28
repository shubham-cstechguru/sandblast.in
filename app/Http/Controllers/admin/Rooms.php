<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
use App\Query;

class Rooms extends BaseController {
    public function index( Request $request, $id = NULL, $edit = NULL ) {
        if ($request->isMethod('post')) {
            $check = $request->input('check');

            if(!empty($check)) {
                $arr = array(
                    "room_is_deleted" => "Y"
                );
                DB::table('rooms')->whereIn('room_id', $check)->update( $arr );

                return redirect()->back()->with('success', 'Selected record(s) deleted.');
            }
        }
        if (!empty($id)) {
            $edit = DB::table('rooms')->where('room_id', $id)->first();
        }

        $records = DB::table('rooms')
                    ->where('room_is_deleted','N')
                    ->paginate(10);

        if ($request->isMethod('post')) {
            $input = $request->input('record');

            if(empty($id)) {
                    DB::table('rooms')->insert( $input );
                    $id = DB::getPdo()->lastInsertId();
                    $mess = "Data inserted.";
                } else {
                    DB::table('rooms')->where('room_id', $id)->update( $input );
                    $mess = "Data updated";
                }

                if ($request->hasFile('room_image')) {
                    if(!empty($edit->room_image) && file_exists(public_path().'/imgs/rooms/'.$edit->collection_image)) {
                        unlink(public_path().'/imgs/rooms/'.$edit->room_image);
                    }
                    $image           = $request->file('room_image');
                    $name            = ''.$id.'.'.$image->getClientOriginalExtension();
                    $destinationPath = 'public/imgs/rooms';
                    $image->move($destinationPath, $name);

                    if(!empty($edit->room_image)) {
                        $name .= "?v=".uniqid();
                    }

                    DB::table('rooms')->where('room_id', $id)->update( array('room_image' => $name) );
                }

            return redirect()->back()->with('success', $mess);
        }

        $input = $request->input();
        if (!empty($input['id']) && is_numeric($input['id']) || !empty($input['status'])) {
            $status = $input['status'] == "Y" ? "N" : "Y" ;
            $arr = array(
                    "room_is_visible" => $status
                );
                DB::table('rooms')->where('room_id', $input['id'])->update( $arr );
            return redirect('rt-admin/room');
        }



        
        
    	$page 	= "room";
    	$data 	= compact('page', 'records', 'category', 'edit');
    	return view('backend/layout', $data);
    }
}
