<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function maps(){
        return view('user.index');
    }

    public function addlocation(){
        return view('user.addlocation');
    }
}
