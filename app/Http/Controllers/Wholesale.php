<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Model\CountryModel as Country;
use Illuminate\Support\Facades\Mail;

class Wholesale extends BaseController {
    public function index(Request $request) {
        if($request->isMethod('post')) {
            $input = $request->input('record');

            $to          = "info@chitrani.com";
            $from        = $input['email'];
            $sender      = $input['name'];
            $subject     = "Wholesale Enquiry - Chitrani";

            $fields   = [
                'subject'    => $subject,
                'input'      => $input
            ];

            Mail::send(['html' => 'email.wholesale'], $fields, function($message) use ($to, $from, $subject, $sender) {
                $message->from($from, $sender);
                $message->to($to, 'Chitrani')
                       ->subject($subject)
                       ->replyTo($from, $sender);
            });

            return redirect()->back()->with('success', 'Enquiry has been sent successfully, we\'ll contact you soon.');
        }

        $countries = Country::get();

        $title 	= "Wholesale | Chitrani";
        $page   = "wholesale";
        $data   = compact('page', 'title', 'countries');
        return view('frontend/layout', $data);
    }
}
