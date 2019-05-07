<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Province;
use App\SubDistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SubDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::all();
        $cities = City::all();
        $sub_districts = SubDistrict::all();
        return view('admin.location.list_sub_district',compact('provinces','cities','sub_districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'sub_district_name' => 'required|string|max:200|unique:sub_districts',
          'city' => 'required|numeric',
          'province' => 'required|numeric'
        ]);

        // Check if validator fails
        if ($validator->fails()) {
            return redirect()->back()->with('warning',$validator->errors());
        }

        // If validator not fail, then save into databse
        $new = new SubDistrict();
        $new->city_id = $request->city;
        $new->sub_district_name = $request->sub_district_name;
        $new->save();

        return redirect()->back()->with('success','Sub District saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubDistrict  $subDistrict
     * @return \Illuminate\Http\Response
     */
    public function show(SubDistrict $subDistrict)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubDistrict  $subDistrict
     * @return \Illuminate\Http\Response
     */
    public function edit(SubDistrict $subDistrict)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubDistrict  $subDistrict
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
          'sub_district_name' => ['required','string','max:200'],
          'city' => 'required|numeric',
          'province' => 'required|numeric'
        ]);

        // Check if validator fails
        if ($validator->fails()) {        
            return redirect()->back()->with('warning',$validator->errors());
        }

        // If validator not fail, then save into databse
        $new = SubDistrict::find($id);
        $new->city_id = $request->city;
        $new->sub_district_name = $request->sub_district_name;
        $new->save();

        return redirect()->back()->with('success','Sub District updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubDistrict  $subDistrict
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = SubDistrict::find($id);
        $delete->delete();

        return redirect()->back()->with('success','Sub District deleted successfully');
    }

    // This is function to make dynamic province or city selected
    public function fetch_city_in_edit(Request $request)
    {
        
        $category = $request->get('category');
        if ($category=='city') {
            $sub_district_id = $request->get('sub_district_id');
            $sub_districts = SubDistrict::find($sub_district_id);
            $city_id = $sub_districts->city_id;
            $city = City::find($city_id);
            $province_id = $city->province_id;

            $cities = City::where('province_id','=',$province_id)->get();

            // return $cities;

            $output = '<option value="" disabled>Pilih Kabupaten/Kota</option>';

            foreach ($cities as $data) {
                if ($data->id == $city_id) {
                    $output .= '<option value="'.$data->id.'" selected>'.$data->city_name.'</option>';
                }else{
                    $output .= '<option value="'.$data->id.'">'.$data->city_name.'</option>';    
                }
            }

            echo $output;
        }else{
            $output = '<option value="" disabled selected>Pilih Kabupaten/Kota</option>';
            echo $output;
        }
        
    }
    public function fetch_province_in_edit(Request $request)
    {
        $province_id = $request->get('province_id');
        $provinces = Province::all();

        $output = '<option value="" disabled>Pilih Provinsi</option>';

        foreach ($provinces as $data) {
            if ($data->id == $province_id) {
                $output .= '<option value="'.$data->id.'" selected>'.$data->province_name.'</option>';
            }else{
                $output .= '<option value="'.$data->id.'">'.$data->province_name.'</option>';    
            }
        }

        echo $output;
    }

    public function fetch(Request $request)
    {
        $value = $request->get('value');
        $dependent = $request->get('dependent');

        if ($dependent=='city') {
            $data_kota = City::all()->where('province_id','=',$value);

            $output = '<option value="" disabled selected>Pilih Kabupaten/Kota</option>';

            foreach ($data_kota as $data) {
                $output .= '<option value="'.$data->id.'">'.$data->city_name.'</option>';
            }

            echo $output;

        }elseif ($dependent=='sub_district') {
            $data_kecamatan = SubDistrict::all()->where('city_id','=',$value);

            $output = '<option value="" disabled selected>Pilih Kecamatan</option>';

            foreach ($data_kecamatan as $data) {
                $output .= '<option value="'.$data->id.'">'.$data->sub_district_name.'</option>';
            }

            echo $output;

        }else{
            echo "Error";
        }
    }
    // This end of function to make dynamic province or city selected
}
