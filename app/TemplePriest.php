<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplePriest extends Model
{
    public function Temple(){
        return $this->hashMany('App\Temple');
    }
}
