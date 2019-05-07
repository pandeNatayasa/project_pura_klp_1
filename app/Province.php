<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public function City(){
    	return $this->hashMany('App\City');
    }
}
