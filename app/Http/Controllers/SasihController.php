<?php

namespace App\Http\Controllers;

use App\Sasih;
use Illuminate\Http\Request;

class SasihController extends Controller
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
          'sasih_name' => 'required|string|max:200|unique:sasihs'
        ]);

        // If fails, return error
        if ($validator->fails()) {
          return redirect()->back()->with('warning',$validator->errors());
        }

        // If validtor not fails, then save into database
        $new = new Sasih();
        $new->sasih_name = $request->sasih_name;
        $new->save();

        return $new;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sasih  $sasih
     * @return \Illuminate\Http\Response
     */
    public function show(Sasih $sasih)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sasih  $sasih
     * @return \Illuminate\Http\Response
     */
    public function edit(Sasih $sasih)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sasih  $sasih
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sasih $sasih)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sasih  $sasih
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sasih $sasih)
    {
        //
    }
}
