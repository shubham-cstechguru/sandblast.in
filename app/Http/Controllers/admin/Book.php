<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Query;
use DB;

class Book extends BaseController {
    public function index( Request $request, $id = NULL ) {

        $page_no = $request->input('page');
        $offset  = !empty($page_no) ? $page_no - 1 : 0;
        $records = DB::table('books')
                    ->join('categorys AS c1', 'books.book_category', '=', 'c1.category_id')
                    ->leftJoin('categorys AS c2', 'books.book_subcategory', '=', 'c2.category_id')
                    ->select('books.*','c1.category_name', 'c2.category_name AS category_subcategory')   
                    ->where('book_is_deleted','N')
                    ->paginate(10);

        $input = $request->input();
        if (!empty($input['id']) && is_numeric($input['id']) || !empty($input['status'])) {
            $status = $input['status'] == "Y" ? "N" : "Y" ;
            $arr = array(
                    "book_status" => $status
                );
                DB::table('books')->where('book_id', $input['id'])->update( $arr );
            return redirect('rt-admin/book');
        }

        if ($request->isMethod('post')) {
            $check = $request->input('check');

            if(!empty($check)) {
                $arr = array(
                    "book_is_deleted" => "Y"
                );
                DB::table('books')->whereIn('book_id', $check)->update( $arr );

                return redirect()->back()->with('success', 'Selected record(s) deleted.');
            }
        }

    	
    	$page 	= "book";
    	$data 	= compact('page','records', 'offset');
    	return view('backend/layout', $data);
    }

    public function add( Request $request, $id = NULL ) {
        $q     = new Query();
        $input = $request->input('record');

        if ($request->isMethod('post')) {

             if(empty($id)) {
                    DB::table('books')->insert( $input );
                    $id = DB::getPdo()->lastInsertId();
                    $mess = "Data inserted.";
                } else {
                    DB::table('books')->where('book_id', $id)->update( $input );
                    $mess = "Data updated";
                    return redirect('rt-admin/book');
                }

            // $mess = "New record inserted";

            $slug = $q->create_slug($input['book_name'], "books", "book_slug", "book_id", $id);
            DB::table('books')->where('book_id', $id)->update( array('book_slug' => $slug) );


            // Book poster image
            if ($request->hasFile('poster_image')) {
                    if(!empty($edit->book_mp3_poster) && file_exists(public_path().'/imgs/books/'.$edit->book_mp3_poster)) {
                        unlink(public_path().'/imgs/books/'.$edit->book_mp3_poster);
                    }
                    $image           = $request->file('poster_image');
                    $name            = ''.$id.'.'.$image->getClientOriginalExtension();
                    $destinationPath = 'public/imgs/books';
                    $image->move($destinationPath, $name);

                    if(!empty($edit->book_mp3_poster)) {
                        $name .= "?v=".uniqid();
                    }

                    DB::table('books')->where('book_id', $id)->update( array('book_mp3_poster' => $name) );
                }

                // book image
                if ($request->hasFile('image')) {
                    if(!empty($edit->book_image) && file_exists(public_path().'/imgs/books/'.$edit->book_image)) {
                        unlink(public_path().'/imgs/books/'.$edit->book_image);
                    }
                    $image           = $request->file('image');
                    $name            = 'img'.$id.'.'.$image->getClientOriginalExtension();
                    $destinationPath = 'public/imgs/books';
                    $image->move($destinationPath, $name);

                    if(!empty($edit->book_image)) {
                        $name .= "?v=".uniqid();
                    }

                    DB::table('books')->where('book_id', $id)->update( array('book_image' => $name) );
                }

                // PDF UPLOAD
                if ($request->hasFile('pdf')) {
                    if(!empty($edit->book_pdf) && file_exists(public_path().'/imgs/books/'.$edit->book_pdf)) {
                        unlink(public_path().'/imgs/books/'.$edit->book_pdf);
                    }
                    $image           = $request->file('pdf');
                    $name            = 'pdf'.$id.'.'.$image->getClientOriginalExtension();
                    $destinationPath = 'public/imgs/books';
                    $image->move($destinationPath, $name);

                    if(!empty($edit->book_pdf)) {
                        $name .= "?v=".uniqid();
                    }

                    DB::table('books')->where('book_id', $id)->update( array('book_pdf' => $name) );
                }

                //  MP3 UPLOAD
                if ($request->hasFile('mp3')) {
                    if(!empty($edit->book_mp3) && file_exists(public_path().'/imgs/books/'.$edit->book_mp3)) {
                        unlink(public_path().'/imgs/books/'.$edit->book_mp3);
                    }
                    $image           = $request->file('mp3');
                    $name            = 'mp3'.$id.'.'.$image->getClientOriginalExtension();
                    $destinationPath = 'public/imgs/books';
                    $image->move($destinationPath, $name);

                    if(!empty($edit->book_mp3)) {
                        $name .= "?v=".uniqid();
                    }

                    DB::table('books')->where('book_id', $id)->update( array('book_mp3' => $name) );
                }


            return redirect()->back()->with('success', $mess);
        }

        $category = DB::table('categorys')->where('category_parent', '0')->get();

        $edit = array();
        if(!empty($id)) {
            $edit = DB::table('books')->where('book_id',$id)->first();
        }

        $page   = "add_book";
        $data   = compact('page', 'edit', 'category');
        return view('backend/layout', $data);
    }
}