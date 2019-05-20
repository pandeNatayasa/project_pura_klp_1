<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temple;

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
}
