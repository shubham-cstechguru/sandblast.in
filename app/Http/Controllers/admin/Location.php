<?php

namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Query;
use DB;
use App\Model\CityModel;
class Location extends BaseController {
    public function country(Request $request, $id = null) {
    	if($request->isMethod('post')) {
    		$input = $request->input('record');
    		if(!empty($input)) {
	    		if(empty($id)) {
		    		DB::table('countries')->insert($input);
		    		$id = DB::getPdo()->lastInsertId();
		    	} else {
		    		DB::table('countries')->where('country_id', $id)->update($input);
		    	}
		    }

		    $check = $request->input('check');
		    if(!empty($check)) {
		    	DB::table('countries')->whereIn('country_id', $check)->update(['country_is_deleted' => 'Y']);
		    }

	    	return redirect('rt-admin/location/countries');
    	}

    	$edit = array();
    	if(!empty($id)) {
    		$edit = DB::table('countries')->where('country_id', $id)->first();
    	}

    	$records = DB::table('countries')->where('country_is_deleted', 'N')->paginate(10);

        $title 	= "Countries";
        $page 	= "country";
        $data 	= compact('page', 'title', 'records', 'edit');
        return view('backend/layout', $data);
    }
    public function states(Request $request, $id = null) {
        if($request->isMethod('post')) {
            $input = $request->input('record');
            if(!empty($input)) {
                if(empty($id)) {
                    DB::table('states')->insert($input);
                    $id = DB::getPdo()->lastInsertId();
                } else {
                    DB::table('states')->where('state_id', $id)->update($input);
                }
            }

            $check = $request->input('check');
            if(!empty($check)) {
                DB::table('states')->whereIn('state_id', $check)->update(['state_is_deleted' => 'Y']);
            }

            return redirect('rt-admin/location/states');
        }

        $edit = array();
        if(!empty($id)) {
            $edit = DB::table('states')->where('state_id', $id)->first();
        }

        $countries  = DB::table('countries')->where('country_is_deleted', 'N')->get();
        $records    = DB::table('states AS s')
                    ->join('countries AS c', 's.state_country', 'c.country_id')
                    ->where('state_is_deleted', 'N')->paginate(10);

        $title  = "States";
        $page   = "state";
        $data   = compact('page', 'title', 'records', 'edit', 'countries');
        return view('backend/layout', $data);
    }
    public function cities(Request $request, $id = null) {
         $q      = new Query();
        if($request->isMethod('post')) {
            $input = $request->input('record');
            if(!empty($input)) {
                if(empty($id)) {
                    DB::table('cities')->insert($input);
                    $id = DB::getPdo()->lastInsertId();
                } else {
                    DB::table('cities')->where('city_id', $id)->update($input);
                }
                
                if(empty($input['city_slug'])) {
                    $slug = $q->create_slug($input['city_name'], "cities", "city_slug", "city_id", $id);
                    CityModel::where('city_id', $id)->update( array('city_slug' => $slug) );
    
                }
            }

            $check = $request->input('check');
            if(!empty($check)) {
                DB::table('cities')->whereIn('city_id', $check)->update(['city_is_deleted' => 'Y']);
            }

            return redirect('rt-admin/location/cities');
        }

        $edit = $states = array();
        $countries  = DB::table('countries')->where('country_is_deleted', 'N')->get();

        if(!empty($id)) {
            $edit = DB::table('cities')->where('city_id', $id)->first();
            if(!empty($edit->city_country)) {
                $states = DB::table('states')->where('state_is_deleted', 'N')->where('state_country', $edit->city_country)->get();
            }
        }


        $records = DB::table('cities AS ct')
                    ->join('countries AS con', 'ct.city_country', 'con.country_id')
                    ->leftJoin('states AS st', 'ct.city_state', 'st.state_id')
                    ->where('city_is_deleted', 'N')
                    ->select('ct.*', 'con.country_name', 'st.state_name')
                    ->paginate(10);

        $title  = "Cities";
        $page   = "city";
        $data   = compact('page', 'title', 'records', 'edit', 'countries', 'states');
        return view('backend/layout', $data);
    }
}
