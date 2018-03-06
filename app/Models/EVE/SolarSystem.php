<?php

namespace App\Models\EVE;

use Illuminate\Database\Eloquent\Model;

class SolarSystem extends Model
{
    public $timestamps = false;

    public function region(){
        return $this->belongsTo('App\Models\EVE\Region', 'id');
    }
}
