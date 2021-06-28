<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
use App\Query;

class category extends BaseController {
    public function index( Request $request, $id = NULL ) {

    	$q = new Query();
        $edit = array();
        if(!empty($id)) {
            $edit = DB::table('categories')->where('category_id',$id)->first();
        }

        $fcat = DB::table('categories')->where('category_parent', '0')->where('category_is_deleted', 'N')->get();
        if ($request->isMethod('post')) {
            $check = $request->input('check');

            if(!empty($check)) {
                $arr = array(
                    "category_is_deleted" => "Y"
                );
                DB::table('categories')->whereIn('category_id', $check)->update( $arr );

                return redirect()->back()->with('success', 'Selected record(s) deleted.');
            }
        }

        // $records  = DB::table('categories')->where('category_is_deleted', 'N')->paginate(10);
        $query = DB::table('categories')
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

            if ($request->hasFile('category_image')) {
                    if(!empty($edit->category_image) && file_exists(public_path().'/imgs/category/'.$edit->category_image)) {
                        unlink(public_path().'/imgs/category/'.$edit->category_image);
                    }
                    $image           = $request->file('category_image');
                    $name            = 'img'.$id.'.'.$image->getClientOriginalExtension();
                    $destinationPath = 'public/imgs/category';
                    $image->move($destinationPath, $name);
                    $dir1 = public_path().'/imgs/category/';
                    $dir = url('imgs/category');

                    $thumb = "img".$id.'.'.$image->getClientOriginalExtension();
                    $q->resize_image($dir.'/'.$name, 400, 400, $dir1.'/'.$thumb);

                    if(!empty($edit->category_image)) {
                        $name .= "?v=".uniqid();
                    }

                    DB::table('categories')->where('category_id', $id)->update( array('category_image' => $thumb) );
                }
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

        
        
    	$page 	= "category";
    	$data 	= compact('page', 'records', 'category', 'edit', 'fcat', 'search');
    	return view('backend/layout', $data);
    }
}
