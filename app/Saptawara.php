<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saptawara extends Model
{
    public function OdalanWuku(){
        return $this->hashMany('App\OdalanWuku');
    }
}
