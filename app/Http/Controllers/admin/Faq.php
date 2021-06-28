<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Query;
use DB;
use Hash;

class Faq extends BaseController {
    public function index( Request $request, $id = NULL ) {

        $page_no = $request->input('page');
        $offset  = !empty($page_no) ? $page_no - 1 : 0;
        $records = DB::table('faq')
                    // ->join('courses', 'topics.topic_course', '=', 'courses.course_id')
                    // ->join('subjects', 'topics.topic_subject', '=', 'subjects.subject_id')
                    // ->select('topics.*','courses.course_name', 'subjects.subject_name')
                    // ->where('course_is_deleted','N')
                    ->paginate(10);
    	
    	$page 	= "faq";
    	$data 	= compact('page','records', 'offset');
    	return view('backend/layout', $data);
    }

    public function add( Request $request, $id = NULL ) {

            $input = $request->input('record');

        if ($request->isMethod('post')) {

             if(empty($id)) {
                    DB::table('faq')->insert( $input );
                    $id = DB::getPdo()->lastInsertId();
                    $mess = "Data inserted.";
                } else {
                    DB::table('faq')->where('faq_id', $id)->update( $input );
                    $mess = "Data updated";
                }

            // $mess = "New record inserted";
            return redirect()->back()->with('success', $mess);
        }

        $edit = array();
        if(!empty($id)) {
            $edit = DB::table('faq')->where('faq_id',$id)->first();
        }
       
        $page   = "add_faq";
        $data   = compact('page', 'edit');
        return view('backend/layout', $data);
    }
}