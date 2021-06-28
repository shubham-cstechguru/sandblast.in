<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Query;
use DB;
use Hash;

class Users extends BaseController {
    public function index(Request $request, $role = NULL) {

      $input   = $request->input();
      $role    = 'admin';

      $records = DB::table('users')
      			->where('user_role', 'user' )
            ->where('user_is_deleted', 'N' )
      			->paginate(10);
      // print_r($records); die();

		  if (!empty($input['id']) && is_numeric($input['id']) || !empty($input['status'])) {
          $status = $input['status'] == "Y" ? "N" : "Y" ;
          $arr    = array(
              "user_is_enabled" => $status
          );
          DB::table('users')->where('user_id', $input['id'])->update( $arr );
          return redirect('rt-admin/user');
      }
    	
    	$page 	= "users";
    	$data 	= compact('page', 'records');
    	return view('backend/layout', $data);
    }
}
