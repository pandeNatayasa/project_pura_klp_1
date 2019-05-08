<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temple extends Model
{
    public function priest_temple(){
        return $this->belongsTo('App\TemplePriest','temple_priest_id');
    }

    // public function image_temple(){
    //     return $this->belongsTo('App\TempleImage','temple_id');
    // }
}
