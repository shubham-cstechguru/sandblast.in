<?php

namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
use App\Query;
use Illuminate\Support\Facades\Validator;

class city extends BaseController
{
    public function index(Request $request, $id = NULL)
    {

        $q = new Query();
        $edit = array();
        if (!empty($id)) {
            $edit = DB::table('cities')->where('city_id', $id)->first();
        }

        if ($request->isMethod('post')) {
            $check = $request->input('check');

            if (!empty($check)) {
                $arr = array(
                    "city_is_deleted" => "Y"
                );
                DB::table('cities')->whereIn('city_id', $check)->update($arr);

                foreach ($check as $delc) {
                    $city = DB::table('cities')->where('city_id', $delc)->delete();
                }

                return redirect()->back()->with('success', 'Selected record(s) deleted.');
            }
        }

        // $records  = DB::table('categories')->where('category_is_deleted', 'N')->paginate(10);
        $query = DB::table('cities')
            ->where('cities.city_is_deleted', 'N');

        $search = array();
        if (!empty($request->input('search'))) {
            $search = $request->input('search');

            if (!empty($search['name'])) {
                $query->where('cities.city_name', 'LIKE', '%' . $search['name'] . '%');
            }
        }

        $records = $query->paginate(10);
        if ($request->isMethod('post')) {
            $input = $request->input('record');

            if(empty($id)) {
                    DB::table('cities')->insert( $input );
            // $input = $request->all();

            // if (empty($id)) {
            //     $rules = [
            //         'record.city_name' => 'required|string|unique:mysql.cities,city_name|max:255',
            //         'record.city_short_name' => 'required|string|max:5',
            //     ];

            //     $messages = [
            //         'record.city_name.required'   => 'City Name must be required.',
            //         'record.city_name.string'   => 'City Name contain only alphabets.',
            //         'record.city_name.unique'   => 'City Name must be unique.',
            //         'record.city_name.max'   => 'City Name must be max of 255 charcters.',
            //         'record.city_short_name.required'   => 'City Shortname Name must be required.',
            //         'record.city_short_name.string'   => 'City Shortname Name contain only alphabets.',
            //         'record.city_short_name.max'   => 'City Shortname Name must be max of 5 charcters.',
            //     ];

            //     $validator  = Validator::make($input, $rules, $messages);


            //     if ($validator->fails()) {
            //         return redirect(url('rt-admin/city'))
            //             ->withErrors($validator->errors()->all())
            //             ->withInput();
            //     } else {
            //         DB::table('cities')->insert($request->record);
                    $id = DB::getPdo()->lastInsertId();
                    $mess = "Data inserted.";
            //         $slug = $q->create_slug($input['record']['city_name'], "cities", "city_slug", "city_id", $id);
            //         DB::table('cities')->where('city_id', $id)->update(array('city_slug' => $slug));
            //         return redirect(url('rt-admin/city'))->with('success', 'City successfully added.');
            //     }
            // } else {

            //     $rules = [
            //         'record.name' => 'required|string|max:255|unique:mysql.cities,name,' . $id,
            //         'record.short_name' => 'required|string|max:5'
            //     ];


            //     $messages = [
            //         'record.name.required'   => 'City Name must be required.',
            //         'record.name.string'   => 'City Name contain only alphabets.',
            //         'record.name.unique'   => 'City Name must be unique.',
            //         'record.name.max'   => 'City Name must be max of 255 charcters.',
            //         'record.short_name.required'   => 'City Shortname Name must be required.',
            //         'record.short_name.string'   => 'City Shortname Name contain only alphabets.',
            //         'record.short_name.max'   => 'City Shortname Name must be max of 5 charcters.',
            //     ];

            //     $validator  = Validator::make($input, $rules, $messages);

            //     if ($validator->fails()) {
            //         return redirect(url('rt-admin/city'))
            //             ->withErrors($validator->errors()->all())
            //             ->withInput();
                } else {
                    DB::table('cities')->where('city_id', $id)->update( $input );
                    // DB::table('cities')->where('city_id', $id)->update($request->record);
                    $mess = "Data updated";
                    // $slug = $q->create_slug($input['record']['city_name'], "cities", "city_slug", "city_id", $id);
                    // DB::table('cities')->where('city_id', $id)->update(array('city_slug' => $slug));
                    // return redirect(url('rt-admin/city'))->with('success', 'City successfully Update.');
                }
            // }


            $slug = $q->create_slug($input['city_name'], "cities", "city_slug", "city_id", $id);
            DB::table('cities')->where('city_id', $id)->update( array('city_slug' => $slug) );
            return redirect()->back()->with('success', $mess);
            // return redirect()->back()->with('success', $mess);
        }




        $page     = "add_city";
        $data     = compact('page', 'records', 'edit', 'search');
        return view('backend/layout', $data);
    }
}
