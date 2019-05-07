<?php

namespace App\Http\Controllers\Admin;

use App\Rahinan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RahinanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rahinans = Rahinan::all();
        return view('admin.sasih.list_rahinan',compact('rahinans'));
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
          'rahinan_name' => 'required|string|max:200|unique:rahinans'
        ]);

        // If fails, return error
        if ($validator->fails()) {
          return redirect()->back()->with('warning',$validator->errors());
        }

        // If validtor not fails, then save into database
        $new = new Rahinan();
        $new->rahinan_name = $request->rahinan_name;
        $new->save();

        return redirect()->back()->with('success','Hari Rahinan baru berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rahinan  $rahinan
     * @return \Illuminate\Http\Response
     */
    public function show(Rahinan $rahinan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rahinan  $rahinan
     * @return \Illuminate\Http\Response
     */
    public function edit(Rahinan $rahinan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rahinan  $rahinan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validator input
        $validator = Validator::make($request->all(), [
          'rahinan_name' => 'required|string|max:200|unique:rahinans'
        ]);

        // If fails, return error
        if ($validator->fails()) {
          return redirect()->back()->with('warning',$validator->errors());
        }

        // If validtor not fails, then save into database
        $new = Rahinan::find($id);
        $new->rahinan_name = $request->rahinan_name;
        $new->save();

        return redirect()->back()->with('success','Hari Rahinan berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rahinan  $rahinan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Rahinan::find($id);
        $delete->delete();

        return redirect()->back()->with('success','Hari Rahinan berhasil dihapus');   
    }
}
