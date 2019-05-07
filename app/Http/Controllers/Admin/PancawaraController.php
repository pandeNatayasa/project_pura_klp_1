<?php

namespace App\Http\Controllers\Admin;

use App\Pancawara;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PancawaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pancawaras = Pancawara::all();
        return view('admin.wuku.list_pancawara',compact('pancawaras'));
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
          'pancawara_name' => 'required|string|max:200|unique:pancawaras'
        ]);

        // If fails, return error
        if ($validator->fails()) {
          return redirect()->back()->with('warning',$validator->errors());
        }

        // If validtor not fails, then save into database
        $new = new Pancawara();
        $new->pancawara_name = $request->pancawara_name;
        $new->save();

        return redirect()->back()->with('success','Pancawara baru berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pancawara  $pancawara
     * @return \Illuminate\Http\Response
     */
    public function show(Pancawara $pancawara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pancawara  $pancawara
     * @return \Illuminate\Http\Response
     */
    public function edit(Pancawara $pancawara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pancawara  $pancawara
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validator input
        $validator = Validator::make($request->all(), [
          'pancawara_name' => 'required|string|max:200|unique:pancawaras'
        ]);

        // If fails, return error
        if ($validator->fails()) {
          return redirect()->back()->with('warning',$validator->errors());
        }

        // If validtor not fails, then save into database
        $new = Pancawara::find($id);
        $new->pancawara_name = $request->pancawara_name;
        $new->save();

        return redirect()->back()->with('success','Pancawara berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pancawara  $pancawara
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Pancawara::find($id);
        $delete->delete();

        return redirect()->back()->with('success','Pancawara berhasil dihapus');
    }
}
