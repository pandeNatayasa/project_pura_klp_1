<?php

namespace App\Http\Controllers\Member;

use App\Temple;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Province;
use App\City;
use App\SubDistrict;
use App\TempleType;
use App\TemplePriest;

class TempleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.temple.list_temple');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $province = Province::all();
        $temple_type = TempleType::all();
        $temple_priest = TemplePriest::all();
        return view('member.temple.add_temple',compact('province','temple_type','temple_priest'));
    }

    public function fetch(Request $request)
    {
        $value = $request->get('value');
        $dependent = $request->get('dependent');

        if ($dependent=='kota') {
            $data_kota = City::all()->where('province_id','=',$value);

            $output = '<option value="" disabled selected>Pilih Kabupaten/'.ucfirst($dependent).'</option>';

            foreach ($data_kota as $data) {
                $output .= '<option value="'.$data->id.'">'.$data->city_name.'</option>';
            }

            echo $output;

        }elseif ($dependent=='kecamatan') {
            $data_kecamatan = SubDistrict::all()->where('city_id','=',$value);

            $output = '<option value="" disabled selected>Pilih '.ucfirst($dependent).'</option>';

            foreach ($data_kecamatan as $data) {
                $output .= '<option value="'.$data->id.'">'.$data->sub_district_name.'</option>';
            }

            echo $output;

        }else{
            echo "Error";
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Temple  $temple
     * @return \Illuminate\Http\Response
     */
    public function show(Temple $temple)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Temple  $temple
     * @return \Illuminate\Http\Response
     */
    public function edit(Temple $temple)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Temple  $temple
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Temple $temple)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Temple  $temple
     * @return \Illuminate\Http\Response
     */
    public function destroy(Temple $temple)
    {
        //
    }
}
