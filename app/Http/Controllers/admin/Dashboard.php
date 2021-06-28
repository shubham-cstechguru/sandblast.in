<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;

class Dashboard extends BaseController {
    public function index() {
    	$title 	= "Admin Panel | English Aliens";
    	$page 	= "dashboard";
    	$data 	= compact('page', 'title');
    	return view('backend/layout', $data);
    }
}
