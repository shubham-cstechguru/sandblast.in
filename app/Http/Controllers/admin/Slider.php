<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Query;
use DB;
use Hash;

class Slider extends BaseController {
    public function index( Request $request, $id = NULL ) {

        $slider_no = $request->input('sliders');
        $offset  = !empty($slider_no) ? $slider_no - 1 : 0;
        $records = DB::table('sliders')
                    // ->join('courses', 'topics.topic_course', '=', 'courses.course_id')
                    // ->join('subjects', 'topics.topic_subject', '=', 'subjects.subject_id')
                    // ->select('topics.*','courses.course_name', 'subjects.subject_name')
                    ->where('slider_is_deleted','N')
                    ->paginate(10);

        $input = $request->input();
        if (!empty($input['id']) && is_numeric($input['id']) || !empty($input['status'])) {
            $status = $input['status'] == "Y" ? "N" : "Y" ;
            $arr = array(
                "slider_is_visible" => $status
            );
            DB::table('sliders')->where('slider_id', $input['id'])->update( $arr );
            return redirect('rt-admin/slider');
        }

        if ($request->isMethod('post')) {
            $check = $request->input('check');

            foreach($check as $id) {
            	DB::table('sliders')->where('slider_id', $id)->update( array('slider_is_deleted' => 'Y') );
            }
            $mess = "Selected record(s) deleted successfully.";
            return redirect()->back()->with('success', $mess);
        }
    	
    	$page 	= "slider";
    	$data 	= compact('page','records', 'offset');
    	return view('backend/layout', $data);
    }

    public function add( Request $request, $id = NULL ) {
        $q     = new Query();
        $input = $request->input('record');

        $edit = array();
        if(!empty($id)) {
            $edit = DB::table('sliders')->where('slider_id', $id)->first();
        }

        if ($request->isMethod('post')) {

            if(empty($id)) {
                DB::table('sliders')->insert( $input );
                $id = DB::getPdo()->lastInsertId();
                $mess = "Data inserted.";
            } else {
                DB::table('sliders')->where('slider_id', $id)->update( $input );
                $mess = "Data updated";
            }

            if ($request->hasFile('slider_image')) {
                if(!empty($edit->slider_image) && file_exists(public_path().'/imgs/sliders/'.$edit->slider_image)) {
                    unlink(public_path().'/imgs/sliders/'.$edit->slider_image);
                }
                $image           = $request->file('slider_image');
                $name            = ''.$id.'.'.$image->getClientOriginalExtension();
                $destinationPath = 'public/imgs/sliders';
                $image->move($destinationPath, $name);

                if(!empty($edit->slider_image)) {
                    $name .= "?v=".uniqid();
                }

                DB::table('sliders')->where('slider_id', $id)->update( array('slider_image' => $name) );
            }

            // $mess = "New record inserted";
            return redirect('rt-admin/slider');
        }
       
        $page   = "add_slider";
        $data   = compact('page', 'edit');
        return view('backend/layout', $data);
    }
}