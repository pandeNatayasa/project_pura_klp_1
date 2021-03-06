<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function Province(){
    	return $this->belongsTo('App\Province','province_id');
    }

    public function City(){
    	return $this->hashMany('App\SubDistrict');
    }

}
