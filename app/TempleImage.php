<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempleImage extends Model
{
    protected $fillable = [
        'image_name', 'image_position'
    ];

    // public function temple(){
    //     return $this->hasMany('App\Temple','temple_id');
    // }
}
