<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Model\BlogModel as BlogM;
use DB;

class Blog extends BaseController
{
    public function index() {
        $title 	= "Blog | Chitrani";
        $page   = "blog";
        $blogs = BlogM::where('post_is_deleted','N')->paginate(9);
        $data   = compact('page', 'title', 'blogs');
        return view('frontend/layout', $data);
    }
	
	 public function single($slug) {
		 
        $blog   = BlogM::where('post_slug',$slug)->first();
        $title 	= $blog->post_title." | Chitrani";
        $page   = "single_blog";
        $data   = compact('page', 'title' ,'blog');
        return view('frontend/layout', $data);
    }
}

