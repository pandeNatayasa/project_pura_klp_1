<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Temple;
use App\TempleImage;

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
  	$temples = Temple::all()->where('validate_status','=','0');
  	return view('admin.list_temple_validate',compact('temples'));
  }
}
