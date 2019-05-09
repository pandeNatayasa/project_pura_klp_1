<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temple extends Model
{
    public function TemplePriest(){
        return $this->belongsTo('App\TemplePriest','temple_priest_id');
    }

    public function priest_temple(){
        return $this->belongsTo('App\TemplePriest','temple_priest_id');
    }

    public function TempleType(){
        return $this->belongsTo('App\TempleType','temple_type_id');
    }

    public function Admin(){
        return $this->belongsTo('App\Admin','admin_id');
    }

    public function User()
    {
    	return $this->belongsTo('App\User','user_id');
    }

    public function TempleImage()
    {
    	return $this->hashMany('Add\TempleImage');
    }

    public function TempleDetail(){
        return $this->hashMany('App\TempleDetail');
    }

    public function SubDistrict()
    {
        return $this->belongsTo('App\SubDistrict','sub_district_id');
    }

    // public function image_temple(){
    //     return $this->belongsTo('App\TempleImage','temple_id');
    // }
}
