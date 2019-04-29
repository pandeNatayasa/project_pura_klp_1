<?php

namespace App\Http\Controllers;

use App\Pancawara;
use Illuminate\Http\Request;

class PancawaraController extends Controller
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

        return $new;
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
    public function update(Request $request, Pancawara $pancawara)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pancawara  $pancawara
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pancawara $pancawara)
    {
        //
    }
}
