<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempleElementImage extends Model
{
    public function TempleDetail(){
        return $this->belongsTo('App\TempleDetail','temple_detail_id');
    }
}
