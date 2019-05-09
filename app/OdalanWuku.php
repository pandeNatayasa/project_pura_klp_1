<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OdalanWuku extends Model
{
    public function Wuku(){
    	return $this->belongsTo('App\Wuku','wuku_id');
    }

    public function Pancawara(){
    	return $this->belongsTo('App\Pancawara','pancawara_id');
    }

    public function Saptawara(){
    	return $this->belongsTo('App\Saptawara','saptawara_id');
    }
}
