<?php

namespace App\Http\Controllers\Admin;

use App\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::all();
        return view('admin.location.list_province',compact('provinces'));
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
            'province_name' => 'required|string|max:200|unique:provinces'
        ]);

        // Check if validator fails
        if ($validator->fails()) {
            return redirect()->back()->with('warning',$validator->errors());
        }

        // If validator not fail, then save into database
        $new = new Province();
        $new->province_name = $request->province_name;
        $new->save();

        return redirect()->back()->with('success','Province saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function show(Province $province)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function edit(Province $province)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'province_name' => 'required|string|max:200'
        ]);

        // Check if validator fails
        if ($validator->fails()) {
            return redirect()->back()->with('warning',$validator->errors());
        }

        // If validator not fail, then save into database
        $new = Province::find($id);
        $new->province_name = $request->province_name;
        $new->save();

        return redirect()->back()->with('success','Province updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Province::find($id);
        $delete->delete();

        return redirect()->back()->with('success','Province deleted successfully');
    }
}
