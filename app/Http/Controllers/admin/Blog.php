<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
use App\Query;

class Blog extends BaseController {
    public function index( Request $request, $id = NULL ) {

    	$q = new Query();
        $edit = array();
        if(!empty($id)) {
            $edit = DB::table('blog_categories')->where('category_id',$id)->first();
        }


        if ($request->isMethod('post')) {
            $check = $request->input('check');

            if(!empty($check)) {
                $arr = array(
                    "category_is_deleted" => "Y"
                );
                DB::table('blog_categories')->whereIn('category_id', $check)->update( $arr );

                return redirect()->back()->with('success', 'Selected record(s) deleted.');
            }
        }

        // $records  = DB::table('categories')->where('category_is_deleted', 'N')->paginate(10);
        $query = DB::table('blog_categories')
                    ->where('blog_categories.category_is_deleted','N');

        $search = array();
        if(!empty($request->input('search'))) {
            $search = $request->input('search');

            if(!empty($search['name'])) {
                $query->where('blog_categories.category_name','LIKE', '%'.$search['name'].'%');
            }
        }

        $records = $query->paginate(10);
        $category = DB::table('blog_categories')->where('category_is_deleted', 'N')->get();
        if ($request->isMethod('post')) {
            $input = $request->input('record');

            if(empty($id)) {
                    DB::table('blog_categories')->insert( $input );
                    $id = DB::getPdo()->lastInsertId();
                    $mess = "Data inserted.";
                } else {
                    DB::table('blog_categories')->where('category_id', $id)->update( $input );
                    $mess = "Data updated";
                }

            $slug = $q->create_slug($input['category_name'], "categories", "category_slug", "category_id", $id);
            DB::table('blog_categories')->where('category_id', $id)->update( array('category_slug' => $slug) );

            return redirect()->back()->with('success', $mess);
        }

        $input = $request->input();
        if (!empty($input['id']) && is_numeric($input['id']) || !empty($input['status'])) {
            $status = $input['status'] == "Y" ? "N" : "Y" ;
            $arr = array(
                    "category_is_visible" => $status
                );
                DB::table('blog_categories')->where('category_id', $input['id'])->update( $arr );
            return redirect('rt-admin/blog-category');
        }



    	$page 	= "blog_category";
    	$data 	= compact('page', 'records', 'category', 'edit', 'fcat', 'search');
    	return view('backend/layout', $data);
    }

    public function tags( Request $request, $id = NULL ) {

        $q = new Query();
        $edit = array();
        if(!empty($id)) {
            $edit = DB::table('blog_tags')->where('tag_id',$id)->first();
        }


        if ($request->isMethod('post')) {
            $check = $request->input('check');

            if(!empty($check)) {
                $arr = array(
                    "tag_is_deleted" => "Y"
                );
                DB::table('blog_tags')->whereIn('tag_id', $check)->update( $arr );

                return redirect()->back()->with('success', 'Selected record(s) deleted.');
            }
        }

        // $records  = DB::table('categories')->where('category_is_deleted', 'N')->paginate(10);
        $query = DB::table('blog_tags')
                    ->where('tag_is_deleted','N');

        $search = array();
        if(!empty($request->input('search'))) {
            $search = $request->input('search');

            if(!empty($search['name'])) {
                $query->where('tag_name','LIKE', '%'.$search['name'].'%');
            }
        }

        $records = $query->paginate(10);
        $category = DB::table('blog_tags')->where('tag_is_deleted', 'N')->get();
        if ($request->isMethod('post')) {
            $input = $request->input('record');

            if(empty($id)) {
                    DB::table('blog_tags')->insert( $input );
                    $id = DB::getPdo()->lastInsertId();
                    $mess = "Data inserted.";
                } else {
                    DB::table('blog_tags')->where('tag_id', $id)->update( $input );
                    $mess = "Data updated";
                }

            $slug = $q->create_slug($input['tag_name'], "blog_tags", "tag_slug", "tag_id", $id);
            DB::table('blog_tags')->where('tag_id', $id)->update( array('tag_slug' => $slug) );

            return redirect()->back()->with('success', $mess);
        }

        $input = $request->input();
        if (!empty($input['id']) && is_numeric($input['id']) || !empty($input['status'])) {
            $status = $input['status'] == "Y" ? "N" : "Y" ;
            $arr = array(
                    "tag_is_visible" => $status
                );
                DB::table('blog_tags')->where('tag_id', $input['id'])->update( $arr );
            return redirect('rt-admin/blog-tags');
        }



        $page   = "blog_tag";
        $data   = compact('page', 'records', 'category', 'edit', 'fcat', 'search');
        return view('backend/layout', $data);
    }

    public function post( Request $request, $id = NULL ) {

        $q = new Query();
        $edit = array();
        if(!empty($id)) {
            $edit = DB::table('posts')->where('post_id',$id)->first();
        }
        if ($request->isMethod('post')) {
            $check = $request->input('check');

            if(!empty($check)) {
                $arr = array(
                    "post_is_deleted" => "Y"
                );
                DB::table('posts')->whereIn('post_id', $check)->update( $arr );

                return redirect()->back()->with('success', 'Selected record(s) deleted.');
            }
        }

        // $records  = DB::table('categories')->where('category_is_deleted', 'N')->paginate(10);
        $query = DB::table('posts')
                    ->where('post_is_deleted','N');

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

        $input = $request->input();
        if (!empty($input['id']) && is_numeric($input['id']) || !empty($input['status'])) {
            $status = $input['status'] == "Y" ? "N" : "Y" ;
            $arr = array(
                    "post_is_visible" => $status
                );
                DB::table('posts')->where('post_id', $input['id'])->update( $arr );
            return redirect('rt-admin/post');
        }



        $page   = "post";
        $data   = compact('page', 'records', 'edit', 'search');
        return view('backend/layout', $data);
    }

    public function addpost( Request $request, $id = NULL ) {

        $q = new Query();
        $edit = array();
        if(!empty($id)) {
            $edit = DB::table('posts')->where('post_id',$id)->first();
        }

        // $categories = DB::table('blog_categories')->where('category_is_deleted', 'N')->get();
        // $tags       = DB::table('blog_tags')->where('tag_is_deleted', 'N')->get();

        if ($request->isMethod('post')) {
            $input = $request->input('record');
            // $input['post_category'] = implode(",", $input['post_category']);
            // $input['post_tag'] = implode(",", $input['post_tag']);

            if(empty($id)) {
                DB::table('posts')->insert( $input );
                $id = DB::getPdo()->lastInsertId();
                $mess = "Data inserted.";
            } else {
                DB::table('posts')->where('post_id', $id)->update( $input );
                $mess = "Data updated";
            }

            $slug = $q->create_slug($input['post_title'], "posts", "post_slug", "post_id", $id);
            DB::table('posts')->where('post_id', $id)->update( array('post_slug' => $slug) );

            if ($request->hasFile('post_image')) {
                    if(!empty($edit->category_image) && file_exists(public_path().'/imgs/posts/'.$edit->post_image)) {
                        unlink(public_path().'/imgs/posts/'.$edit->post_image);
                    }
                    $image           = $request->file('post_image');
                    $name            = 'img'.$id.'.'.$image->getClientOriginalExtension();
                    $destinationPath = 'public/imgs/posts';
                    $image->move($destinationPath, $name);

                    if(!empty($edit->post_image)) {
                        $name .= "?v=".uniqid();
                    }

                    DB::table('posts')->where('post_id', $id)->update( array('post_image' => $name) );
                }
            return redirect('rt-admin/post/add')->with('success', $mess);
        }

        $page   = "add_post";
        $data   = compact('page', 'edit');
        return view('backend/layout', $data);
    }
}
