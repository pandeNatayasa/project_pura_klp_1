<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temple;
use App\TempleImage;
use App\OdalanSasih;
use App\OdalanWuku;
use App\TempleType;
use App\TempleDetail;
use App\TempleElementImage;

class LandingController extends Controller
{
  //Maps Template
  public function maps(){
    $marker = Temple::where('validate_status','=','1')->get();
    
    return view('user.index', compact('marker'));
  }

  public function loadMarker(Request $request){
    $marker = Temple::all();

    return $marker;
  }

  public function show_temple_detail($id)
  {
  	$temple = Temple::find($id);
  	$temple_type = TempleType::find($temple->temple_type_id);
  	$temple_images = TempleImage::where('temple_id','=',$temple->id)->get();

  	// Get odalan fit with odalan type
  	if ($temple->odalan_type == "sasih") {
  		// When odalan_type is sasih then select into odalan_sasih table
  		$odalan = OdalanSasih::join('rahinans','odalan_sasihs.rahinan_id','=','rahinans.id')
        ->join('sasihs','odalan_sasihs.sasih_id','=','sasihs.id')
        ->select('rahinans.rahinan_name','sasihs.sasih_name')
        ->where('odalan_sasihs.id','=',$temple->odalan_id)
        ->first();
  	}elseif ($temple->odalan_type == "wuku") {
  		// When odalan_type is wuku, then select into odalan_wuku_table
  		$odalan = OdalanWuku::join('saptawaras','odalan_wukus.saptawara_id','=','saptawaras.id')
        ->join('pancawaras','odalan_wukus.pancawara_id','=','pancawaras.id')
        ->join('wukus','odalan_wukus.wuku_id','=','wukus.id')
        ->select('saptawaras.saptawara_name','pancawaras.pancawara_name','wukus.wuku_name')
        ->where('odalan_wukus.id','=',$temple->odalan_id)
        ->first();
  	}

    // Get all element of temple
    $temple_element = TempleDetail::groupBy('temple_details.id')
      ->join('temple_element_images','temple_details.id','=','temple_element_images.temple_detail_id')
      ->select('temple_details.*','temple_element_images.image_name')
      ->where('temple_details.temple_id','=',$temple->id)
      ->get();

  	// This is to push all data to array all
  	$all=array($temple);
		array_push($all,$temple_images,$odalan,$temple_type,$temple_element);
  	// , $temple_images, $odalan
  	return $all;
  }

  public function show_temple_element_detail($id)
  {
    $temple_element_images = TempleElementImage::where('temple_detail_id','=',$id)->get();
    return $temple_element_images;
  }
}
