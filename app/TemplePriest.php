<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplePriest extends Model
{
    public function temple(){
        return $this->hasMany('App\Temple','temple_priest_id');
    }
}
