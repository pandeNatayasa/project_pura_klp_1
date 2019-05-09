<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sasih extends Model
{
    public function OdalanSasih(){
        return $this->hashMany('App\OdalanSasih');
    }
}
