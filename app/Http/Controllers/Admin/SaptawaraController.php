<?php

namespace App\Http\Controllers\Admin;

use App\Saptawara;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SaptawaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saptawaras = Saptawara::all();
        return view('admin.wuku.list_saptawara',compact('saptawaras'));
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
          'saptawara_name' => 'required|string|max:200|unique:saptawaras'
        ]);

        // If fails, return error
        if ($validator->fails()) {
          return redirect()->back()->with('warning',$validator->errors());
        }

        // If validtor not fails, then save into database
        $new = new Saptawara();
        $new->saptawara_name = $request->saptawara_name;
        $new->save();

        return redirect()->back()->with('success','Saptawara baru berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Saptawara  $saptawara
     * @return \Illuminate\Http\Response
     */
    public function show(Saptawara $saptawara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Saptawara  $saptawara
     * @return \Illuminate\Http\Response
     */
    public function edit(Saptawara $saptawara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Saptawara  $saptawara
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validator input
        $validator = Validator::make($request->all(), [
          'saptawara_name' => 'required|string|max:200'
        ]);

        // If fails, return error
        if ($validator->fails()) {
          return redirect()->back()->with('warning',$validator->errors());
        }

        // If validtor not fails, then save into database
        $new = Saptawara::find($id);
        $new->saptawara_name = $request->saptawara_name;
        $new->save();

        return redirect()->back()->with('success','Saptawara berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Saptawara  $saptawara
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Saptawara::find($id);
        $delete->delete();

        return redirect()->back()->with('success','Saptawara berhasil dihapus');
    }
}
