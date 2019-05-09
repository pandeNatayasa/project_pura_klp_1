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

    public function User()
    {
    	return $this->belongsTo('App\User','user_id');
    }

    public function TempleImage()
    {
    	return $this->hashMany('Add\TempleImage');
    }

    // public function image_temple(){
    //     return $this->belongsTo('App\TempleImage','temple_id');
    // }
}
