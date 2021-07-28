<?php

namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
use App\Query;
use Illuminate\Support\Facades\Validator;

class country extends BaseController
{
    public function index(Request $request, $id = NULL)
    {
        $q = new Query();
        $edit = array();
        if (!empty($id)) {
            $edit = DB::table('countries')->where('country_id', $id)->first();
        }

        if ($request->isMethod('post')) {
            $check = $request->input('check');

            if (!empty($check)) {
                $arr = array(
                    "country_is_deleted" => "Y"
                );
                DB::table('countries')->whereIn('country_id', $check)->update($arr);

                return redirect()->back()->with('success', 'Selected record(s) deleted.');
            }
        }

        // $records  = DB::table('categories')->where('category_is_deleted', 'N')->paginate(10);
        $query = DB::table('countries')
            ->where('countries.country_is_deleted', 'N');

        $search = array();
        if (!empty($request->input('search'))) {
            $search = $request->input('search');

            if (!empty($search['name'])) {
                $query->where('countries.country_name', 'LIKE', '%' . $search['name'] . '%');
            }
        }

        $records = $query->paginate(10);
        if ($request->isMethod('post')) {

            $input = $request->all();

            if (empty($id)) {
                $rules = [
                    'record.country_name' => 'required|string|unique:mysql.countries,country_name|max:255',
                    'record.country_short_name' => 'required|string|max:5',
                ];

                $messages = [
                    'record.country_name.required'   => 'Country Name must be required.',
                    'record.country_name.string'   => 'Country Name contain only alphabets.',
                    'record.country_name.unique'   => 'Country Name must be unique.',
                    'record.country_name.max'   => 'Country Name must be max of 255 charcters.',
                    'record.country_short_name.required'   => 'Country Shortname Name must be required.',
                    'record.country_short_name.string'   => 'Country Shortname Name contain only alphabets.',
                    'record.country_short_name.max'   => 'Country Shortname Name must be max of 5 charcters.',
                ];

                $validator  = Validator::make($input, $rules, $messages);


                if ($validator->fails()) {
                    return redirect(url('rt-admin/country'))
                        ->withErrors($validator->errors()->all())
                        ->withInput();
                } else {
                    DB::table('countries')->insert($request->record);
                    $id = DB::getPdo()->lastInsertId();
                    $mess = "Data inserted.";
                    $slug = $q->create_slug($input['record']['country_name'], "countries", "country_slug", "country_id", $id);
                    DB::table('countries')->where('country_id', $id)->update(array('country_slug' => $slug));
                    return redirect(url('rt-admin/country'))->with('success', 'Country successfully added.');
                }
            } else {
                $rules = [
                    'record.country_name' => 'required|string|max:255|unique:countries,country_name,' . $id,
                    'record.country_short_name' => 'required|string|max:5'
                ];


                $messages = [
                    'record.country_name.required'   => 'Country Name must be required.',
                    'record.country_name.string'   => 'Country Name contain only alphabets.',
                    'record.country_name.unique'   => 'Country Name must be unique.',
                    'record.country_name.max'   => 'Country Name must be max of 255 charcters.',
                    'record.country_short_name.required'   => 'Country Shortname Name must be required.',
                    'record.country_short_name.string'   => 'Country Shortname Name contain only alphabets.',
                    'record.country_short_name.max'   => 'Country Shortname Name must be max of 5 charcters.',
                ];

                $validator  = Validator::make($input, $rules, $messages);

                if ($validator->fails()) {
                    return redirect(url('rt-admin/country'))
                        ->withErrors($validator->errors()->all())
                        ->withInput();
                } else {

                    DB::table('countries')->where('countries.country_id', $id)->update($request->record);
                    $mess = "Data updated";
                    $slug = $q->create_slug($input['record']['country_name'], "countries", "country_slug", "country_id", $id);
                    DB::table('countries')->where('country_id', $id)->update(array('country_slug' => $slug));
                    return redirect(url('rt-admin/country'))->with('success', 'Country successfully Update.');
                }
            }
        }




        $page     = "add_country";
        $data     = compact('page', 'records', 'edit', 'search');
        return view('backend/layout', $data);
    }
}
