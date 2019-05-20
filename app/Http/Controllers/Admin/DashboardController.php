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

  	return view('admin.temple_detail',compact('temple','temple_images','odalan'));
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
  	$provinces = Province::all();
  	$rahinan = Rahinan::all();
    $sasih = Sasih::all();
    $wuku = Wuku::all();
    $saptawara = Saptawara::all();
    $pancawara = Pancawara::all();

  	return view('admin.update_temple',compact('temple','temple_images','odalan','type','provinces','rahinan','sasih','wuku','saptawara','pancawara'));	
  }
}
