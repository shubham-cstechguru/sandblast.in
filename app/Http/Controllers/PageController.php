<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use App\Model\Page;
use Illuminate\Http\Request;
use DB;

class PageController extends BaseController {
   public function index( Request $request, $slug) {

       $query   = Page::where('page_slug' , $slug)->where('page_is_deleted','N')->first();
       $main    = $query->page_title;
       $title 	= $main." | Chitrani";
       $page 	= "page";
    	$data 	= compact('page', 'title', 'query');
    	return view('frontend/layout', $data);
    }
}
