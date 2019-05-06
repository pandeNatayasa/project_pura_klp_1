<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
    public function City(){
    	return $this->belongsTo('App\City','city_id');
    }

    public function User(){
    	return $this->hashMany('App\User');
    }

    public function Temple(){
    	return $this->hashMany('App\Temple');
    }
}
