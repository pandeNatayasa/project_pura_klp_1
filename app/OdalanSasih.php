<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OdalanSasih extends Model
{
    public function Sasih(){
    	return $this->belongsTo('App\Sasih','sasih_id');
    }

    public function Rahinan(){
    	return $this->belongsTo('App\Rahinan','rahinan_id');
    }

}
