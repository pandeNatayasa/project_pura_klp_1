<?php

namespace App\Http\Controllers\Admin;

use App\Wuku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wukus = Wuku::all();
        return view('admin.wuku.list_wuku',compact('wukus'));
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
          'wuku_name' => 'required|string|max:200|unique:wukus'
        ]);

        // If fails, return error
        if ($validator->fails()) {
          return redirect()->back()->with('warning',$validator->errors());
        }

        // If validtor not fails, then save into database
        $new = new Wuku();
        $new->wuku_name = $request->wuku_name;
        $new->save();

        return redirect()->back()->with('success','Wuku baru sukses disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wuku  $wuku
     * @return \Illuminate\Http\Response
     */
    public function show(Wuku $wuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wuku  $wuku
     * @return \Illuminate\Http\Response
     */
    public function edit(Wuku $wuku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wuku  $wuku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validator input
        $validator = Validator::make($request->all(), [
          'wuku_name' => 'required|string|max:200'
        ]);

        // If fails, return error
        if ($validator->fails()) {
          return redirect()->back()->with('warning',$validator->errors());
        }

        // If validtor not fails, then save into database
        $new = Wuku::find($id);
        $new->wuku_name = $request->wuku_name;
        $new->save();

        return redirect()->back()->with('success','Wuku sukses diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wuku  $wuku
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Wuku::find($id);
        $delete->delete();

        return redirect()->back()->with('success','Wuku sukses dihapus');
    }
}
