<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Query;
use DB;
use Hash;

class Pages extends BaseController {
    public function index( Request $request, $id = NULL ) {

        $page_no = $request->input('pages');
        $offset  = !empty($page_no) ? $page_no - 1 : 0;
        $records = DB::table('pages')
                    // ->join('courses', 'topics.topic_course', '=', 'courses.course_id')
                    // ->join('subjects', 'topics.topic_subject', '=', 'subjects.subject_id')
                    // ->select('topics.*','courses.course_name', 'subjects.subject_name')
                    ->where('page_is_deleted','N')
                    ->paginate(10);

        $input = $request->input();
        if (!empty($input['id']) && is_numeric($input['id']) || !empty($input['status'])) {
            $status = $input['status'] == "Y" ? "N" : "Y" ;
            $arr = array(
                    "page_is_visible" => $status
                );
                DB::table('pages')->where('page_id', $input['id'])->update( $arr );
            return redirect('rt-admin/page');
        }

        if ($request->isMethod('post')) {
            $check = $request->input('check');

            foreach($check as $id) {
                DB::table('pages')->where('page_id', $id)->update( array('page_is_deleted' => 'Y') );
            }
            $mess = "Selected record(s) deleted successfully.";
            return redirect()->back()->with('success', $mess);
        }
    	
    	$page 	= "pages";
    	$data 	= compact('page','records', 'offset');
    	return view('backend/layout', $data);
    }

    public function edit( Request $request, $id = NULL ) {
            $q     = new Query();
            $input = $request->input('record');

        if ($request->isMethod('post')) {

             if(empty($id)) {
                    DB::table('pages')->insert( $input );
                    $id = DB::getPdo()->lastInsertId();
                    $mess = "Data inserted.";
                } else {
                    DB::table('pages')->where('page_id', $id)->update( $input );
                    $mess = "Data updated";
                }

                if ($request->hasFile('page_image')) {
                    if(!empty($edit->page_image) && file_exists(public_path().'/imgs/pages/'.$edit->page_image)) {
                        unlink(public_path().'/imgs/pages/'.$edit->page_image);
                    }
                    $image           = $request->file('page_image');
                    $name            = 'img'.$id.'.'.$image->getClientOriginalExtension();
                    $destinationPath = 'public/imgs/pages';
                    $image->move($destinationPath, $name);

                    if(!empty($edit->page_image)) {
                        $name .= "?v=".uniqid();
                    }

                    DB::table('pages')->where('page_id', $id)->update( array('page_image' => $name) );
                }

            // $mess = "New record inserted";
                $slug = $q->create_slug($input['page_title'], "pages", "page_slug", "Page_id", $id);
            DB::table('pages')->where('page_id', $id)->update( array('page_slug' => $slug) );
            return redirect('rt-admin/page');
        }

        

        $edit = array();
        if(!empty($id)) {
            $edit = DB::table('pages')->where('page_id',$id)->first();
        }
       
        $page   = "edit_pages";
        $data   = compact('page', 'edit');
        return view('backend/layout', $data);
    }
}