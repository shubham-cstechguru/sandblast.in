<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class Aboutus extends BaseController
{
    public function index() {
        $title 	= "About-us | Chitrani";
        $page   = "aboutus";
        $data   = compact('page', 'title');
        return view('frontend/layout', $data);
    }
}

