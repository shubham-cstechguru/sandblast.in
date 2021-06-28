<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class Setting extends BaseController {
    public function index( Request $request, $id = NULL ) {
        $view = DB::table('settings')->get();
    	if ($request->isMethod('post')) {
            $input = $request->input('record');
    		DB::table('settings')->update( $input );
            return redirect('rt-admin/setting');
	    }

    	$page 	= "settings";
    	$data 	= compact('page', 'view');
    	return view('backend/layout', $data);
    }
}
