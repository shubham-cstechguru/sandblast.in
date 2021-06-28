<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class Ajax extends BaseController {
    public function index( Request $request, $action = NULL ) {
    	$post  = $request->input();

        $param = compact('post');
        $re = call_user_func_array(array($this, $action), $param);

        return response()->json( $re );
    }

    public function remove_price( $post = [] ) {
        extract( $post );

        $current_session = session('pro_price');
        unset( $current_session[$key] );

        $current_session = array_values( $current_session );

        session( ['pro_price' => $current_session] );

        $html   = view('backend.template.product_prices')->render();

        $re = [
            'status'    => TRUE,
            'html'      => $html
        ];

        return $re;
    }

    public function upload_image( Request $request ) {

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $name = uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = 'public/uploads';
            $image->move($destinationPath, $name);

            $re = array(
                'status'    => TRUE,
                'location' => url('/').'/'.$destinationPath.'/'.$name
            );
        } else {
            $re = array(
                'status'    => FALSE,
                'message'   => 'Error'
            );
        }

        header('Content-Type: application/json');
        print json_encode($re, JSON_PRETTY_PRINT);
    }

    public function user_login( Request $request ) {

        $post = $request->input('record');
        $is_exists = DB::table('users')
                        ->select( DB::raw('COUNT(*) AS total, user_id, user_password') )
                        ->where('user_login', $post['user_login'])
                        ->where('user_is_deleted', 'N')
                        ->first();

        if($is_exists->total == 1) {
            if(password_verify($post['user_password'], $is_exists->user_password)) {
                session(['user_auth' => $is_exists->user_id]);

                $re = array(
                    'status'    => TRUE,
                    'message'   => 'Login success! Redirecting, please wait...'
                );
            } else {
                $re = array(
                    'status'    => FALSE,
                    'message'   => 'Login failed! Passowrd is not matched.'
                );
            }
        } else {
            $re = array(
                'status'    => FALSE,
                'message'   => 'Login failed! Username doesn\'t exists.'
            );
        }

        header('Content-Type: application/json');
        print json_encode($re, JSON_PRETTY_PRINT);
    }

    public function change_order( $post ) {
        $sort_by = $post['sort_by'];

        foreach($sort_by as $pid => $order) {
            DB::table('products')->where('product_id', $pid)->update( ['product_order' => $order] );
        }

        $re = [
            'status'    => TRUE,
        ];
    }

    public function get_subcategory( $post ) {

        $categories =  DB::table('categories AS c')
                    ->select('c.category_id', 'c.category_name')
                    ->where('category_parent', $post['id'])
                    ->where('category_is_deleted', 'N')
                    ->get();

        // DB::table('subjects')->where('subject_course', $post['id'])->where('subject_is_deleted', 'N')->select('subject_id', 'subject_name')->get();

        $re = array(
            "status"        => TRUE,
            "categories"    => $categories
        );

        return $re;
    }

    public function get_topics( $post ) {

        $topics = DB::table('topics')->where('topic_subject', $post['id'])->where('topic_is_deleted', 'N')->select('topic_id', 'topic_name')->get();

        $re = array(
            "status"    => TRUE,
            "topics"    => $topics
        );

        return $re;
    }

    public function get_para( $post ) {
        $paras = DB::table('paragraphs')->where('para_topic', $post['id'])->where('para_is_deleted', 'N')->select('para_id', 'para_name')->get();

        $re = array(
            "status"    => TRUE,
            "paras"     => $paras
        );

        return $re;
    }
    public function get_states($post) {
        $states = DB::table('states')->where('state_is_deleted', 'N')->where('state_country', $post['id'])->get();

        $re = array(
            'data'  => $states
        );

        return $re;
    }
public function get_cities($post) {
        $cities = DB::table('cities')->where('city_is_deleted', 'N')->where('city_state', $post['id'])->get();

        $re = array(
            'data'  => $cities
        );

        return $re;
    }
}
