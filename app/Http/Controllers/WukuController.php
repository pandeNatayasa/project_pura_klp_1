<?php

namespace App\Http\Controllers;

use App\Wuku;
use Illuminate\Http\Request;

class WukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        return $new;
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
    public function update(Request $request, Wuku $wuku)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wuku  $wuku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wuku $wuku)
    {
        //
    }
}
