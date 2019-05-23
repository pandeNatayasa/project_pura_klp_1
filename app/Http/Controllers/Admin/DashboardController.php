<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Temple;
use App\TempleImage;
use Carbon\Carbon;
use Auth;
use App\OdalanSasih;
use App\OdalanWuku;
use App\Province;
use App\City;
use App\SubDistrict;
use App\TempleType;
use App\Rahinan;
use App\Wuku;
use App\Sasih;
use App\Pancawara;
use App\Saptawara;
use App\TempleDetail;
use App\TempleElementImage;

class DashboardController extends Controller
{

	public function __construct()
  {
    $this->middleware('auth:admin');
  }


  public function index()
  {
  	return view('admin.home');
  }

  // This is to show list of temple not yet validate
  public function show_list_temple_validate()
  {
  	// $temples = Temple::all()->where('validate_status','=','0');
  	$temples = Temple::groupBy('temples.id')
      ->where('temples.validate_status','!=','1')
      ->select('temples.*', 'temple_images.image_name')
      ->join('temple_images', 'temple_images.temple_id', '=', 'temples.id')
      ->get();

    // return $temples;

  	return view('admin.list_temple_validate',compact('temples'));
  }

  // This is to show list of temple already validate
  public function show_list_temple()
  {
    $temples = Temple::groupBy('temples.id')
      ->where('temples.validate_status','!=','0')
      ->select('temples.*', 'temple_images.image_name')
      ->join('temple_images', 'temple_images.temple_id', '=', 'temples.id')
      ->get();

    return view('admin.list_temple',compact('temples'));
  }

  // This is to show profille Admin
  public function show_profille_admin()
  {
    return view('admin.profille_admin');
  }

  // This is to update profille admin
  public function update_profille_admin(Request $request, $id)
  {
    return "aa";
  }

  public function verify_accept_temple($id)
  {
  	$temple = Temple::find($id);
  	$temple->admin_id = Auth::id();
  	$temple->date_validate = Carbon::now();
  	$temple->validate_status = '1';
  	$temple->save();

  	return redirect()->back()->with('success','Verifikasi Data Pura Berhasil');
  }

  public function verify_reject_temple($id)
  {
  	$temple = Temple::find($id);
  	$temple->admin_id = Auth::id();
  	$temple->date_validate = Carbon::now();
  	$temple->validate_status = '2';
  	$temple->save();

  	return redirect()->back()->with('success','Data Pura Berhasil tidak terverifikasi');
  }

  public function show_temple_detail($id)
  {
  	$temple = Temple::find($id);
  	$temple_images = TempleImage::where('temple_id','=',$temple->id)->get();

  	// Get odalan fit with odalan type
  	if ($temple->odalan_type == "sasih") {
  		// When odalan_type is sasih then select into odalan_sasih table
  		$odalan = OdalanSasih::find($temple->odalan_id);
  	}elseif ($temple->odalan_type = "wuku") {
  		// When odalan_type is wuku, then select into odalan_wuku_table
  		$odalan = OdalanWuku::find($temple->odalan_id);
  	}

  	// $provinces = Province::all();
  	// $cities = City::all();
  	// $sub_districts = SubDistrict::all();
    // $img = TempleImage::where('id','=',$id)->get();
    // $details = Temple::where('id','=',$id)->first();
    // Get all element of temple
    $elements = TempleDetail::groupBy('temple_details.id')
      ->join('temple_element_images','temple_details.id','=','temple_element_images.temple_detail_id')
      ->select('temple_details.*','temple_element_images.image_name')
      ->where('temple_details.temple_id','=',$id)
      ->get();
    // $elements = TempleDetail::where('temple_id','=',$id)->get();

  	return view('admin.temple_detail2',compact('temple','temple_images','odalan','elements'));
  }

  public function update_temple($id)
  {
  	$temple = Temple::find($id);
  	$temple_images = TempleImage::where('temple_id','=',$temple->id)->get();

  	// Get odalan fit with odalan type
  	if ($temple->odalan_type == "sasih") {
  		// When odalan_type is sasih then select into odalan_sasih table
  		$odalan = OdalanSasih::find($temple->odalan_id);
  	}elseif ($temple->odalan_type = "wuku") {
  		// When odalan_type is wuku, then select into odalan_wuku_table
  		$odalan = OdalanWuku::find($temple->odalan_id);
  	}

  	// $provinces = Province::all();
  	// $cities = City::all();
  	// $sub_districts = SubDistrict::all();

  	$type = TempleType::all();
  	$province = Province::all();
  	$rahinan = Rahinan::all();
    $sasih = Sasih::all();
    $wuku = Wuku::all();
    $saptawara = Saptawara::all();
    $pancawara = Pancawara::all();
    $cities = City::where('province_id','=',$temple->SubDistrict->City->province_id)->get();
    $sub_districts = SubDistrict::where('city_id','=',$temple->SubDistrict->city_id)->get();

    $element = TempleDetail::groupBy('temple_details.id')
      ->join('temple_element_images','temple_details.id','=','temple_element_images.temple_detail_id')
      ->select('temple_details.*','temple_element_images.image_name')
      ->where('temple_details.temple_id','=',$id)
      ->get();


    // This is to get image of element, because one element enable have more than one image
    $temple_element = [];
    foreach ($element as $data) {
      $element_array = $data->toArray();      
      // Get image of the element
      $element_image = TempleElementImage::where('temple_detail_id','=',$element_array['id'])->get();

      // Merge element of image with their element
      array_push($element_array, $element_image);

      // Merge every element
      array_push($temple_element, $element_array);
    }
    // return $temple_element;
    // foreach ($temple_element as $key) {
    //   return $key['element_name'];
    //   return $key->element_name;
    //   return $key[0];
    //   foreach ($key[0] as $key2) {
    //     return $key2->element_name;
    //   }
    // }

  	return view('admin.update_temple2',compact('temple','temple_images','odalan','type','province','rahinan','sasih','wuku','saptawara','pancawara','cities','sub_districts','temple_element'));	
  }

  public function save_update_temple(Request $request, $id)
  {
    $temple = Temple::find($id);

    // Validator input data pura oleh member
        $validator = Validator::make($request->all(), [
            'temple_name'    => 'required|string|max:255|unique:temples',
            'address'        => 'required|string',
            'temple_type_id' => 'required|numeric',
            'odalan_type'    => 'required|string',
            'sub_district'   => 'required|numeric',
            'description'    => 'required|string',
            'priest_name'    => 'required|string',
            'address_priest' => 'required|string',
            'priest_phone'   => 'required|string',
            'latitude'       => 'required|numeric',
            'longitude'      => 'required|numeric',
        ]);

        // Check if validator error then return redirect with message
        if ($validator->fails()) {
            return redirect()->back()->with('warning', $validator->errors());
        } elseif ($request->number_of_card_element == 0) {
            return redirect()->back()->with('warning', 'Setiap pura harus memiliki minimal 1 elemen/pelinggih');
        }
        // return $request->all();

        // If validator not fails, then save into database

        // Save odalan into database
        if ($request->odalan_type == "sasih") {
            // If odalan_type is sasih
            // First Validator input data odalan sasih
            $validator_sasih = Validator::make($request->all(), [
                'sasih'   => 'required|numeric',
                'rahinan' => 'required|numeric',
            ]);

            if ($validator_sasih->fails()) {
                return redirect()->back()->with('warning', 'Jika memilih type odalan sasih, maka harus memilih sasih dan rahinan yang sesuai');
            }

            // If validator not fails, then save into odalan_sasih table
            $new_odalan             = OdalanSasih::find($temple-id);
            $new_odalan->sasih_id   = $request->sasih;
            $new_odalan->rahinan_id = $request->rahinan;
            $new_odalan->save();

        } elseif ($request->odalan_type == "wuku") {
            // If odalan_type id wuku,
            // First Validator input data odalan sasih
            $validator_wuku = Validator::make($request->all(), [
                'saptawara' => 'required|numeric',
                'pancawara' => 'required|numeric',
                'wuku'      => 'required|numeric',
            ]);

            if ($validator_wuku->fails()) {
                return redirect()->back()->with('warning', 'Jika memilih type odalan wuku, maka harus memilih wuku, pancawara, dan wuku yang sesuai');
            }

            // Then save into odalan_wuku_table
            $new_odalan               = OdalanWuku::find($temple->id);
            $new_odalan->saptawara_id = $request->saptawara;
            $new_odalan->pancawara_id = $request->pancawara;
            $new_odalan->wuku_id      = $request->wuku;
            $new_odalan->save();
        }

        // Save into temple table
        $new                  = Temple::find($id);
        $new->temple_name     = $request->temple_name;
        $new->address         = $request->address;
        $new->temple_type_id  = $request->temple_type_id;
        $new->odalan_id       = $new_odalan->id;
        $new->odalan_type     = $request->odalan_type;
        $new->creator_id      = Auth::id();
        $new->creator_type    = $temple->creator_type;
        $new->validate_status = '1';
        $new->sub_district_id = $request->sub_district;
        $new->description     = $request->description;
        $new->latitude        = $request->latitude;
        $new->longitude       = $request->longitude;
        $new->priest_name     = $request->priest_name;
        $new->priest_address  = $request->address_priest;
        $new->priest_phone    = $request->priest_phone;
        $new->save();

        // New save Image By Nata
        // Save image into folder and link into database
        $number_of_image = $request->total_semua_foto;
        $id_max          = TempleImage::max('id');
        $id              = $id_max + 1;

        for ($i = 1; $i <= $number_of_image; $i++) {
            if ($request->hasFile('foto_pura_' . $i)) {

// Belum Hapus gambar sebelumnya dan database sebelumnya -------------------------------------------------------------------

                // return "number_of_image";
                $filePic   = $request->file('foto_pura_' . $i);
                $extension = $filePic->getClientOriginalExtension();
                $fileName  = 'temple_image_' . $id;
                $filePic->move('temple_image/', $fileName . '.' . $extension);

                $new_image             = new TempleImage();
                $new_image->image_name = 'temple_image/' . $fileName . '.' . $extension;
                $new_image->temple_id  = $new->id;
                $new_image->save();
            }
            $id++;
        }


// Belum bisa update element temple ----------------------------------------------------------------------------------------------------
        // Process save element and image of their element
        $max_number_of_card_element = $request->max_number_of_card_element;
        $max_id                     = TempleElementImage::max('id');
        // $id = $max_id->id;

        for ($a = 1; $a <= $max_number_of_card_element; $a++) {
            // Check when input is not null
            if ($request->get('inputHiddenElementName_' . $a)) {
                $new_temple_element                      = new TempleDetail();
                $new_temple_element->element_name        = $request->get('inputHiddenElementName_' . $a);
                $new_temple_element->god                 = $request->get('inputHiddenGodName_' . $a);
                $new_temple_element->element_description = $request->get('inputHiddenElementDescription_' . $a);
                $new_temple_element->element_position    = $request->get('inputHiddenElementPosition_' . $a);
                $new_temple_element->temple_id           = $new->id;
                $new_temple_element->save();

                // Loop to save all image of element
                $total_image_element = $request->get('inputHiddenTotalElementImage_' . $a);
                for ($i = 1; $i <= $total_image_element; $i++) {
                    // Check when upload image of element
                    if (null !== $request->get('inputHiddenElement_' . $a . '_Image_' . $i)) {
                        if ($request->get('inputHiddenElement_' . $a . '_Image_' . $i)) {
                            // start success
                            $max_id += 1;
                            $image_str = $request->get('inputHiddenElement_' . $a . '_Image_' . $i);
                            $array     = explode(',', $image_str);
                            $extension = explode('/', explode(':', substr($image_str, 0, strpos($image_str, ';')))[1])[1];
                            $filePic   = Image::make($array[1])->encode($extension);

                            $fileName = 'temple_element_image_' . $max_id;
                            $path     = 'temple_element_image/';
                            $filePic->save($path . $fileName . '.' . $extension);

                            $new_temple_element_image                   = new TempleElementImage();
                            $new_temple_element_image->image_name       = $path . $fileName . '.' . $extension;
                            $new_temple_element_image->temple_detail_id = $new_temple_element->id;
                            $new_temple_element_image->save();
                        }
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Data Pura baru berhasil diperbaharui');
  }
}
