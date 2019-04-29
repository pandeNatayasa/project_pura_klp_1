<?php

namespace App\Http\Controllers;

use App\Saptawara;
use Illuminate\Http\Request;

class SaptawaraController extends Controller
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

        return $new;
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
    public function update(Request $request, Saptawara $saptawara)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Saptawara  $saptawara
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saptawara $saptawara)
    {
        //
    }
}
