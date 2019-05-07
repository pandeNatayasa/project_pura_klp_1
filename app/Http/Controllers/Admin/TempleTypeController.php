<?php

namespace App\Http\Controllers\Admin;

use App\TempleType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TempleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $temple_types = TempleType::all();
        return view('admin.list_temple_type',compact('temple_types'));
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
        // Validator input
        $validator = Validator::make($request->all(), [
          'type_name' => 'required|string|max:50|unique:temple_types',
          'type_function' => 'required|string|max:50'
        ]);

        // If fails, return error
        if ($validator->fails()) {
          return redirect()->back()->with('warning',$validator->errors());
        }

        // If validtor not fails, then save into database
        $new = new TempleType();
        $new->type_name = $request->type_name;
        $new->type_function = $request->type_function;
        $new->save();

        return redirect()->back()->with('success','Jenis Pura Baru berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TempleType  $templeType
     * @return \Illuminate\Http\Response
     */
    public function show(TempleType $templeType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TempleType  $templeType
     * @return \Illuminate\Http\Response
     */
    public function edit(TempleType $templeType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TempleType  $templeType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validator input
        $validator = Validator::make($request->all(), [
          'type_name' => 'required|string|max:50',
          'type_function' => 'required|string|max:50'
        ]);

        // If fails, return error
        if ($validator->fails()) {
          return redirect()->back()->with('warning',$validator->errors());
        }

        // If validtor not fails, then save into database
        $new = TempleType::find($id);
        $new->type_name = $request->type_name;
        $new->type_function = $request->type_function;
        $new->save();

        return redirect()->back()->with('success','Jenis Pura berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TempleType  $templeType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = TempleType::find($id);
        $delete->delete();

        return redirect()->back()->with('success','Jenis Pura berhasil dihapus');
    }
}
