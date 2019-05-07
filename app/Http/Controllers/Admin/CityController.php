<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
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
        return view('admin.location.list_city',compact('provinces','cities'));
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
        $validator = Validator::make($request->all(),[
            'city_name' => 'required|string|max:200|unique:cities',
            'province_id' => 'required|numeric'
        ]);

        // Check if validator fails
        if ($validator->fails()) {
            return redirect()->back()->with('warning', $validator->errors());
        }

        // If validator not fails, then save into database
        $new =  new City();
        $new->province_id = $request->province_id;
        $new->city_name = $request->city_name;
        $new->save();

        return redirect()->back()->with('success','City saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'city_name' => 'required|string|max:200',
            'province_id' => 'required|numeric'
        ]);

        // Check if validator fails
        if ($validator->fails()) {
            return redirect()->back()->with('warning', $validator->errors());
        }

        // If validator not fails, then save into database
        $new =  City::find($id);
        $new->province_id = $request->province_id;
        $new->city_name = $request->city_name;
        $new->save();

        return redirect()->back()->with('success','City updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = City::find($id);
        $delete->delete();

        return redirect()->back()->with('success','City deleted successfully');
    }
}
