<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempleDetail extends Model
{
    public function Temple(){
        return $this->belongsTo('App\Temple','temple_id');
    }

    public function TempleElementImage(){
        return $this->hashMany('App\TempleElementImage');
    }
}
