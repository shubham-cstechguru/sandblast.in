<?php
namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class User extends BaseController {
    public function change_password( Request $request, $id = NULL ) {
        $profile = DB::table('users')->where('user_id', session('user_auth'))->first();

    	if ($request->isMethod('post')) {
    		$input = $request->input('password');

            if(!password_verify($input['current'], $profile->user_password)) {
                return redirect()->back()->with('failed', "Current password not matched.");
            } elseif($input['new'] != $input['confirm']) {
                return redirect()->back()->with('failed', "New password and confirm password not matched.");
            } else {
                $password = password_hash($input['new'], PASSWORD_BCRYPT, ['cost' => 10]);

                DB::table('users')->where('user_id', $profile->user_id)->update( array('user_password' => $password) );
                return redirect()->back()->with('success', "Password has been changed.");
            }
	    }

    	$page 	= "change_password";
    	$data 	= compact('page');
    	return view('backend/layout', $data);
    }
    public function logout(Request $request) {
        if ($request->session()->has('user_auth')) {
            $request->session()->forget('user_auth');
        }
        return redirect()->back()->with('success', "You've successfully logged out.");
    }
}
