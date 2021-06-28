<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Contact extends BaseController {
    public function index(Request $request) {
        if($request->isMethod('post')) {
            $post  = $request->input();
            $input = $request->input('contact');
            $captcha_text = session('captcha_text');

    		if($captcha_text == $post['captcha']) {
                $to          = "info@chitrani.com";
                $from        = $input['email'];
                $sender      = $input['name'];
                $subject     = $input['name']." Contact Us - Chitrani";

                $fields   = [
                    'subject'    => $subject,
                    'input'      => $input
                ];

                Mail::send(['html' => 'email.contact'], $fields, function($message) use ($to, $from, $subject, $sender) {
                     $message->from($from, $sender);
                     $message->to($to, 'Chitrani')
                            ->subject($subject)
                            ->replyTo($from, $sender);
                });

                return redirect()->back()->with('success', 'Contact enquiry has been sent successfully, we\'ll contact you soon.');
            } else {
                return redirect()->back()->with('danger', 'Captcha code doesn\'t matched.');
            }
        }

        $title 	= "Contact | Chitrani";
        $page   = "contact";
        $data   = compact('page', 'title');
        return view('frontend/layout', $data);
    }
}
