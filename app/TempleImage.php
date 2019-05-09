<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempleImage extends Model
{
    protected $fillable = [
        'image_name', 'temple_id'
    ];

    public function Temple(){
        return $this->belongsTo('App\Temple','temple_id');
    }
}
