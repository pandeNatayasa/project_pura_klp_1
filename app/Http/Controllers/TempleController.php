<?php

namespace App\Http\Controllers;

use App\Temple;
use Illuminate\Http\Request;
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
use App\TempleElementImage;
use App\OdalanSasih;
use App\OdalanWuku;
use App\TempleDetail;
use Image;

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
        $rahinan = Rahinan::all();
        $sasih = Sasih::all();
        $wuku = Wuku::all();
        $saptawara = Saptawara::all();
        $pancawara = Pancawara::all();
        return view('member.temple.add_temple',compact('province','temple_type','rahinan','sasih','wuku','saptawara','pancawara'));
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
        // return $request->all();

        // Validator input data pura oleh member
        $validator = Validator::make($request->all(), [
            'temple_name' => 'required|string|max:255|unique:temples',
            'address' => 'required|string',
            'temple_type_id' => 'required|numeric',
            'odalan_type' => 'required|string',
            'sub_district' => 'required|numeric',
            'description' => 'required|string',
            'priest_name' => 'required|string',
            'address_priest' => 'required|string',
            'priest_phone' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);

        // Check if validator error then return redirect with message
        if ($validator->fails()) {
            return redirect()->back()->with('warning',$validator->errors());
        }elseif ($request->number_of_card_element == 0) {
            return redirect()->back()->with('warning','Setiap pura harus memiliki minimal 1 elemen/pelinggih');
        }
        // return $request->all();

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

        // Save into temple table
        $new = new Temple();
        $new->temple_name = $request->temple_name;
        $new->address = $request->address;
        $new->temple_type_id = $request->temple_type_id;
        $new->odalan_id = $new_odalan->id;
        $new->odalan_type = $request->odalan_type;
        $new->user_id = '1';
        $new->validate_status = '0';
        $new->sub_district_id = $request->sub_district;
        $new->description = $request->description;
        $new->latitude = $request->latitude;
        $new->longitude = $request->longitude;
        $new->priest_name = $request->priest_name;
        $new->priest_address = $request->address_priest;
        $new->priest_phone = $request->priest_phone;
        $new->save();

    // $temple_id = $new->id;
        
        // $file = $request->file('file');
        // TempleImage::create([
        //     // $imageName = $file->getClientOriginalName(),
        //     // $file->move('img',$imageName),
        //     $imageName = str_random(12),

        //     $imagePath =  "img/$imageName",
        //     'image_name' => $imagePath,
        //     'temple_id' => $temple_id
        // ]);
        

        // return "done";

        
        // if ($files=$request->hasFile('file')) { // foto_pura_1
        //     $filePic=$request->file('file');
        //     $extension = $filePic->getClientOriginalExtension();
            // $fileName = 'temple_image_'.$id;
            // $filePic->move('temple_image/',$fileName.'.'.$extension);

            // $new_image = new TempleImage();
            // $new_image->image_name = 'temple_image/'.$fileName.'.'.$extension;
            // $new_image->temple_id = $new->id;
            // $new_image->save();
            
    // }

        // Return redirect with message success

        // New save Image By Nata
        // Save image into folder and link into database
        $number_of_image = $request->total_semua_foto;
        $id_max=TempleImage::max('id');
        $id=$id_max +1;

        for ($i=1; $i <=$number_of_image ; $i++) {
            if ($request->hasFile('foto_pura_'.$i)) {
                // return "number_of_image";
                $filePic=$request->file('foto_pura_'.$i);
                $extension = $filePic->getClientOriginalExtension();
                $fileName = 'temple_image_'.$id;
                $filePic->move('temple_image/',$fileName.'.'.$extension);

                $new_image = new TempleImage();
                $new_image->image_name = 'temple_image/'.$fileName.'.'.$extension;
                $new_image->temple_id = $new->id;
                $new_image->save();
            }
            $id++;   
        }

        // Process save element and image of their element
        $max_number_of_card_element = $request->max_number_of_card_element;
        $max_id = TempleElementImage::max('id');
        // $id = $max_id->id;    

        for ($a=1; $a <= $max_number_of_card_element; $a++) { 
            // Check when input is not null
            if ($request->get('inputHiddenElementName_'.$a)) {
                $new_temple_element = new TempleDetail();
                $new_temple_element->element_name = $request->get('inputHiddenElementName_'.$a);
                $new_temple_element->god = $request->get('inputHiddenGodName_'.$a);
                $new_temple_element->element_description = $request->get('inputHiddenElementDescription_'.$a);
                $new_temple_element->element_position = $request->get('inputHiddenElementPosition_'.$a);
                $new_temple_element->temple_id = $new->id;
                $new_temple_element->save();

                // Loop to save all image of element 
                $total_image_element = $request->get('inputHiddenTotalElementImage_'.$a);
                for ($i=1; $i <= $total_image_element ; $i++) { 
                    // Check when upload image of element
                    if (null !== $request->get('inputHiddenElement_'.$a.'_Image_'.$i)){
                        if($request->get('inputHiddenElement_'.$a.'_Image_'.$i)){ // start success
                            $max_id += 1;
                            $image_str = $request->get('inputHiddenElement_'.$a.'_Image_'.$i);
                            $array = explode(',', $image_str);
                            $extension = explode('/', explode(':', substr($image_str, 0, strpos($image_str, ';')))[1])[1];
                            $filePic = Image::make($array[1])->encode($extension); 
                            
                            $fileName = 'temple_element_image_'.$max_id;
                            $path = 'temple_element_image/';
                            $filePic->save($path . $fileName.'.'.$extension);

                            $new_temple_element_image = new TempleElementImage();
                            $new_temple_element_image->image_name = $path . $fileName.'.'.$extension;
                            $new_temple_element_image->image_position = "default";
                            $new_temple_element_image->temple_detail_id = $new_temple_element->id;
                            $new_temple_element_image->save();
                        }
                    }        
                }
            }
        }

    //  for ($i=0; $i < $max_number_of_card_element; $i++) { 
        //     // Check when upload profile image
        //     if (isset($request->get('inputHiddenElementImage_'.$i)) {
        //         if($request->get('inputHiddenElementImage_'.$i)){ // start success
        //             $id += 1;
        //             $image_str = $request->inputHiddenElementImage_2;
        //             $array = explode(',', $image_str);
        //             $extension = explode('/', explode(':', substr($image_str, 0, strpos($image_str, ';')))[1])[1];;
        //             $filePic = Image::make($array[1])->encode($extension); 
                    
        //             $fileName = 'temple_element_image_'.$id;
        //             $path = public_path('temple_element_image/');
        //             $filePic->save($path . $fileName.'.'.$extension);

        //             $new_temple_element_image = new TempleElementImage();
        //             $new_temple_element_image->image_name = $path . $fileName.'.'.$extension;
        //             $new_temple_element_image->image_position = "default";
        //             $new_temple_element_image->temple_detail_id = ;
        //             $new_temple_element_image->save();
        //         }
        //     }    
    // }
        // End of process save image of element

        return redirect()->back()->with('success','Data Pura baru berhasil disimpan');
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
