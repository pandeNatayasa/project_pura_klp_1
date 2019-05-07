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
use App\Rahinan;
use App\Sasih;
use App\Wuku;
use App\Saptawara;
use App\Pancawara;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\TempleImage;
use App\OdalanSasih;
use App\OdalanWuku;

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
        $rahinan = Rahinan::all();
        $sasih = Sasih::all();
        $wuku = Wuku::all();
        $saptawara = Saptawara::all();
        $pancawara = Pancawara::all();
        return view('member.temple.add_temple',compact('province','temple_type','temple_priest','rahinan','sasih','wuku','saptawara','pancawara'));
    }

    public function fetch(Request $request)
    {
        $value = $request->get('value');
        $dependent = $request->get('dependent');

        if ($dependent=='city') {
            $data_kota = City::all()->where('province_id','=',$value);

            $output = '<option value="" disabled selected>Pilih Kabupaten/Kota</option>';

            foreach ($data_kota as $data) {
                $output .= '<option value="'.$data->id.'">'.$data->city_name.'</option>';
            }

            echo $output;

        }elseif ($dependent=='sub_district') {
            $data_kecamatan = SubDistrict::all()->where('city_id','=',$value);

            $output = '<option value="" disabled selected>Pilih Kecamatan</option>';

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
        // Validator input data pura oleh member
        $validator = Validator::make($request->all(), [
            'temple_name' => 'required|string|max:255',
            'address' => 'required|string',
            'temple_type_id' => 'required|numeric',
            'odalan_type' => 'required|string',
            'subdistrict' => 'required|numeric',
            'description' => 'required|string',
            'priest_name' => 'required|string',
            'address_priest' => 'required|string',
            'priest_phone' => 'required|string'
        ]);

        // Check if validator error then return redirect with message
        if ($validator->fails()) {
            return redirect()->back()->with('warning',$validator->errors());
        }

        // If validator not fails, then save into database

        // Save odalan into database
        if ($request->odalan_type == "sasih") {
            // If odalan_type is sasih
            // Then save into odalan_sasih table
            $new_odalan = new OdalanSasih();
            $new_odalan->sasih_id = $request->sasih;
            $new_odalan->rahinan_id = $request->rahinan;
            $new_odalan->save();

        }elseif ($request->odalan_type == "wuku") {
            // If odalan_type id wuku,
            // Then save into odalan_wuku_table
            $new_odalan = new OdalanWuku();
            $new_odalan->saptawara_id = $request->saptawara;
            $new_odalan->pancawara_id = $request->pancawara;
            $new_odalan->wuku_id = $request->wuku;
            $new_odalan->save();
        }

        // Save priest of temple
        $new_priest = new TemplePriest();
        $new_priest->priest_name = $request->priest_name;
        $new_priest->address = $request->address_priest;
        $new_priest->phone = $request->priest_phone;
        $new_priest->save();


        // Save into temple table
        $new = new Temple();
        $new->temple_name = $request->temple_name;
        $new->address = $request->address;
        $new->temple_type_id = $request->temple_type_id;
        $new->odalan_id = $new_odalan->id;
        $new->odalan_type = $request->odalan_type;
        $new->user_id = Auth::id();
        $new->validate_status = '0';
        $new->temple_priest_id = $new_priest->id;
        $new->sub_district_id = $request->subdistrict;
        $new->save();

        // Save image into folder and link into database
        $number_of_image = $request->total_semua_foto;
        $id_max=TempleImage::max('id');
        $id=$id_max +1;

        
        if ($files=$request->hasFile('file')) {
            $filePic=$request->file('file');
            $extension = $filePic->getClientOriginalExtension();
            $fileName = 'temple_image_'.$id;
            $filePic->move('temple_image/',$fileName.'.'.$extension);

            $new_image = new TempleImage();
            $new_image->image_name = 'temple_image/'.$fileName.'.'.$extension;
            $new_image->temple_id = $new->id;
            $new_image->save();
        }

        // Return redirect with message success
        return redirect()->back()->with('success','New Temple information saved successfully');
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
