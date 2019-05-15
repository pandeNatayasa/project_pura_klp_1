<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\City;
use App\SubDistrict;
use App\TempleType;
use App\Rahinan;
use App\Sasih;
use App\Wuku;
use App\Saptawara;
use App\Pancawara;
use App\Temple;
use App\TempleImage;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Maps Template
    public function maps(){
        $marker = Temple::with('TempleType')->get();
        
        // return $marker;
        return view('user.index', compact('marker'));
    }

    //Add Temple Template
    public function add_temple(){

        $type = TempleType::all();
        $province = Province::all();
        $rahinan = Rahinan::all();
        $sasih = Sasih::all();
        $wuku = Wuku::all();
        $saptawara = Saptawara::all();
        $pancawara = Pancawara::all();

        return view('user.add_temple', compact('type','province','rahinan','sasih','wuku','saptawara','pancawara'));
    }

    public function profile(){
        
        return view('user.profile');
    }

    //Fetch Data Location
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

        }elseif ($dependent=='subdistrict') {
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

    // public function loadMarker(Request $request){
    //     $marker = Temple::all();

    //     return $marker;
    // }

    public function dropzone(Request $request){
        $temple = new Temple;
        $temple->temple_name = $request->name;
        $temple->user_id = '1';
        $temple->temple_type_id = '1';
        $temple->sub_district_id = '1';
        $temple->save();

        $temple_id = $temple->id;
        $file = $request->file('file');
        
        if($file){
            TempleImage::create([
                    $imageName = $file->getClientOriginalName(),
                    $file->move('img',$imageName),

                    $imagePath =  "img/$imageName",
                    'image_name' => $imagePath,
                    'temple_id' => $temple_id
            ]);
        }

        return ;
    }

    public function edit_profile(Request $request, $id){

        $profile = User::find($id);

        $profile->name = $request->user_name;
        $profile->email = $request->user_email;
        $profile->no_telp = $request->user_telp;

        $profile->save();

        return back();
    }
}
