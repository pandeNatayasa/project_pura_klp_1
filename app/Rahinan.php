<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rahinan extends Model
{
    public function OdalanSasih(){
        return $this->hashMany('App\OdalanSasih');
    }
}
