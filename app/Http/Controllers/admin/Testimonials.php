<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Query;
use DB;
use Hash;

class Testimonials extends BaseController {
    public function index( Request $request, $id = NULL ) {

        $product_no = $request->input('testimonials');
        $offset  = !empty($testimonials_no) ? $testimonials_no - 1 : 0;
        $records = DB::table('testimonials')
                    // ->join('courses', 'topics.topic_course', '=', 'courses.course_id')
                    // ->join('subjects', 'topics.topic_subject', '=', 'subjects.subject_id')
                    // ->select('topics.*','courses.course_name', 'subjects.subject_name')
                    ->where('testimonial_is_deleted','N')
                    ->paginate(10);

        $input = $request->input();
        if (!empty($input['id']) && is_numeric($input['id']) || !empty($input['status'])) {
            $status = $input['status'] == "Y" ? "N" : "Y" ;
            $arr = array(
                "testimonial_is_visible" => $status
            );
            DB::table('testimonials')->where('testimonial_id', $input['id'])->update( $arr );
            return redirect('rt-admin/partner');
        }

        if ($request->isMethod('post')) {
            $check = $request->input('check');

            foreach($check as $id) {
            	DB::table('testimonials')->where('testimonial_id', $id)->update( array('testimonial_is_deleted' => 'Y') );
            }
            $mess = "Selected record(s) deleted successfully.";
            return redirect()->back()->with('success', $mess);
        }
    	
    	$page 	= "testimonials";
    	$data 	= compact('page','records', 'offset');
    	return view('backend/layout', $data);
    }

    public function add( Request $request, $id = NULL ) {
        $q     = new Query();
        $input = $request->input('record');

        $edit = $specs = array();
        if(!empty($id)) {
            $edit = DB::table('testimonials')->where('testimonial_id', $id)->first();
        }

        if ($request->isMethod('post')) {
            if(empty($id)) {
                DB::table('testimonials')->insert( $input );
                $id = DB::getPdo()->lastInsertId();
                $mess = "Data inserted.";
            } else {
                DB::table('testimonials')->where('testimonial_id', $id)->update( $input );
                $mess = "Data updated";
            }

            if ($request->hasFile('testimonial_image')) {
                    if(!empty($edit->book_image) && file_exists(public_path().'/imgs/testimonials/'.$edit->testimonial_image)) {
                        unlink(public_path().'/imgs/testimonials/'.$edit->testimonial_image);
                    }
                    $image           = $request->file('testimonial_image');
                    $name            = 'img'.$id.'.'.$image->getClientOriginalExtension();
                    $destinationPath = 'public/imgs/testimonials';
                    $image->move($destinationPath, $name);

                    if(!empty($edit->testimonial_image)) {
                        $name .= "?v=".uniqid();
                    }

                    DB::table('testimonials')->where('testimonial_id', $id)->update( array('testimonial_image' => $name) );
                }

            // $mess = "New record inserted";
            return redirect('rt-admin/partner');
        }
       
        $page   = "add_testimonials";
        $data   = compact('page', 'edit', 'specs', 'category');
        return view('backend/layout', $data);
    }
}