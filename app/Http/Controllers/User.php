<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Query;
use App\Model\UserModel;
use App\Model\CountryModel as Country;
use Illuminate\Support\Facades\Mail;
use DB;

class User extends BaseController {
    public function index( Request $request, $id = NULL) {
        $q          = new Query();
        $title 	    = "Profile | Chitrani";
        $user       = session('user_auth');
        $id         = $user;
        $record     = UserModel::where('user_id', $user)->first();
        $input      = $request->input();
        $edit       = array();

        // if (!empty($input['del_id']) && is_numeric($input['del_id'])) {
        //     $del_id = $input['del_id'];
        //     DB::table('addresses')->where('add_id', $del_id)->delete();
        // }

        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            $input = $request->input('record');
            $input['user_name']     = $input['user_fname']." ".$input['user_lname'];
            // $input['user_login']    = $input['user_email'];
            // $input['user_role']     = "User";
            // $line1                  = $input['user_address1'];
            // $line2                  = $input['user_address2'];
            // $country                = $input['user_country'];
            // $state                  = $input['user_state'];
            // $pincode                = $input['user_pincode'];
            // $input['user_password'] = password_hash($input['user_password'], PASSWORD_BCRYPT, ['cost' => 10]);
            // unset($input['user_address1']);
            // unset($input['user_address2']);
            // unset($input['user_country']);
            // unset($input['user_state']);
            // unset($input['user_pincode']);
                UserModel::where('user_id', $user)->update($input);
                //
                // $address = array(
                //         'add_uid'     => $user,
                //         'add_line1'   => $line1,
                //         'add_line2'   => $line2,
                //         'add_country' => $country,
                //         'add_state'   => $state,
                //         'add_pincode' => $pincode
                // );
                // if(!empty($line1)){
                //     $input = $request->input();
                //     if (!empty($input['edit_id']) && is_numeric($input['edit_id'])) {
                //         DB::table('addresses')->where('add_id', $input['edit_id'])->update($address);
                //     } else {
                //         DB::table('addresses')->insert($address);
                //     }
                // }

                if ($request->hasFile('profile_image')) {
                        if(!empty($record->user_image) && file_exists(public_path().'/imgs/user/'.$record->user_image)) {
                            unlink(public_path().'/imgs/user/'.$record->user_image);
                        }
                        $image           = $request->file('profile_image');
                        $name            = 'img'.$id.'.'.$image->getClientOriginalExtension();
                        $destinationPath = 'public/imgs/user';
                        $image->move($destinationPath, $name);
                        $dir1 = public_path().'/imgs/user/';
                        $dir = url('imgs/user');

                        if(!empty($record->user_image)) {
                            $name .= "?v=".uniqid();
                        }

                        UserModel::where('user_id', $user)->update( array('user_image' => $name) );
                    }

                $mess = "Profile Updated.";
                return redirect('profile')->with('success', $mess);
        }

        $countries = Country::get();

        $page   = "account";
        $page2  = "profile";
        $data   = compact('page','page2', 'title', 'record', 'edit', 'countries');
        return view('frontend/layout', $data);
    }
    public function verify( Request $request ) {
        $key = $request->input('key');
        if(!empty($key)) {
            $userinfo = UserModel::whereRaw("MD5(`user_id`) = '".$key."'")->first();

            if(!empty($userinfo->user_id)) {
                UserModel::where('user_id', $userinfo->user_id)->update(['user_is_enable' => 'Y']);
                return redirect('user')->with('success', 'Email verified, please login to continue.');
            }
        }
        return redirect('user');
    }
    public function register( Request $request ) {
        $title 	= "Register | Chitrani";
         if ($_SERVER['REQUEST_METHOD'] == "POST"){
             $post  = $request->input();
             $captcha_text = session('captcha_text');

             if($captcha_text == $post['captcha']) {

                 $input = $request->input('record');

                 $is_exists             = UserModel::where('user_email', $input['user_email'])->count();

                 if(!$is_exists) {
                     $input['user_name']    = $input['user_fname']." ".$input['user_lname'];
                     $input['user_login']   = $input['user_email'];
                     $input['user_role']    = "User";

                     $password  = $input['user_password'];
                     $confirm   = $input['confirm_password'];

                     $input['user_password'] = password_hash($input['user_password'], PASSWORD_BCRYPT, ['cost' => 10]);
                     // unset($input['user_fname']);
                     // unset($input['user_lname']);
                     unset($input['confirm_password']);

                     if ($password == $confirm) {
                         $id = UserModel::insertGetId($input);

                         $to          = $input['user_email'];
                         $name        = $input['user_name'];
                         $subject     = "Registration confirmation email - Chitrani";

                         $fields   = [
                             'subject'    => $subject,
                             'input'      => $input,
                             'id'         => $id
                         ];

                         Mail::send(['html' => 'email.registration'], $fields, function($message) use ($to, $subject, $name) {
                             $message->from('info@chitrani.com', 'Chitrani');
                             $message->to($to, $name)
                                    ->subject($subject)
                                    ->replyTo('info@chitrani.com', 'Chitrani');
                         });

                         $mess = "Please check your email.";
                         return redirect()->back()->with('success', $mess);
                     } else {
                         $mess = "Password Doesn't Match.";
                         return redirect()->back()->with('danger', $mess);
                     }
                 } else {
                     $mess = "Email ID already exists, please try with another.";
                     return redirect()->back()->with('danger', $mess);
                 }

             } else {
                 return redirect()->back()->with('danger', 'Captcha code doesn\'t matched.');
             }
         }
        $page   = "register";
        $data   = compact('page', 'title');
        return view('frontend/layout', $data);
    }

    public function wishlist( Request $request) {
        $title 	 = "Chitrani | Wishlist";
        $user = session('user_auth');
        $records = DB::table('products as pro')
                    ->join('wishlist as wish', 'wish.wish_pid', '=', 'pro.product_id')
                    ->where('wish.wish_uid', $user)
                    ->get();

        $page    = "wishlist";
        $data    = compact('page', 'title', 'records');
        return view('frontend/layout', $data);
    }

    public function change_password( Request $request, $id = NULL ) {
        $title 	 = "Change Password | Chitrani";
        $profile = UserModel::where('user_id', session('user_auth'))->first();

    	if ($request->isMethod('post')) {
    		$input = $request->input('password');

            if(!password_verify($input['current'], $profile->user_password)) {
                return redirect()->back()->with('failed', "Current password not matched.");
            } elseif($input['new'] != $input['confirm']) {
                return redirect()->back()->with('failed', "New password and confirm password not matched.");
            } else {
                $password = password_hash($input['new'], PASSWORD_BCRYPT, ['cost' => 10]);

                UserModel::where('user_id', $profile->user_id)->update( array('user_password' => $password) );
                return redirect()->back()->with('success', "Password has been changed.");
            }

            return redirect()->back()->with('success', 'Password Changed.');
	    }

    	$page 	= "change_pass";
    	$data 	= compact('page', 'title');
    	return view('frontend/layout', $data);
    }

    public function my_orders( Request $request, $id = NULL ) {
        $title 	 = "Chitrani | My Orders";
        $user = session('user_auth');
        $profile = UserModel::where('user_id', session('user_auth'))->first();
        $records = DB::table('orders')
                    ->where('order_uid', $user)
                    ->paginate(50);

        // dd( $records );

    	$page 	= "my-orders";
    	$data 	= compact('page', 'title', 'records');
    	return view('frontend/layout', $data);
    }

    public function order_info( Request $request, $id ) {
        $user       = session('user_auth');
        $profile    = UserModel::where('user_id', session('user_auth'))->first();
        $record     =   DB::table('orders as order')
                        ->leftJoin('users as user', 'order.order_uid', '=', 'user.user_id')
                        ->leftJoin('coupons AS c', 'order.order_coupon', '=', 'c.coupon_code')
                        ->where('order_id', $id)->first();

        $ship    =   DB::table('order_products as op')
                        ->where('op.opro_oid', $id)
                        ->join('products as p', 'op.opro_pid', '=', 'p.product_id')
                        ->get();

        $title 	 = "Chitrani | Order Info ".sprintf("#CHT%06d", $record->order_id);

    	$page 	= "order_info";
    	$data 	= compact('page', 'title', 'record', 'ship');
    	return view('frontend/layout', $data);
    }

    public function logout(Request $request) {
        $request->session()->forget('user_auth');
        return redirect('user')->with('success', "You've successfully logged out.");
    }
}
