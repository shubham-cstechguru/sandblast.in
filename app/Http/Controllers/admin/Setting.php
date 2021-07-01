<?php

namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class Setting extends BaseController
{
	public function index(Request $request, $id = NULL)
	{
		$view = DB::table('settings')->get();
		if ($request->isMethod('post')) {
			$input = $request->input('record');
			if ($request->hasFile('setting_logo')) {
				
				$image       = $request->file('setting_logo');
				// $filename    = $image->getClientOriginalName();
				$filename = 'logo_sanblast.'.'' . $image->getClientOriginalExtension();
				
				$request->setting_logo->move(public_path('imgs/'), $filename);
				
				$input['setting_logo'] = $filename;
			}
			if ($request->hasFile('setting_favicon')) {
				
				$image       = $request->file('setting_favicon');
				// $filename    = $image->getClientOriginalName();
				$filename = 'favicon_sanblast.'.'' . $image->getClientOriginalExtension();
				
				$request->setting_favicon->move(public_path('imgs/'), $filename);
				
				$input['setting_favicon'] = $filename;
			}
			DB::table('settings')->update($input);
			return redirect('rt-admin/setting');
		}

		$page 	= "settings";
		$data 	= compact('page', 'view');
		return view('backend/layout', $data);
	}
}
