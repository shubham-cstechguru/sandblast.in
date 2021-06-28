<?php
namespace App\Http\Controllers\api;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class Book extends BaseController {
    public function index( Request $request, $action = NULL ) {
        header('Content-Type: application/json');
    	$post  = $request->input();

        $param = compact('post');
        $re = call_user_func_array(array($this, $action), $param);

        echo json_encode($re, JSON_PRETTY_PRINT);
        die;
    }

    public function get_books( $post ) {
        $user = DB::table('users')->where('user_id', '1')->first();

        if (!empty($user)) {
            $re = array(
                'status'  => TRUE,
                'message' => ' User 1 Details.',
                // 'data'    => $user
            );
        } else {
            $re = array(
                'status'  => FALSE,
                'message' => 'User 1 Not Available.',
            );
        }

        return $re;
    }

    public function get_pages( $post ) {

       $page_id   = @$post['page_id'];

        $page_id   = !empty($page_id) ? $page_id : 1;

        $page = DB::table('pages')
                         ->where('page_id', $page_id)
                         ->first();

        if (!empty($page)) {
            $re = array(
                'status'  => TRUE,
                'data'    => $page
            );
        } else {
            $re = array(
                'status'  => FALSE,
                'message' => 'No pages found.',
            );
        }

        return $re;
    }

    public function get_faq( $post ) {

        $faq = DB::table('faq')
                         ->get();
        if (!empty($faq)) {
            $re = array(
                'status'  => TRUE,
                'data'    => $faq
            );
        } else {
            $re = array(
                'status'  => FALSE,
                'message' => 'No records found.',
            );
        }

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
}
